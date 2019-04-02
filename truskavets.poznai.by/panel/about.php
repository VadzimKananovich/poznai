<?php

$path = '../';
include '../includes/_main.php';
include 'includes/check_user.php';
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>About</title>
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
<div id="aboutContainer"></div>
<div id="contactsContainer"></div>


<script type="text/javascript" src="js/contacts.js"></script>
<?php
include 'includes/scripts.php';
?>

<script>

new Admin({
	'container':'#aboutContainer',
	'json':'JSON/about.json',
	'request_file':'includes/request.php',
	'developer':false,
	'items':{
		'text':{
			'companyName':'Название компании',
			'companyLegalName':'Легальное название',
			'foundingDate':'Год основания',
			'companyDesc':'Описание компании'
		}
	},
	'jsonTitle':'О компании',
	'table':['logo','favicon'],
	'logo':{
		'type':'normal',
		'array':'logo',
		'items':{
			'logoTitle':'Загаловок логотипа',
			'img':'Логотип'
		},
		'imgPath':'imgPath',
		'text':['logoTitle'],
		'singleImg':['img'],
		'rowControl':['delBtn'],
		'tableControl':['saveBtn'],
		'rowHeight':'50px',
		'tableTitle':'Логотип'
	},
	'favicon':{
		'type':'normal',
		'array':'favicon',
		'items':{'img':'Иконка'},
		'imgPath':'imgPath',
		'singleImg':['img'],
		'rowControl':[],
		'tableControl':['saveBtn'],
		'rowHeight':'30px',
		'tableTitle':'Иконка сайта'
	}
});


new Admin({
	'container':'#contactsContainer',
	'json':'JSON/contacts.json',
	'request_file':'includes/request.php',
	'developer':false,
	'items':{'text':{
		'country':'Страна',
		'region':'Область',
		'city':'Город',
		'address':'Адрес',
		'postal':'Идекс'
	}},
	'jsonTitle':'Контактные данные',
	'table':['email','phone','social'],
	'email':{
		'type':'list',
		'array':'email',
		'text':true,
		'items':['Email'],
		'tableTitle':'Email'
	},
	'phone':{
		'type':'normal',
		'array':'phone',
		'items':{
			'tel':'Телефон',
			'operator':'Оператор',
			'messenger':'Messenger'
		},
		'text':['tel'],
		'operator':['operator'],
		'messenger':['messenger'],
		'tableTitle':'Телефоны'
	},
	'social':{
		'type':'normal',
		'array':'social',
		'items':{
			'link':'Адрес в сети',
			'name':'Социальная сеть'
		},
		'text':['link'],
		'social':['name'],
		'tableTitle':'В соц. сецях'
	}
});

</script>
<?php
} else {
header('Location: ./');
}
?>
