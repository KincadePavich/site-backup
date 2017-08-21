<?php

/**
 *	download.php
 *	This file handles checking if the user has come from the download form,
 *  validates the input and if correct, serves up the download and
 *	redirect the user to the thank you page.
 *
 */
session_start();

//error_reporting(E_ALL);
error_reporting(0);

include_once('var.php');
include_once('util.php');

if (isset($_SERVER['HTTP_REFERER']))
	$referer = $_SERVER['HTTP_REFERER'];
if (isset($_SERVER['REMOTE_ADDR']))
	$ipaddress = $_SERVER['REMOTE_ADDR'];

$formid = 1;
if (isset($_SESSION['formid']))
	$formid = $_SESSION['formid'];

/* connect to database */
$mysqli = new mysqli($hostName, $userName, $password);
$mysqli->select_db('wolfssldownload');

if (!isset($_SESSION['timestamp']))
	$_SESSION['timestamp'] = 0;

/* verify we're coming from the thanks.php file using nonce check */
$expected_nonce = recreateNonce("page3", session_id(), $_SESSION['timestamp'], $sha256key);
$ret = verifyNonce($expected_nonce, $_SESSION['timestamp'], $mysqli);

// Is our nonce valid and what we're expecting?
if ( ($ret == 0) && ($expected_nonce == $_SESSION['nonce']) ) {

	// Mark nonce as used
	markNonceAsUsed($_SESSION['nonce'], $_SESSION['timestamp'], $mysqli);

	if(isset($_SESSION['filename'])) {
		$filename = $_SESSION['filename'];
	} else {
		// No filename in session variable
		scriptfail(2, $formid);
		exit();
	}

	// Generate our valid file list

	/* get valid file names from database */
	$product_query = "SELECT PRODUCTS.filename FROM PRODUCTS";
	$product_result = $mysqli->query($product_query);

	while ($row2 = $product_result->fetch_array())
	{
		$valid_filenames[] = $row2['filename'];
	}
	$product_result->close();

	// Do we have a valid filename?
	if(isset($filename) && isset($valid_filenames) && in_array($filename,$valid_filenames,true))
	{
		// ---- Distinguish filename from potential longer file path
		$basename = basename($filename);
		$path_parts = pathinfo($filename);
		$filepath = $path_parts['dirname'];

		// ---- Prepare content for download ----

		header("Content-Description: File Transfer");
		header("Content-Disposition:attachment; filename=$basename");
		header("Content-type:application/zip");
		header("Content-Transfer-Encoding: binary");

		// ---- Serve file to user ----

		readfile($absolute_path."/".$filename);

		session_destroy();
		$mysqli->close();
		exit();

	} else {
		// Bad filename
		$mysqli->close();
		scriptfail(2, $formid);
	}
}
else {
	// Invalid user - fails during user authentication, either incorrect session key or referring page.
	$mysqli->close();
	authfail($formid);
}

?>

