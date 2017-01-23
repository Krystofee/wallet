<?php 
/*
*	Name: 		register.php
*	Author: 	Krystofee
*	Created: 	2.1.2017
*	Desc: 		script used to accept AJAX request and handle lregister into database
*/

require_once 'database.php';
require_once 'wallet.php';

Database::connect();

// get data from POST method
$json_encoded = $_POST['myData'];
$data = json_decode($json_encoded);

// fetching data
$username = $data->username; 
$password = $data->password;
$email = $data->email;
$birth = $data->year . '-' . $data->month . '-' . $data->day; 

// duplicate check
$sql = 'SELECT username FROM users WHERE username LIKE "' . $username . '"';
$result = Database::select($sql);
if(sizeof($result) > 0) {
	die('1 - Username already exists');
}

$sql = 'SELECT email FROM users WHERE email LIKE "' . $email . '"';
$result = Database::select($sql);
if(sizeof($result) > 0) {
	die('2 - Account with that email already exists');
}

// preparing insert sql statement
$sql = 'INSERT INTO users (username, password, email, birth, created, last_login) VALUES("'.$username.'", "'.sha1($password).'", "'.$email.'", "'.$birth.'", null, null)';
// executing
Database::exec($sql);

$sql = 'SELECT id FROM users WHERE username LIKE "' . $username . '"';
$result = Database::select($sql);

create_wallet($result[0][0], 'Default');

// closing db
Database::close();

// success message
die('0 - Account registered successfully');