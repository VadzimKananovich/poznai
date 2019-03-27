<?php
// header('Content-type: application/json');


include 'includes/main.php';







if(isset($_GET['action'])){
	if($_GET['action'] === 'sendmail'){
		mail($mail,
		'Письмо с touraudio.by',
		'Вам написал: '.$_POST['name'].
		'<br />Его email: '.$_POST['email'].
		'<br />Сообщение: '.$_POST['message'].'<br />',
		"Content-type:text/html;charset=utf-8");
		header("Location: $url#sended");
	}
	if($_GET['action'] === 'send'){
		mail($mail,
		'Письмо с touraudio.by',
		'Вам написал: '.$_POST['header_name'].
		'<br />Его телефон: '.$_POST['header_num'],
		"Content-type:text/html;charset=utf-8");
		header("Location: $url#sendeRequest");
	}
	if(isset($_GET['modal'])){
		if($_GET['modal'] === 'rent'){
			$type = '<u> арендовать </u> оборудование';
			$urlId = $url.'#rentConfirm';
		}
		if($_GET['modal'] === 'buy'){
			$type = '<u> купить </u> оборудование';
			$urlId = $url.'#buyConfirm';
		}
		mail($mail,
		'Письмо с touraudio.by',
		'Вам написал: '.$_POST['name'].
		'<br />Его номер: '.$_POST['number'].
		'<br />Желает: '.$type,
		"Content-type:text/html;charset=utf-8");
		header("Location: $urlId");
	}


	if($_GET['action'] == 'sendcomment'){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$company = $_POST['company'];
		$address = $_POST['address'];
		$currentDate = date("m.d.y h:i:s A");
		$comment = $_POST['comment'];

		if(file_exists($_FILES['myfile']['tmp_name'])){
			$existsNames = scandir('img/comments_foto');
			$fileName =  md5($filename. time());
			$temp = explode('.',$_FILES['myfile']['name']);
			$img = $fileName.'.'.end($temp);
			move_uploaded_file(
				$_FILES["myfile"]["tmp_name"], 'img/comments_foto/'.$img
			);
		} else {
			$img = NULL;
		}

		if($company == ''){
			$company = NULL;
		}
		if($address == ''){
			$address = NULL;
		}

		// include 'includes/mysqlConnect.php';
		$query = "INSERT INTO `touraudio_comments`
		(`name`,`email`,`comment`,`img`,`company`,`site`,`currentDate`,`state`) VALUES
		('$name','$email','$comment','$img','$company','$address','$currentDate','pending')";
		mysqli_query($conn,$query);
	}

}
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Тур аудиогид - Poznai.by</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<?php
	if($place == 'hoster'){
		echo '<link rel="stylesheet" type="text/css" href="css/main.css" />';
	} else {
		echo '<link rel="stylesheet/less" type="text/css" href="css/main.less" />';
	}
	 ?>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="css/hamburger.css">
	<link rel="stylesheet" href="css/slick.css">
	<link href="https://fonts.googleapis.com/css?family=Oswald|Roboto|Noto+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
	<link rel="stylesheet" href="css/loader.css">
	<link rel="stylesheet" href="css/show_effects.css">
	<link rel="stylesheet" href="css/input_elements.css">
	<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar_min.css">

	<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.8.1/less.min.js" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/jquery-form-elements.js"></script>

	<script type="text/javascript">
	window.onload = function () {

		innerEffects();
		let preload = document.querySelector('.preload');
		preload.classList.add('hide-preload');
		document.body.classList.remove('hide');
		setTimeout(()=>{
			preload.parentNode.removeChild(preload);
		},1000)
	}
</script>
</head>
<body class="hide">
	<div class="preload">
		<div class="loader-container">
			<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
		</div>
	</div>
	<?php
	include 'includes/nav.php';
	include 'includes/header.php';
	?>
	<?php
	if(empty($_GET['page'])){
		?>
		<?php
		include 'includes/rent.php';
		?>

		<?php
		include 'includes/info.php';
		?>

		<?php
		include 'includes/complect.php';
		?>

		<?php
		include 'includes/comments.php';
		?>
		<?php
		// include 'includes/partners.php';
		?>

		<?php
	} else {
		?>
		<?php
		include 'includes/buy.php';
		?>
		<?php
	}
	?>

	<?php	include 'includes/footer.php'; ?>
	<a href="#header" class="fas fa-arrow-circle-up" id="toTop"></a>

	<script src="js/parallax/parallax.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/comments.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<?php if(isset($_GET['page']) && $_GET['page'] == 'shop') { include 'shop/scripts.php'; } ?>
	<script>
	$(document).ready(function(){
		$('.slick').slick({
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: true,
						dots: false
					}
				},
				{
					breakpoint: 780,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 580,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});

		$('select').dropdown({maxItems: 5});

		$('input[type=file]').inputfile();

		$('input[type=checkbox]').customCheckbox();

		$('input[type=radio]').customRadio();
	});


	</script>


</body>
</html>
