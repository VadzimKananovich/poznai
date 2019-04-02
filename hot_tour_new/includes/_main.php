<?php
// $place = 'work';
$place = 'home';
// $place = 'hoster';



if($place == 'work'){

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  $url = 'http://192.168.1.2:888/tourgid.by/';
  $src_url = 'http://192.168.1.2:888/tourgid.by/';
  // $mail = 'vadzim.kananovich.by@gmail.com';
  $host = "127.0.0.1:3388";
  $user = "root";
  $pass = "";
  $db = "poznaiby";
  $mail = "vadzim.kananovich.by@gmail.com";
}

if($place == 'home'){

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  $url = 'http://vadzim.ddns.net:89/hot_tour_new/';
  $src_url = 'http://vadzim.ddns.net:89/hot_tour_new/';
  // $mail = 'vadzim.kananovich.by@gmail.com';
  $host = "vadzim.ddns.net:3306";
  $user = "root";
  $pass = "arrogaminca";
  $db = "poznaiby_avia";
}

if($place == 'hoster'){
  $url = 'http://tourgid.by/';
  $src_url = 'http://tourgid.by/';
  // $mail = $email[0];
  $host = "localhost";
  $user = "poznaiby_vadzim";
  $pass = "Arrogaminca1995";
  $db = "poznaiby_sites";
}

// $contact_file = json_decode(file_get_contents($path.'JSON/contacts.json'));
// $contact = $contact_file[0];
//
// $address = $contact->address;
// $city = $contact->city;
// $postal = $contact->postal;
// $email = $contact->email;
// $mail = $email[0];
// $phone = $contact->phone;
// $social = $contact->social;
//
// if(count($phone) > 0){
//   for($i = 0; $i < count($phone); $i++){
//     $tel = $phone[$i]->tel;
//     $tel = preg_replace('/\s+/', '', $tel);
//     $tel = str_replace('+', '', $tel);
//     $tel = '+'.$tel;
//     $phone[$i]->tel = $tel;
//     $phone[$i]->tel_link = preg_replace("/[^0-9]/", '', $tel);
//   }
// }

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
  die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
} else {
  $conn->set_charset('utf8');
}


?>
