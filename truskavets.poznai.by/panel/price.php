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
	<div id="priceContainer"></div>
	<?php

	include 'includes/scripts.php';
	?>

	<script type="text/javascript">

	new Admin({
		'container':'#priceContainer',
		'json':'JSON/price.json',
		'request_file':'includes/request.php',
		'developer':false,
		'items':{'text':{
			'section_title':'Загаловок',
			'section_sub_title':'Подзаголовок',
			'dolar':'Курс Доллара:'
		}},
		'jsonTitle':'Цены тура',
		'table':{
			'type':'normal',
			'array':'price',
			'items':{
				'date':'Даты',
				'4family':'4-х местный семейный',
				'3econom':'3-х местный эконом',
				'23econom':'2-х местный эконом или 3-х местный',
				'2room':'2-х местный',
				'2lux':'2-х местный полулюкс',
				'1room':'1-но местный',
				'offer':'Событие',
			},
			'text':['4family','3econom','23econom','2room','2lux','1room','offer'],
			'dateMultiRange':['date']
		}
		// 'initialize':price
	});
	</script>
</body>
</html>
<?php
} else {
header('Location: ./');
}
?>
