<?
/*
*	Name: 		pie-getter.php
*	Author: 	Krystofee
*	Created: 	6.1.2017
*	Desc: 		Ajax handled data reader from database mainly to plot.js
*/


// executes only if it is awoken by AJAX's request with myData in POST method
if (isset($_POST['myData'])) {
	$json_encoded = $_POST['myData'];
	$data = json_decode($json_encoded);

	//$sql = 'SELECT time, description, sum FROM log WHERE '
	
} else {
	die(__FILE__ . '.php' . ', no data recieved from AJAX myData');
}
