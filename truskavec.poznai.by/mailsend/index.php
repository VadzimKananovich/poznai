<?php
if(isset($_GET['action']) && $_GET['action'] == 'send'){

	set_time_limit (0);
	$oldFile = file_get_contents('sended.txt', true);

	$getTo = '';
	$subject = 'Рекламный тур - 100$ на 9 дней';

	$headers="MIME-Version: 1.0\r\n";
	$headers.="Content-type: text/html; charset=utf-8\r\n";
	$headers.="From: poznai@poznai.by";

	$to = $_POST['mail'];
	$exTo = explode(',',$to);
	for($i = 0; $i<(count($exTo)-1); $i++){
		$exTo[$i] = ltrim(rtrim($exTo[$i]));
	}
	$mailList = implode(',',$exTo);
	// for($i = 0; $i < count($exTo); $i++){
		// $id = ltrim(rtrim($exTo[$i]));
		$emailText = file_get_contents('email.html');
		// $emailText .= '
		// <input type="hidden" name="email" value="'.$id.'"><br></br>
		// <div>
		// <br></br>
		// <button type="submit" name="button" style="cursor: pointer; height: 45px; background-color: #484d4e; color: #1ea4b1; font-size: 20px">ОТПРАВИТЬ</button>
		// </div>
		// <div>
		// <br></br>
		// <hr>
		// <a href="http://truskavec.poznai.by/offer/?action='.$id.'" target="_blank" style="color:#484d4e; font-weight: bold; font-size: 20px;">
		// Или перейдите по ссылке
		// </a>
		// </div>
		// ';
		// $emailText .= file_get_contents('mailBottom.php');

		// mail($exTo[$i], $subject, $emailText, $headers);
		date_default_timezone_set("Europe/Moscow");
		// echo date('d-m-Y h:i:s A');
		if(mail($mailList, $subject, $emailText, $headers)){
			for($i = 0; $i<(count($exTo)); $i++){
				$getTo .= $exTo[$i].' - '.date("Y-m-d H:i:s").' - <font color="green">отправлено</font>,'."\r\n";
			}
		} else {
			for($i = 0; $i<(count($exTo)); $i++){
				$getTo .= $exTo[$i].' - '.date("Y-m-d H:i:s").' - <font color="red">ошибка!</font>,'."\r\n";
			}
		}
	// }

	$myfile = fopen("sended.txt", "w");
	fwrite($myfile, $oldFile.$getTo);
	fclose($myfile);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Mail send</title>

	<style>
	body {
		padding: 15px!important;
	}
	.like-iframe {
		position: relative;
		margin: 0 auto;
		display: block;
		width: 90%;
		height: 400px;
		overflow: auto;
		margin-bottom: 50px;
	}
	textarea {
		width: 500px;
		height: 350px;
	}
	button {
		cursor: pointer;
	}
	</style>
</head>
<body>

	<br></br>
	<h2>Отправить email:</h2>
	<form class="" action="?action=send" method="post">
		<label for="mail">Введите email через запятую без пробелов:</label>
		<br></br>
		<textarea name="mail" id="mail">vadzim.kananovich.by@gmail.com,vadzim.kananovich.1995@gmail.com</textarea>
		<br>
		<button type="submit" name="button">Отправить</button>
	</form>
	<h3>Всего отправлено:</h3>
	<ol>
		<?php
		$file = file_get_contents('sended.txt', true);
		$mailEx = explode(',',$file);
		for($i = 0; $i < (count($mailEx)-1); $i++){
			if($mailEx != ''){
				echo '<li>'.$mailEx[$i].'</li>';
			}
		}
		echo $mailEx[(count($mailEx)-1)];
		?>
	</ol>
	<br></br>
	<hr>
	<br></br>

	<h2>Всего откликнулось:</h2>
	<?php

	$file = file_get_contents('../offer/offeradd.txt', true);
	$resFile = explode('/',$file);
	if(count($resFile) > 0){
		echo '<ol>';
		for($i = 0; $i < (count($resFile)-1); $i++){
			echo '<li>'.$resFile[$i].'</li>';
		}
		echo '</ol>';
	}

	?>
	<br></br>
	<hr>
	<br></br>
	<h2>Образец email:</h2>

	<div class="like-iframe">
		<?php
		include 'mailTop.php';
		echo '<a href="http://truskavec.poznai.by/offer/?from='.$id.'" target="_blank" title="poznai.by - Трускавец">';
		include 'mailBottom.php';
		?>
	</div>

</body>
</html>
