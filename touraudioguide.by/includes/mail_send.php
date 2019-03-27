<?php


if(isset($_GET['type'])){

  if($_GET['type'] == 'request'){
    include '_main.php';

    $sended = mail($mail,
    'Письмо с touraudioguide.by',
    'Письмо с '.$url.
    '<br />Вам написал: '.$_POST['requestName'].
    '<br />Его телефон: '.$_POST['requestNumber'],
    "Content-type:text/html;charset=utf-8");
    if($sended){
      echo true;
    } else {
      echo false;
    }
  }

  if($_GET['type'] == 'rent'){
    include '_main.php';

    $sended = mail($mail,
    'Письмо с touraudioguide.by',
    'Письмо с '.$url.
    '<br />Вам написал: '.$_POST['rentName'].
    '<br />Его телефон: '.$_POST['rentNumber'].
    '<br />Заинтересован в: '.$_POST['rentType'],
    "Content-type:text/html;charset=utf-8");
    if($sended){
      echo true;
    } else {
      echo false;
    }
  }

  if($_GET['type'] == 'buy'){
    include '_main.php';

    $sended = mail($mail,
    'Письмо с touraudioguide.by',
    'Письмо с '.$url.
    '<br />Вам написал: '.$_POST['buyName'].
    '<br />Его телефон: '.$_POST['buyNumber'].
    '<br />Заинтересован в '.$_POST['buyType'],
    "Content-type:text/html;charset=utf-8");
    if($sended){
      echo true;
    } else {
      echo false;
    }
  }

  if($_GET['type'] == 'sendmail'){
    include '_main.php';

    $sended = mail($mail,
    'Письмо с touraudioguide.by',
    'Письмо с '.$url.
    '<br />Вам написал: '.$_POST['contactName'].
    '<br />Его email: '.$_POST['contactEmail'].
    '<br />Тема письма: '.$_POST['contactSubject'].
    '<br />Сообщение: <br />'.$_POST['contactMessage'],
    "Content-type:text/html;charset=utf-8");
    if($sended){
      echo true;
    } else {
      echo false;
    }
  }


}


?>
