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
	<?php	include 'includes/nav.php';	?>

	<div class="container-fluid" id="day2"></div>
	<hr class="mrt-2 mrb-2">
	<div class="container-fluid" id="day3"></div>
	<hr class="mrt-2 mrb-2">
	<div class="container-fluid" id="day4"></div>
	<hr class="mrt-2 mrb-2">
	<div class="container-fluid" id="day5"></div>
	<hr class="mrt-2 mrb-2">
	<div class="container-fluid" id="day6"></div>
	<hr class="mrt-2 mrb-2">
	<div class="container-fluid" id="day7"></div>
	<hr class="mrt-2 mrb-2">
	<div class="container-fluid" id="day8"></div>
	<hr class="mrt-2 mrb-2">

	<?php include 'includes/scripts.php';	?>

	<script type="text/javascript">
	let program = {
		'title':'Первый день',
		'program':[
			{
				'name':'4asacdascascasc-x местный семейный',
				'desc':'1-й description',
				'img':['first.jpg','second.jpg','third.jpg'],
				'imgPath':'img/  program/   day2/program1  '
			},
			{
				'name':'5-x местный семейный',
				'desc':'2-й description',
				'img':['first.jpg','second.jpg','third.jpg'],
				'imgPath':'img/  program/   day2/program2  '
			},
			{
				'name':'6-x местный семейный',
				'desc':'3-й descption',
				'img':['first.jpg','second.jpg','third.jpg'],
				'imgPath':'img/  program/   day2/program3  '
			}
		]
	}
	new Admin({
		'container':'#day2',
		'json':'JSON/program/day2.json',
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
	new Admin({
		'container':'#day3',
		'json':'JSON/program/day3.json',
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
	new Admin({
		'container':'#day4',
		'json':'JSON/program/day4.json',
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
	new Admin({
		'container':'#day5',
		'json':'JSON/program/day5.json',
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
	new Admin({
		'container':'#day6',
		'json':'JSON/program/day6.json',
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
	new Admin({
		'container':'#day7',
		'json':'JSON/program/day7.json',
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
	new Admin({
		'container':'#day8',
		'json':'JSON/program/day8.json',
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
header('Location: ./');
}
?>
