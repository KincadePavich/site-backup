<?php
define('WP_USE_THEMES', true);
require($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');
get_header();
?>

<?php 

session_start();

//error_reporting(E_ALL);
error_reporting(0);

include_once('var.php');
include_once('util.php');

if (isset($_SERVER['HTTP_REFERER']))
	$referer = $_SERVER['HTTP_REFERER'];
if (isset($_SERVER['REMOTE_ADDR']))
	$ipaddress = $_SERVER['REMOTE_ADDR'];

/* connect to database */
$mysqli = new mysqli($hostName, $userName, $password);
$mysqli->select_db('wolfssldownload');

if (!isset($_SESSION['timestamp']))
	$_SESSION['timestamp'] = 0;

/* verify we're coming from the verify.php file using nonce check */
$expected_nonce = recreateNonce("page2", session_id(), $_SESSION['timestamp'], $sha256key);
$ret = verifyNonce($expected_nonce, $_SESSION['timestamp'], $mysqli);
  
// Is our nonce valid and what we're expecting? If not, send back to page1.
if ( ($ret == 0) && ($expected_nonce == $_SESSION['nonce']) ) {	
	// Mark nonce as used
	markNonceAsUsed($_SESSION['nonce'], $_SESSION['timestamp'], $mysqli);
	
	// Generate new valid nonce in preparation to send user to page4
	do {
		// store nonce in $_SESSION['nonce'], timestamp in $_SESSION['timestamp']
		generateNonce("page3", session_id(), $sha256key);
		$ret = verifyNonce($_SESSION['nonce'], $_SESSION['timestamp'], $mysqli);
	} while ($ret != 0);
	
	$mysqli->close();

/* For IE8's download security, we also need to allow file to be downloaded
   if we've come back from the download.php page.  IE8 refreshes the page after the
   user confirms download is OK, so we'll store a session variable to indicate
   that this has occurred. Make sure we clear this again. */	
} else {
	$mysqli->close();
	session_destroy();
	header('Location: '.$page1a);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>wolfSSL - Thanks for Downloading!</title>
	
	<meta name="description" content="Thanks for downloading a yaSSL product!" />
	<meta name="keywords" content="embedded ssl, ssl library, tls library, embedded tls, open source ssl, encryption libraries, openssl brdrernatives, security api, ssl, api, Linux ssl, mysql ssl, cryptography library, FIPS, aes cryptography, C++ ssl, crypto source code, crypto library, ssl, gpl ssl, portable security, tls 1.2, ssl inspection " />
	<meta name="robots" content="noindex,nofollow" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<!-- iWeb CSS Styles -->
	<link rel="stylesheet" type="text/css" media="screen,print" href="./css/Template.css" />
	<!--[if lt IE 8]><link rel='stylesheet' type='text/css' media='screen,print' href='./css/TemplateIE.css'/><![endif]-->
	<!--[if gte IE 8]><link rel='stylesheet' type='text/css' media='screen,print' href='./css/IE8.css'/><![endif]-->	
	
	<!-- Blueprint CSS Framework -->
	<link rel="stylesheet" href="<?php echo $blueprint_path; ?>/screen.css" type="text/css" media="screen, projection" />  
	<link rel="stylesheet" href="<?php echo $blueprint_path; ?>/print.css" type="text/css" media="print" />
	<!--[if IE]><link rel="stylesheet" href="<?php echo $blueprint_path; ?>/ie.css" type="text/css" media="screen, projection" /><![endif]-->  
	<link rel="stylesheet" href="<?php echo $blueprint_path; ?>/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" />
	
	<!-- CSS Styles -->
	<link rel="stylesheet" href="./css/forms2.css" type="text/css" />
	
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-64826966-1', 'auto');
        ga('send', 'pageview');
    </script>

	<?php
		if(!using_ie()){
			echo("<meta http-equiv=\"refresh\" content=\"0;url=$page4\" />\n");
		}
	?>
    <script type="text/javascript" src="http://davidjbradshaw.com/iframe-resizer/js/iframeResizer.contentWindow.min.js"></script> 

</head>	
<body>

<div class="container">

<!-- test -->

<!-- Google Code for Downloads Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1070817629;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "WENECMv32gIQ3cLN_gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1070817629/?label=WENECMv32gIQ3cLN_gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<br/>
<span class="intro_text">
	<p>
<?php if (!using_ie()) { ?>
		<center>
        <span class="bluetext">Thank You!<br></span>
			Thanks for downloading our product! Your download should begin shortly. If your download does not begin, please contact support@wolfssl.com.
		</center>
<?php } else { ?>
		<center>
			Please click the following link to begin your file download. If your download does not begin, please contact support@wolfssl.com.<br/><br/>
			<b><a href="./download.php">Begin Download Now</a></b><br/>
		</center>
<?php }?>

	</p>
	<br/><br/><br/>
	<hr/>
	<p>
		<br/><br/>
        Do you have any questions regarding the wolfSSL embedded SSL library?  If so, maybe the following links will help:
		<br/><br/>
	
		<a href='<?php echo $yassl_cyassl_product; ?>'><u>Product Page</u></a>: General overview of features, supported platforms, and license.<br/>
        <a href='<?php echo $yassl_cyassl_manual; ?>'><u>wolfSSL Manual</u></a>: Complete wolfSSL reference manual, getting started, and tutorial.<br/>
        <a href='<?php echo $yassl_cyassl_api; ?>'><u>wolfSSL API Reference</u></a>: Need to learn about our functions?<br/>
		<a href='<?php echo $yassl_contact; ?>'><u>Contact Us</u></a>: We're always here to help!<br/>
	</p>
</span>
<br/>
<div id="footer" class="span-24 last">
	<?php echo $copyright; ?>
</div>
<br/><br/>&nbsp;
</div> <!-- End container -->
</body>
</html>

<?php get_footer() ?>
