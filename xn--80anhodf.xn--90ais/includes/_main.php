<?php
// $place = 'work';
$place = 'home';
// $place = 'hoster';
// $place = 'hoster-by';

if($place == 'work'){
  $url = 'http://192.168.1.7:888/poznai_bel/';
  // $mail = 'vadzim.kananovich.by@gmail.com';
  $host = "127.0.0.1:3388";
  $user = "root";
  $pass = "";
  $db = "poznaiby";
}

if($place == 'home'){
  $url = 'http://vadzim.ddns.net:89/xn--80anhodf.xn--90ais/';
  // $mail = 'vadzim.kananovich.by@gmail.com';
  $host = "vadzim.ddns.net:3306";
  $user = "root";
  $pass = "arrogaminca";
  $db = "poznai";
}

if($place == 'hoster'){
  $url = 'http://xn--80anhodf.xn--90ais/';
  // $mail = $email[0];
  $host = "localhost";
  $user = "poznaiby_vadzim";
  $pass = "Arrogaminca1995";
  $db = "poznaiby_sites";
}
if($place == 'hoster-by'){
  $url = 'http://poznaibel.by/';
  // $mail = $email[0];
  $host = "localhost";
  $user = "poznaiby_vadzim";
  $pass = "Arrogaminca1995";
  $db = "poznaiby_sites";
}

$contact_file = json_decode(file_get_contents($path.'jsdb/JSON/common/contacts.json'));
$contact = $contact_file[0];

$address = $contact->address;
$city = $contact->city;
$postal = $contact->postal;
$email = $contact->email;
$mail = $email[0];
$phone = $contact->phone;
$social = $contact->social;

if(count($social) > 0){
  for($i = 0; $i < count($social); $i++){
    if($social[$i]->social === 'ВКонтакте'){
      $social[$i]->ico = 'fab fa-vk';
    }
    if($social[$i]->social === 'Instagram'){
      $social[$i]->ico = 'fab fa-instagram';
    }
    if($social[$i]->social === 'Skype'){
      $social[$i]->ico = 'fab fa-skype';
      $social[$i]->link = 'skype:'.$social[$i]->link.'?chat';
    }
  }
}

if(count($phone) > 0){
  for($i = 0; $i < count($phone); $i++){
    $tel = $phone[$i]->tel;
    $tel = preg_replace('/\s+/', '', $tel);
    $tel = str_replace('+', '', $tel);
    $tel = '+'.$tel;
    $phone[$i]->tel = $tel;
    $phone[$i]->tel_link = preg_replace("/[^0-9,+]/", '', $tel);
    if($phone[$i]->operator === 'Velcom'){
      $phone[$i]->ico = 'mobo-velcom-24';
    }
    if($phone[$i]->operator === 'MTS'){
      $phone[$i]->ico = 'mobo-mts-24';
    }
    if($phone[$i]->operator === 'Life'){
      $phone[$i]->ico = 'mobo-life-24';
    }
    if($phone[$i]->operator === 'Городской'){
      $phone[$i]->ico = 'mobo-home-24';
    }
    for($j = 0; $j < count($phone[$i]->messenger); $j++){
      if($phone[$i]->messenger[$j][0] === 'viber'){
        $phone[$i]->messenger[$j][1] = 'fab fa-viber';
      }
      if($phone[$i]->messenger[$j][0] === 'whatsapp'){
        $phone[$i]->messenger[$j][1] = 'fab fa-whatsapp';
      }
    }
  }
}


 ?>
