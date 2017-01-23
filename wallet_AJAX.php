<?
/*
*	Name: 		wallet_AJAX.php
*	Author: 	Krystofee
*	Created: 	11.1.2017
*	Desc: 		AJAX evoked function used to getting data from the document and 
*				processing the into the wallet.php functions
*/



if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once 'database.php';
require_once 'wallet.php';



$json_encoded = $_POST['myData'];
$data = json_decode($json_encoded);


if(isset($data->walletname) && isset($_SESSION['user']['username'])) {
	// Create new wallet

	if (!isset($_SESSION['user']['id'])) {
		die(" FATAL ERROR !!! User ID in $_SESSION is not set! FATAL ERROR");
	}

	if( create_wallet($_SESSION['user']['id'] ,$data->walletname)) {
		die("New wallet created with name ".$data->walletname);
	} else {
		die("Creating new wallet failed.");
	}
}