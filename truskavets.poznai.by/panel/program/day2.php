<?php

$path = '../';
include '../../includes/_main.php';
include '../includes/check_user.php';
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
	<meta charset="utf-8">
	<title></title>
	<?php
	include '../includes/head.php';
	$_user = check_user('../users.json');
	if($_user){
	?>
</head>
<body>
	<?php	include '../includes/nav.php';	?>

	<div id="day2"></div>
	<?php include '../includes/scripts.php';	?>

	<script type="text/javascript">
	new Admin({
		'container':'#day2',
		'request_file':'../includes/request.php',
		'curr_path':'../',
		'json':'JSON/program/day2.json',
		'developer':false,
		'items':{'title':'title'},
		'table':{
			'type':'normal',
			'array':'program',
			'items':{
				'name':'Название программы',
				'desc':'Описание',
				'img':'Картинки'
			},
			'text':['name','desc'],
			'sliderImg':['img'],
			'imgPath':'imgPath'
		}
		// 'initialize':program
	});
</script>
</body>
</html>
<?php
} else {
header('Location: ../');
}
?>
