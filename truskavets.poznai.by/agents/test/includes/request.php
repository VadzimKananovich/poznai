<?php

if(isset($_GET['action'])){

	include '_main.php';

	if($_GET['action'] === 'get_program'){
		$path = '../'.urldecode($_GET['path']);
		$object = file_get_contents($path);
		echo $object;
	}

	if($_GET['action'] === 'send_mail'){
		$dates = json_decode($_POST['dates']);
		$name = $dates->name;
		$num = $dates->email;

		$contacts = json_decode(file_get_contents('../JSON/contacts.json'));
		$mail = strip_tags($contacts->email[0]);
		mail($mail,
		'Письмо с truskavets',
		'Вам написал: '.$name.
		'<br />Его номер: '.$num,
		"Content-type:text/html;charset=utf-8");
		echo true;
	}

}


?>
