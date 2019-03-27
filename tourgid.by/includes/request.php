<?php
if(isset($_GET['action'])) {

  include '_main.php';

  function send_mail($mail,$text){
    mail($mail,$text,"Content-type:text/html; charset=utf-8");
  }

  if($_GET['action'] === 'contact_mail'){
    $text = 'Письмо с '.$url;
    $text .= isset($_POST['mailName']) ? '<br>Имя: '.$_POST['mailName'] : '';
    $text .= isset($_POST['mailEmail']) ? '<br>Email: '.$_POST['mailEmail'] : '';
    $text .= isset($_POST['mailNum']) ? '<br>Телефон: '.$_POST['mailNum'] : '';
    $text .= isset($_POST['mailMsg']) ? '<br>Сообщение: <br>'.$_POST['mailMsg'] : '';
    $contact_file = json_decode(file_get_contents('../JSON/contacts.json'));
    $email = isset($contact_file->email[0]) ? strip_tags($contact_file->email[0]) : false;
    if($email){
      send_mail($email,$text);
      echo true;
    } else {
      echo false;
    }
  }

  if($_GET['action'] === 'contact_call_back') {
    $text = 'Письмо с '.$url;
    $text .= isset($_POST['modalName']) ? '<br>Имя: '.$_POST['modalName'] : '';
    $text .= isset($_POST['modalNum']) ? '<br>Телефон: '.$_POST['modalNum'] : '';
    $contact_file = json_decode(file_get_contents('../JSON/contacts.json'));
    $email = isset($contact_file->email[0]) ? strip_tags($contact_file->email[0]) : false;
    if($email){
      send_mail($email,$text);
      echo true;
    } else {
      echo false;
    }
  }


}



?>
