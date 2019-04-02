<?php

if(isset($_GET['action'])){

	include '_main.php';
	include '_company_info.php';

	function send_mail($values,$mail,$url){
		mail($mail,
		'Заявка с '.$url,
		'Вам написал: '.$values->callName.
		'<br />Его номер: '.$values->callNum.
		'<br />Его email: '.$values->callEmail,
		"Content-type:text/html; charset=utf-8");
	}

	function save_contact($values){
		if(file_exists('../JSON/_all_contacts.json')){
			$exist = json_decode(file_get_contents('../JSON/_all_contacts.json'));
		} else {
			$exist = array();
		}
		array_push($exist,$values);
		$result = json_encode($exist, JSON_PRETTY_PRINT);
		$fp = fopen('../JSON/_all_contacts.json','w');
		fwrite($fp,$result);
		fclose($fp);
	}

	if($_GET['action'] === 'get_json'){
		$path = urldecode($_GET['path']);
		if(file_exists($path)){
			echo file_get_contents($path);
		} else {
			echo false;
		}
	}

	if($_GET['action'] === 'send_call'){
		if(isset($_POST['res'])){
			$res = json_decode($_POST['res']);
			echo $_POST['res'];
			echo $_email[0];
			send_mail($res,$_email[0],$url);
			save_contact($res);
			echo true;
		} else {
			echo false;
		}
	}



}


?>
