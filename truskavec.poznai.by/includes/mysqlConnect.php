<?php

$host = "localhost";
$user = "poznaiby_vadzim";
$pass = "Arrogaminca1995";
$db = "poznaiby_sites";

$conn = mysqli_connect($host,$user,$pass,$db);

if (!$conn) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

 ?>
