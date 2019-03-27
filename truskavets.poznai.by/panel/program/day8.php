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

	<div id="day"></div>
	<?php include '../includes/scripts.php';	?>

	<script type="text/javascript">
	new Admin({
		'container':'#day',
		'request_file':'../includes/request.php',
		'curr_path':'../',
		'json':'JSON/program/day8.json',
		'items':{'title':'title'},
		'developer':false,
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
	});
</script>
</body>
</html>
<?php
} else {
header('Location: ../');
}
?>
