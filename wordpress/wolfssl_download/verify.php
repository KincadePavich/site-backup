<?php

session_start();

//error_reporting(E_ALL);
error_reporting(0);

include_once('var.php');			/* global variables */
include_once('util.php');			/* exit/error functions */

include_once("./maxmind/geoipcity.inc");
include_once("./maxmind/geoipregionvars.php");

require_once("pear/Validate/Validate.php");
require_once("pear/Validate/US.php");

if (isset($_POST['filename']))
	$filename = $_POST['filename'];
if (isset($_POST['agree']))
	$license  = $_POST['agree'];
if (isset($_POST['fid'])) {
	$formid   = $_POST['fid'];
	$_SESSION['formid'] = $formid;
}
if (isset($_POST['name']))
	$name	   = $_POST['name'];
if (isset($_POST['company']))
	$company  = $_POST['company'];
if (isset($_POST['title']))
	$title    = $_POST['title'];
if (isset($_POST['email']))
	$email    = $_POST['email'];
if (isset($_POST['phone']))
	$phone    = $_POST['phone'];
if (isset($_POST['comments']))
	$comments = $_POST['comments'];
if (isset($_POST['evalsupport']))
	$evalsupport = $_POST['evalsupport'];

$comments2 = "";	// to hold comments before mysqli_real_escape_string() call, for mail()

if (isset($_SERVER['HTTP_REFERER']))
	$referer = $_SERVER['HTTP_REFERER'];
if (isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];

/* cloudflare mucks up the original ip in REMOTE_ADDR, find real one here */
if (array_key_exists('X-Forwarded-For', $_SERVER) &&
    filter_var($_SERVER['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $ipaddress = $_SERVER['X-Forwarded-For'];

} elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) &&
    filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];

} else {
    $ipaddress = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
}

// Unset previous session values
unset($_SESSION['error_codes']);
unset($_SESSION['filename']);
unset($_SESSION['name']);
unset($_SESSION['company']);
unset($_SESSION['title']);
unset($_SESSION['email']);
unset($_SESSION['phone']);
unset($_SESSION['comments']);
unset($_SESSION['evalsupport']);

$validate = new Validate();
$validateus = new Validate_US();

/* connect to database */
$mysqli = new mysqli($hostName, $userName, $password);
$mysqli->select_db('wolfssldownload');

if (!isset($_SESSION['timestamp']))
	$_SESSION['timestamp'] = 0;

/* verify we're coming from the downloadForm.php or downloadMoreForm.php file using nonce check */
if ($formid == 1) {
	$expected_nonce = recreateNonce("page1a", session_id(), $_SESSION['timestamp'], $sha256key);
	$ret = verifyNonce($expected_nonce, $_SESSION['timestamp'], $mysqli);
}
else if ($formid == 2) {
	$expected_nonce = recreateNonce("page1b", session_id(), $_SESSION['timestamp'], $sha256key);
	$ret = verifyNonce($expected_nonce, $_SESSION['timestamp'], $mysqli);
}

// Is our nonce valid and what we're expecting?

if ( ($ret == 0) && ($expected_nonce == $_SESSION['nonce']) && ($_POST['submit'] == 'DOWNLOAD') ) {

	// Mark nonce as used
	markNonceAsUsed($_SESSION['nonce'], $_SESSION['timestamp'], $mysqli);

	// STEP 1: ---- Sanitize inputs, save error codes in error_codes array ----

	// Do we have a valid filename?
	if (isset($filename))
		$_SESSION['filename'] = $filename;

	/* get valid file names from database */
	$product_query = "SELECT PRODUCTS.filename FROM PRODUCTS";
	$product_result = $mysqli->query($product_query);

	while ($row2 = $product_result->fetch_array())
	{
		$valid_filenames[] = $row2['filename'];
	}
	$product_result->close();

	if(!isset($filename) || !isset($valid_filenames) || !in_array($filename,$valid_filenames,true))
	{
		// Bad filename
		$error_codes[] = 2;
	}

	// Was the license accepted?
	if(!isset($license) || strcmp($license,"1") != 0)
	{
		// License not accepted
		$error_codes[] = 3;
	}

	// Validate name if given (string) -----------------------------------------
	if ($name != null)
	{
		$_SESSION['name'] = $name;

		if ($validate->string("$name",array("format"=>VALIDATE_NAME,"min_length"=>1,"max_length"=>100))) {
			$name = filter_var($name, FILTER_SANITIZE_STRING);
			$name = $mysqli->real_escape_string($name);
		} else {
			$error_codes[] = 4;
		}
	}

	// Validate company (string) -----------------------------------------------
	if ($company != null)
	{
		$_SESSION['company'] = $company;

        if ($validate->string("$company",array("format"=>VALIDATE_ALPHA.VALIDATE_EALPHA.VALIDATE_NUM.VALIDATE_SPACE.VALIDATE_PUNCTUATION.VALIDATE_NAME,"min_length"=>1,"max_length"=>100))) {
			$company = filter_var($company, FILTER_SANITIZE_STRING);
			$company = $mysqli->real_escape_string($company);
		} else {
			$error_codes[] = 5;
		}
	}

	// Validate title (string) -------------------------------------------------
	if ($title != null)
	{
		$_SESSION['title'] = $title;

		if ($validate->string("$title",array("format"=>VALIDATE_ALPHA.VALIDATE_SPACE.VALIDATE_PUNCTUATION,"min_length"=>1,"max_length"=>100))) {
			$title = filter_var($title, FILTER_SANITIZE_STRING);
			$title = $mysqli->real_escape_string($title);
		} else {
			$error_codes[] = 6;
		}
	}

	// Validate email (email) -------------------------------------------------
	if ($email != null)
	{
		$_SESSION['email'] = $email;

		if ($validate->email("$email", true)) {
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			$email = $mysqli->real_escape_string($email);
		} else {
			$error_codes[] = 7;
		}
	}

	// Validate phone (phone number) ------------------------------------------
	if ($phone != null)
	{
		$_SESSION['phone'] = $phone;

		if($validate->string("$phone", array("format"=>VALIDATE_NUM.VALIDATE_SPACE.VALIDATE_PUNCTUATION.VALIDATE_NAME.'+', "min_length"=>1, "max_length"=>100))){
			$phone = filter_var($phone, FILTER_SANITIZE_STRING);
			$phone = $mysqli->real_escape_string($phone);
		} else {
			$error_codes[] = 8;
		}
	}

	// Validate comments (string) -------------------------------------------------
	if ($comments != null)
	{
		$_SESSION['comments'] = $comments;

		if ($validate->string("$comments",array("format"=>VALIDATE_ALPHA.VALIDATE_NUM.VALIDATE_SPACE.VALIDATE_EALPHA.VALIDATE_PUNCTUATION.VALIDATE_NAME,"min_length"=>1,"max_length"=>300))) {
			$comments = filter_var($comments, FILTER_SANITIZE_STRING);
			$comments2 = $comments;
			$comments = $mysqli->real_escape_string($comments);
		} else {
			$error_codes[] = 9;
		}
	}

	if(count($error_codes) > 0) {
		scriptfail($error_codes, $formid);
		exit();
	} else {

		// STEP 2: ---- Record data in MySQL database ----
		if ($stmt = $mysqli->prepare("SELECT productid, name FROM PRODUCTS WHERE filename=?")) {

			$stmt->bind_param("s", $filename);
			$stmt->execute();
			$stmt->bind_result($product_id, $product_name);
			$stmt->fetch();
			$stmt->close();

			if ($stmt2 = $mysqli->prepare("INSERT INTO DOWNLOADS (date, name, company, position, email, phone, comment, ipaddress, productid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")) {

				$current_datetime = date('Y-m-d H:i:s');
				$mod_date = date(DATE_RFC822);
				$stmt2->bind_param("ssssssssi", $current_datetime, $name, $company, $title, $email, $phone, $comments, $ipaddress, $product_id);
				$stmt2->execute();
				$stmt2->close();
			}
		}

		// STEP 3: ---- Do some geo-location stuff...
		$gi = geoip_open("./maxmind/GeoLiteCity.dat", GEOIP_STANDARD);
		$record = geoip_record_by_addr($gi, $ipaddress);
		$state_code = $GEOIP_REGION_NAME[$record->country_code][$record->region];

		// STEP 4: ---- Send email to business dept. ----

		// If email or phone are filled in, send email
		if($email != null || $phone != null) {
			$comments2 = nl2br($comments2);
			$to = 'leads@wolfssl.com';
			$subject = 'New Download Lead';
			$message = "
			<html>
			<head>
				<title>New File Download!</title>

				<style>
				table{
					margin: 0;
					padding: 0;
					border: 1px solid black;
				}
				td{
					padding: .2em .5em;
					vertical-align: top;
					font-weight: normal;
				}
				.alt2{
					background-color: #a5adc0;
				}
				.alt{
					background-color: #eee;
				}
				.alert{
					font-size: 1.3em;
					font-family: sans-serif;
				}
				</style>

			</head>
			<body>
				<div>
				<span class='alert'>New Download Alert</span>
				<p style='color:#666; font-size:0.9em;'>
				This is an email alert that there has been a new product download from <b>www.wolfssl.com</b>.
				</p>
				<br/>
				</div>
				<div>
				<table border='0' cellspacing='0' cellpadding='0'>
					<tr class='alt2'>
						<td colspan='2' style='font-family: sans-serif; border-bottom:1px solid black;'><b>Information:</b></td>
					</tr>
					<tr class='alt'>
						<td colspan='2' style='padding-top:10px;'><b>$product_name</b></td>
					</tr>
					<tr class='alt'>
			 			<td colspan='2' style='padding-bottom:10px; border-bottom:1px solid black;'>$mod_date</td>
					</tr>
					<tr>
						<td><b>Name:</b></td>
						<td>$name</td>
					</tr>
					<tr>
						<td><b>Company:</b></td>
						<td>$company</td>
					</tr>
					<tr>
						<td><b>Title:</b></td>
						<td>$title</td>
					</tr>
					<tr>
						<td><b>Email:</b></td>
						<td>$email</td>
					</tr>
					<tr>
						<td><b>Phone:</b></td>
						<td>$phone</td>
					</tr>
					<tr class='alt'>
						<td style='border-top:1px solid black;'><b>Comments:</b></td>
						<td style='border-top:1px solid black;'>$comments2</td>
					</tr>
				</table>
				</div>
				<br/><br/>
				<div>
				<table border='0' cellpadding='0' cellspacing='0'>
					<tr class='alt2'>
						<td colspan='2' style='font-family: sans-serif; border-bottom:1px solid black;'><b>Geo-Location Information:</b></td>
					</tr>
					<tr>
						<td><b>IP Address</b></td>
						<td>$ipaddress</td>
					</tr>
					<tr>
						<td><b>City:</b></td>
						<td>$record->city</td>
					</tr>
					<tr>
						<td><b>State:</b></td>
						<td>$record->region ($state_code)</td>
					</tr>
					<tr>
						<td><b>Zip:</b></td>
						<td>$record->postal_code</td>
					</tr>
					<tr>
						<td><b>Lat/Long:</b></td>
						<td>$record->latitude, $record->longitude</td>
					</tr>
					<tr>
						<td><b>Country:</b></td>
						<td>$record->country_name</td>
					</tr>
					<tr>
						<td><b>Area Code:</b></td>
						<td>$record->area_code</td>
					</tr>
				</table>
				</div><br/>
				<p style='color:#666; font-size:0.9em;'>For support and technical problems and bug reports, please contact <b>support@wolfssl.com</b>.<br/><br/>
				This e-mail and any attachments may contain confidential and privileged information. If you are not<br/> the intended recipient, please notify <b>info@wolfssl.com</b> immediately by e-mail, delete this e-mail and<br/> destroy any copies. Any dissemination or use of this information by a person other than the intended<br/> recipient is unauthorized and may be illegal.<br/><br/>
				This product includes GeoLite data created by MaxMind, available from http://www.maxmind.com/.
				</p>
			</body>
			</html>
			";

			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= "From: leads@wolfssl.com" . "\r\n";
			$headers .= "Reply-To: leads@wolfssl.com" . "\r\n";
			$headers .= "X-Mailer: PHP/" . phpversion();


			mail($to, $subject, $message, $headers);
		}

		// STEP 5: ---- Generate new valid nonce and send user to thank you page ----
		do {
			// store nonce in $_SESSION['nonce'], timestamp in $_SESSION['timestamp']
			generateNonce("page2", session_id(), $sha256key);
			$ret = verifyNonce($_SESSION['nonce'], $_SESSION['timestamp'], $mysqli);
		} while ($ret != 0);

		header('Location: '.$page3);
	}
	$mysqli->close();
}
else {
	// Invalid user - fails during user authentication, either incorrect session key or referring page.
	$mysqli->close();
	authfail($formid);
}

?>
