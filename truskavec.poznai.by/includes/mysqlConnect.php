<?php

$host = "vadzim.ddns.net:3306";
$user = "root";
$pass = "arrogaminca";
$db = "poznai";

$conn = mysqli_connect($host,$user,$pass,$db);

if (!$conn) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}



  error_reporting(E_ALL);
  ini_set('display_errors', 1);


 ?>
