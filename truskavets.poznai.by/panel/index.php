<?php

$path = '../';
include '../includes/_main.php';
include 'includes/check_user.php';

?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>CPanel</title>
	<?php
	include 'includes/head.php';
		$_user = check_user();
		if($_user){
	?>
</head>
<body>

</body>
</html>

<?php

include 'includes/nav.php';
?>
<div id="headerContainer"></div>
<div id="relaxContainer"></div>
<div id="tourIncludeContainer"></div>

<?php
include 'includes/scripts.php';
?>


<script>

new Admin({
	'container':'#headerContainer',
	'json':'JSON/header.json',
	'request_file':'includes/request.php',
	'jsonTitle':'Шапка',
	'developer':false,
	'table':{
		'type':'normal',
		'array':'bgImg',
		'items':{
			'title':'Загаловок',
			'sub_title':'Описание',
			'img':'Фон'
		},
		'imgPath':'imgPath',
		'singleImg':['img'],
		'text':['title','sub_title'],
		'rowControl':['delBtn'],
		'tableControl':['saveBtn'],
		'rowHeight':'50px'
	}
});



new Admin({
	'container':'#relaxContainer',
	'json':'JSON/relax.json',
	'request_file':'includes/request.php',
	'jsonTitle':'Интересные места Трускавца',
	'items':{'text':{
		'section_title':'Загаловок',
		'section_sub_title':'Подзаголовок'
	}},
	'table':{
		'type':'normal',
		'array':'slider',
		'items':{
			'title':'Загаловок',
			'desc':'Описание',
			'img':'Картинка'
		},
		'imgPath':'imgPath',
		'text':['title','desc'],
		'singleImg':['img']
	}
});


new Admin({
	'container':'#tourIncludeContainer',
	'json':'JSON/tourInclude.json',
	'request_file':'includes/request.php',
	'jsonTitle':'В тур входит',
	'items':{'text':{
		'section_title':'Загаловок'
	}},
	'table':{
		'type':'list',
		'array':'tour_include_list',
		'text':true,
		'items':['Список']
	}
});

</script>
<?php
} else {
	include 'login.php';
}
?>
