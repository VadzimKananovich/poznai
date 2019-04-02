<?php
$path = '../';
include '../includes/_main.php';
include 'includes/check_user.php';
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
	<meta charset="utf-8">
	<title></title>
	<?php
	include 'includes/head.php';
	$_user = check_user();
	if($_user){
	?>
</head>
<body>
	<?php
	include 'includes/nav.php';
	?>
	<div id="hotelContainer"></div>
	<?php
	include 'includes/scripts.php';
	?>

	<script type="text/javascript">
	new Admin({
		'container':'#hotelContainer',
		'json':'JSON/hotel.json',
		'request_file':'includes/request.php',
		'jsonTitle':'Гостиница',
		'developer':false,
		'items':{'text':{
			'section_title':'Загаловок'
		}},
		'table':{
			'type':'normal',
			'array':'rooms',
			'items':{
				'name':'Тип комнаты',
				'img':'Картинки'
			},
			'text':['name'],
			'sliderImg':['img'],
			'imgPath':'imgPath'
		}
	});
</script>
</body>
</html>
<?php
} else {
header('Location: ./');
}
?>
