<?php
/*
*	Name: 		header.php
*	Author: 	Krystofee
*	Created: 	12.1.2017
*	Desc: 		Header od every HTML document
*/

/*
*	To do list:
*				- Make variable title  
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require "cookies.php";

?>


<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Penezenka v1.0</title>

	<!-- Background stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="font/dosis/stylesheet.css">

	<!-- Fonts -- >
	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="js/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

	<!-- Main stalysheet -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>