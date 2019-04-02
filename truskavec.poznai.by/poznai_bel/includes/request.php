<?php


if(isset($_GET['action'])){
	include '_main.php';



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
		'Письмо с touraudio.by',
		'Вам написал: '.$name.
		'<br />Его email: '.$email.
		'<br />Сообщение: <br />'.$message.'<br />',
		"Content-type:text/html;charset=utf-8");
		echo $email.'     '.$name.'      '.$message;
	}

	if($_GET['action'] == 'connect'){
		echo 'connect';
	}

}


?>
