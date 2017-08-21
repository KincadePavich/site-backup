<?php

include_once('var.php');

/*
 * This function handles failure cases and returns the user to the download page.
 *
 * Error codes include:
 * 1 = User validation failed (bad session key or referer)
 * 2 = Bad filename
 * 3 = License not accepted
 * 4 = Name: Incorrectly formatted
 * 5 = Company: Incorrectly formatted
 * 6 = Title: Incorrectly formatted
 * 7 = Email: Incorrectly formatted
 * 8 = Phone: Incorrectly formatted
 * 9 = Comments: Incorrectly formatted
 *
 */
function authfail($formid)
{
	//echo "Entered authfail()<br/>\n";
	session_destroy();
	//echo "<meta http-equiv='refresh' content='0;url=http://yassl:8888/download/downloadForm.php'>";
	//echo "<meta http-equiv='refresh' content='0;url=".$page1."'>";
	if ($formid == 2)
        header('Location: https://wolfssl.com/wolfSSL/download/downloadMoreForm.php');
	else
        header('Location: https://wolfssl.com/wolfSSL/download/downloadForm.php');
}

/*
 * This function handles failure cases and returns the user to the download page.
 *
 * Error codes include:
 * 1 = User validation failed (bad session key or referer)
 * 2 = Bad filename
 * 3 = License not accepted
 * 4 = Name: Incorrectly formatted
 * 5 = Company: Incorrectly formatted
 * 6 = Title: Incorrectly formatted
 * 7 = Email: Incorrectly formatted
 * 8 = Phone: Incorrectly formatted
 * 9 = Comments: Incorrectly formatted
 *
 */
function scriptfail($error_codes, $formid)
{
	//echo "Entered scriptfail()<br/>\n";
	/*
 	 * Error code 2 indicates bad file. There should be no error displayed
	 * if this is the only one we have.
	 */
	if ($error_codes != 2) {
		$_SESSION['error_codes'] = $error_codes;
	} else {
		session_destroy();
	}
	//echo "<meta http-equiv='refresh' content='0;url=http://yassl:8888/download/downloadForm.php'>";
	//echo "<meta http-equiv='refresh' content='0;url=$page1'>";
	//header('Location: http://www.yassl.com/yaSSL/download/downloadForm.php');
	if ($formid == 2)
        header('Location: https://wolfssl.com/wolfSSL/download/downloadMoreForm.php');
	else
        header('Location: https://wolfssl.com/wolfSSL/download/downloadForm.php');
}

function generateNonce($action, $userid, $key)
{
	$timestamp = time();
	$_SESSION['nonce'] = hash_hmac('sha256', $action.$userid.$timestamp, $key);
	$_SESSION['timestamp'] = $timestamp;
}

function recreateNonce($action, $userid, $timestamp, $key)
{
	$rec_nonce = hash_hmac('sha256', $action.$userid.$timestamp, $key);
	return $rec_nonce;
}

function verifyNonce($nonce, $timestamp, $mysqli)
{
	/* our nonce expires after 10 minutes */
	$expiresDate = $timestamp + 600;
	$now = new DateTime();

	if ( ($expiresDate - time()) < 0) {
		//echo "Expired nonce!<br/>";
		//echo "nonce timestamp = ".$timestamp."<br/>";
		//echo "expiresDate = ".$expiresDate."<br/>";
		//echo "currentDate = ".time()."<br/>";
		// expired nonce
		return -2;
	} else {
		// make sure it's not registered in our database already

		$stmt = $mysqli->prepare("SELECT (COUNT(nonce) > 0) AS is_used FROM NONCE WHERE nonce = ? && timestamp = ?");
		$stmt->bind_param("ss", $nonce, $timestamp);
		$stmt->execute();
		$stmt->bind_result($result);
		$stmt->fetch();
		$stmt->close();

		if ($result > 0) {
			// invalid nonce
			return -1;
		} else {
			// varalid nonce
			return 0;
		}
	}
}

function markNonceAsUsed($nonce, $timestamp, $mysqli)
{
	//$mysqli = new mysqli($hostName, $userName, $password);
	//$mysqli->select_db('yassldownload');
	//echo "Timestamp from markasused = ".$timestamp."<br/>";
	$stmt = $mysqli->prepare("INSERT INTO NONCE (nonce, timestamp) VALUES (?, ?)");
	$stmt->bind_param("ss", $nonce, $timestamp);
	$stmt->execute();
	$stmt->close();

	//$mysqli->close();
}

function using_ie()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = False;
    if(preg_match('/MSIE/i',$u_agent))
    {
        $ub = True;
    }

    return $ub;
}

?>
