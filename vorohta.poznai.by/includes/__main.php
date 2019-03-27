<?php
$url = '';
$mail = '';
?>
<?php



// $place = 'work';
$place = 'home';
// $place = 'hoster';



if($place == 'work'){
  $url = 'http://192.168.1.5:888/vorohta.poznai.by/';
  $mail = 'vadzim.kananovich.by@gmail.com';

  $host = "127.0.0.1:3388";
  $user = "root";
  $pass = "";
  $db = "poznaiby";
}

if($place == 'home'){
  $url = 'http://vadzim.ddns.net:89/vorohta.poznai.by/';
  $mail = 'vadzim.kananovich.by@gmail.com';

  $host = "vadzim.ddns.net:3306";
  $user = "root";
  $pass = "arrogaminca";
  $db = "poznai";
}

if($place == 'hoster'){
  $url = 'http://vorohta.poznai.by/';
  $mail = 'sales@poznai.by';

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
