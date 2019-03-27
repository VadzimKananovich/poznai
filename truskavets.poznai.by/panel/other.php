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
	<div class="container-fluid mrt-5" id="otherContainer"></div>
	<hr class="mrt-2 mrb-2">
	<?php
	include 'includes/scripts.php';
	?>

	<script type="text/javascript">
	let other = {
		'program_title':'Программа отдыха в Трускавце на 9/10 дней',
		'price_under_section':'ДЕТИ ДО 5 ЛЕТ - БЕСПЛАТНО (БЕЗ ПРЕТЕНЗИЙ НА УСЛУГИ). ДО 16 ЛЕТ - СКИДКА 20%.'
	}
	new Admin({
		'container':'#otherContainer',
		'json':'JSON/other.json',
		'request_file':'includes/request.php',
		'developer':false,
		'items':{'text':{
			'program_title':'Загаловок Блока программа тура',
			'price_under_section':'Доп. по стоимости',
			'program_sub_title':'Программа тура'
		}}
		// 'initialize':other
	});
</script>
</body>
</html>
<?php
} else {
header('Location: ./');
}
?>
