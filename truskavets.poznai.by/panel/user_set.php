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

</body>
</html>

<?php

include 'includes/nav.php';
?>
<div id="userSet"></div>
<div id="relaxContainer"></div>
<div id="tourIncludeContainer"></div>

<?php
include 'includes/scripts.php';
?>


<script>

new Admin({
	'container':'#userSet',
	'json':'panel/users.json',
	'request_file':'includes/request.php',
	'jsonTitle':'Настройки аккаунта',
	'developer':false,
	'table':{
		'type':'normal',
		'array':'users',
		'items':{
			'name':'Имя',
			'password':'Пароль'
		},
		'rowControl':[],
		'tableControl':['saveBtn'],
		'text':['name','password'],
	}
});

</script>
<?php
} else {
header('Location: ./');
}
?>
