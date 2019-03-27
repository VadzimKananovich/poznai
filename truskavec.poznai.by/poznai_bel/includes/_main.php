<?php



// $place = 'work';
// $place = 'home';
$place = 'hoster';



if($place == 'work'){
  $url = 'http://192.168.1.3:888/poznai_bel/';
  $mail = 'vadzim.kananovich.by@gmail.com';

  $host = "127.0.0.1:3388";
  $user = "root";
  $pass = "";
  $db = "poznaiby";
}

if($place == 'home'){
  $url = 'http://192.168.137.1:888/poznai_bel/';
  $mail = 'vadzim.kananovich.by@gmail.com';

  $host = "127.0.0.1:3388";
  $user = "root";
  $pass = "arrogaminca";
  $db = "poznaiby";
}

if($place == 'hoster'){
  $url = 'http://touraudio.by/';
  $mail = 'sales@touraudioguide.by';

  $host = "localhost";
  $user = "poznaiby_vadzim";
  $pass = "Arrogaminca1995";
  $db = "poznaiby_sites";
}

$conn = mysqli_connect($host,$user,$pass,$db);
mysqli_set_charset( $conn, 'utf8');
if (!$conn) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

 ?>
