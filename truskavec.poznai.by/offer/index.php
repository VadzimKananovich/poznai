<?php
if(isset($_POST['number'])){
	// if($_POST['number'] == ''){
	// 	header('Location: http://truskavets.poznai.by/');
	// }
	$oldFile = file_get_contents('offeradd.txt', true);
	$myfile = fopen("offeradd.txt", "w");
	if(isset($_POST['email'])){
		$firstVar = $_POST['email'];
	} else {
		$firstVar = $_POST['name'];
	}
	date_default_timezone_set("Europe/Moscow");
	$txt = $firstVar." - ".$_POST['number']." - ".date("Y-m-d H:i:s")."/";
	fwrite($myfile, $oldFile.$txt);
	fclose($myfile);
}
 // else {
// 	header('Location: http://truskavets.poznai.by/');
// }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Заявка принята</title>
		<link href="https://fonts.googleapis.com/css?family=Rubik|Russo+One" rel="stylesheet">
		<style media="screen">
			* {
				margin: 0;
				padding: 0;
				box-sizing: border-box;
			}
			body {
				background-image: url('http://truskavec.poznai.by/img/header-bg.jpg');
				background-repeat: no-repeat;
				background-size: cover;
				position: relative;
				border: 1px solid black;
				min-height: 100vh;

			}
			body:after {
				display: block;
				content: '';
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-color: rgb(35, 39, 42);
				opacity: 0.7;
			}
			.wrapper {
				width: 50%;
				height: auto;
				padding-bottom: 120px;
				position: relative;
				margin: 30px auto;
				border: 1px solid #5f7d80;
				background-color: #d4e3e4;
				border-radius: 15px;
				position: relative;
				z-index: 1;
			}
			h1 {
				text-align: center;
				color: #d4e3e4;
				font-size: 30px;
				text-transform: uppercase;
				font-weight: 600;
				margin-bottom: 30px;
				background-color: #3b484e;
				border-top-left-radius: 15px;
				border-top-right-radius: 15px;
				height: 100px;
				display: flex;
				align-items: center;
				justify-content: center;
				font-family: 'Russo One', sans-serif;
			}
			.wrapper p {
				font-size: 20px;
				text-align: center;
				margin-bottom: 15px;
				font-family: 'Rubik', sans-serif;
				padding: 0 15px;
			}
			.footer {
				position: absolute;
				bottom: 0;
				right: 0;
				left: 0;
				height: 90px;
				background-color: #3b484e;
				display: flex;
				align-items: center;
				justify-content: center;
				border-bottom-left-radius: 15px;
				border-bottom-right-radius: 15px;
			}
			.footer .logo {
				width: 100px;
				height: 40px;
				display: block;
				margin-right: 30px;
			}
			.footer-contact p {
				margin: 0;
				padding: 0;
				margin-bottom: 5px;
			}
			.footer-contact p a {
				display: flex;
				align-items: center;
				text-decoration: none;
				color: white;
				font-size: 14px;
				border-bottom: 1px solid #d4e3e4;
				font-style: italic;
				transition: 0.3s;
			}
			.footer-contact p a:hover {
				color: #d4e3e4
			}
			.footer-contact p a img {
				width: 15px;
				height: 15px;
				margin-right: 5px;
			}
			.footer-contact p a span {
				margin-right: 5px;
			}
			.footer-contact p a .velcom-ico {
				width: 25px;
			}
			.footer-contact p a .mts-ico {
				width: 20px;
			}
			form {
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
			}

			@media(max-width: 768px){
				.wrapper {
					width: 80%;
				}
			}
			@media(max-width: 400px){
				.wrapper {
					width: 99%;
				}
				.footer .logo {
					margin-right: 5px;
				}
			}
		</style>
	</head>
	<body>

		<div class="wrapper">
			<?php
				if(empty($_GET['action'])){
			 ?>
			<h1>Ваша заявка принята</h1>
			<p>
				В ближайшее время с вами свяжется наш специалист
			</p>
			<p>
				Благодарим
			</p>
			<?php
		} else {
			 ?>
			 <h1>Введите ваш номер телефона для связи</h1>
			 <form class="fomr-submit" action="http://truskavec.poznai.by/offer/" method="post">
				 <input type="text" name="name" placeholder="Ваше имя" style="margin-bottom: 15px;height:45px; background-color: #484d4e; font-size: 20px; color: #1ea4b1; outline:none; padding: 0 15px;" required />
				 <input type="text" name="number" placeholder="Номер телефона" style="margin-bottom: 15px;height:45px; background-color: #484d4e; font-size: 20px; color: #1ea4b1; outline:none; padding: 0 15px;" required />
				 <div>
				 <button type="submit" name="button" style="padding: 0 15px;cursor: pointer; height: 45px; background-color: #484d4e; color: #1ea4b1; font-size: 20px">ОТПРАВИТЬ</button>
			 </form>

			 <?php
		 }
			  	?>
			<div class="footer">
				<img class="logo" src="http://ipic.su/img/img7/fs/logo.1537274541.png" alt="POZNAI.BY">
				<div class="footer-contact">
					<p><a href="mailto:info@poznai.by" title="Email"><img src="http://vorohta.poznai.by/img/email.png" alt="email" class="email-ico"><span>info@poznai.by</span></a></p>
					<p><a href="tel:+375296645011" title="Viber-Velcom"><img src="http://vorohta.poznai.by/img/viber.png" alt="viber" class="viber-ico"><span>+375 (29) 664-50-11</span><img src="http://vorohta.poznai.by/img/velcom.png" alt="velcom" class="velcom-ico"></a></p>
					<p><a href="tel:+375333645011" title="WhatsApp-MTS"><img src="http://vorohta.poznai.by/img/whatsapp.png" alt="whatsapp" class="whatsapp-ico"><span>+375 (33) 364-50-11</span><img src="http://vorohta.poznai.by/img/mts.png" alt="mts" class="mts-ico"></a></p>

				</div>
			</div>
		</div>


	</body>
</html>
