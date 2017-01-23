<?
/*
*	Name: 		wallet.php
*	Author: 	Krystofee
*	Created: 	11.1.2017
*	Desc: 		File containing wallet handling functions
*
*	function create_wallet($user_id, $name) : boolean
*	function list_wallets($user_id) : array[] of String
*	function list_log($user_id, $wallet_id) : array[row][colun] 
*/

/*
*	To do list:
*					-Make walletname validation to createWallet() function and make errorlist
*					which will handle the javascript AJAX error function
*
*					-Solve the problem with zero wallets created upon first login!
*/

require_once 'database.php';

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}



function create_wallet($user_id, $name) {

	Database::connect();

	$sql = 'INSERT INTO wallet(id, name, owner_id, created) values(null, "' . $name . '", "' . $user_id . '", null)';
	Database::exec($sql);


	$sql = 'SELECT id FROM wallet WHERE owner_id LIKE "' . $user_id . '" AND name LIKE "' . $name . '"';
	$result = Database::select($sql);


	if(sizeof($result) == 0) {
		die('Error in select wallet_id in '.__FILE__.'.php');
	}

	$sql = "CREATE TABLE IF NOT EXISTS `" . $user_id . "_" . $result[0][0] . "` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`description` varchar(255) NOT NULL,
	`sum` int(15) NOT NULL,
	`time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`category` varchar(30) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `time` (`time`),
	KEY `id` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
	Database::exec($sql);

	Database::close();

	return true;
}

function list_wallets($user_id) {
	
	Database::connect();

	$sql = 'SELECT name FROM wallet WHERE owner_id LIKE "' . $_SESSION['user']['id'] . '"';
	$result = Database::select($sql);

	if (sizeof($result) == 0) {
		die('User has no wallet created yet');
	}

	for ($i=0; $i < sizeof($result); $i++) { 
		$arr[$i] = $result[$i][0];
	}

	Database::close();
	
	return $arr;
}

function list_log($user_id ,$wallet_id) {

	Database::connect();

	$sql = 'SELECT * FROM ' . $user_id . '_' . $wallet_id;
	$result = Database::select($sql);

	if (sizeof($result) == 0) {
		die('Selected wallet is empty');
	}

	return $result;
}

