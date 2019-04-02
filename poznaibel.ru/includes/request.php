<?php


if(isset($_GET['action'])){
	$path = '../';
	include '_main.php';
	include 'functions.php';

if($_GET['action'] == 'get_tours_info'){
	if($_GET['section'] == 'belarus'){
		echo get_tours_info('belarus');
	}
	if($_GET['section'] == 'belarus_pref'){
		echo get_tours_info('belarus_pref');
	}
	if($_GET['section'] == 'foreigners'){
		echo get_tours_info('foreigners');
	}
	if($_GET['section'] == 'foreigners_pref'){
		echo get_tours_info('foreigners_pref');
	}
}

	if($_GET['action'] == 'imgfromdir'){
		$getImg = $_GET['img'];
		$img = json_decode($getImg);
		for($i = 0; $i < count($img); $i++){
			$scan = scandir('../'.$img[$i][1]);
			array_splice($scan, 0, 2);
			for($count = 0; $count < count($scan); $count++){
				$scan[$count] = $img[$i][1].'/'.$scan[$count];
			}
			$img[$i][1] = $scan;
		}
		$result = json_encode($img);
		echo $result;
	}



	if($_GET['action'] == 'sendmail'){
		$email = $_POST['email'];
		$name = $_POST['name'];
		$message = $_POST['message'];
		mail($mail,
		'Письмо с poznai_bel.by',
		'Вам написал: '.$name.
		'<br />Его email: '.$email.
		'<br />Сообщение: <br />'.$message.'<br />',
		"Content-type:text/html;charset=utf-8");
		echo true;
	}


	if($_GET['action'] == 'sendrequest'){
		$tel = $_POST['tel'];
		$name = $_POST['name'];
		$tourInput = $_POST['tourInput'];
		$post_email = $_POST['email'];

		if($tourInput !== ''){
			$mail_dir = json_decode($tourInput);
		} else {
			$mail_dir = 'ГЛАВНОЙ СТРАНИЦЫ';
		}
		$contact = '';
		if($_POST['prefTel'] === 'true'){
			$contact .='Телефон, ';
		}
		if($_POST['prefEmail'] === 'true'){
			$contact .='Email, ';
		}
		if($_POST['prefViber'] === 'true'){
			$contact .='Viber, ';
		}
		if($_POST['prefWhatsApp'] === 'true'){
			$contact .='WhatsApp, ';
		}
		if($_POST['prefSkype'] === 'true'){
			$contact .='Skype, ';
		}
		$mail_txt ='Письмо с '.$url.'<br />'.
		'Заявка от: '.$name.
		'<br />Его телефон: '.$tel.
		'<br />Его email: '.$post_email.
		'<br />Перешел с: '.$mail_dir.
		'<br />Способ связи: '.$contact;

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		mail($mail,'Письмо с '.$url,$mail_txt,$headers);
		echo true;
	}


	if($_GET['action'] == 'about_belarus_info'){

		if($_GET['section'] == 'about'){
			$file = json_decode(file_get_contents('../jsdb/JSON/home/about_belarus.json'));
			echo json_encode($file[0]);
		}

		if($_GET['section'] == 'header'){
			$photo = scandir('../img/header');
			array_splice($photo,0,2);
			$info = json_decode(file_get_contents('../jsdb/JSON/common/header.json'));
			$res_info = $info[0];
			foreach($res_info as $key => $value) {
				for($i = 0; $i < count($photo); $i++){
					if(strpos($photo[$i], $res_info->$key->img) !== false){
						$res_info->$key->img = 'img/header/'.$photo[$i];
					}
				}
			}
			echo json_encode($res_info);
		}
	}


}


?>
