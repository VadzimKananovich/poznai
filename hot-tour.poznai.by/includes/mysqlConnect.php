<?php

// $place = 'work';
$place = 'home';
// $place = 'hoster';

if($place == 'work'){
  $host = "127.0.0.1:3388";
  $user = "root";
  $pass = "";
  $db = "poznaiby";
}

if($place == 'home'){
  $host = "vadzim.ddns.net:3306";
  $user = "root";
  $pass = "arrogaminca";
  $db = "poznai";
}

if($place == 'hoster'){
	$host = "localhost";
	$user = "poznaiby_vadzim";
	$pass = "Arrogaminca1995";
	$db = "poznaiby_sites";
}


$conn = mysqli_connect($host,$user,$pass,$db);

if (!$conn) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

 ?>