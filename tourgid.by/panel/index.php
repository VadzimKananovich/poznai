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
	<div id="tourAudioContainer"></div>
	<div id="productContainer"></div>
	<div id="withUs"></div>
	<div id="contactSection"></div>

	<?php
	include 'includes/scripts.php';
	?>

	<script>

	new Admin (['includes/request.php','JSON/__header.json']);
	new Admin (['includes/request.php','JSON/__tourAudio.json']);
	new Admin (['includes/request.php','JSON/__products.json']);
	new Admin(['includes/request.php','JSON/__contact_section.json']);
	// {
	// 		"container": "#productContainer",
	// 		"json": "JSON/products.json",
	// 		"request_file": "includes/request.php",
	// 		"jsonTitle": "Оборудование",
	// 		"developer": false,
	// 		"table": {
	// 			"type": "normal",
	// 			"array": "products",
	// 			"items": {
	// 				"title": "Загаловок",
	// 				"desc": "описание",
	// 				'img':'Картинка'
	// 			},
	// 			"itemsSize": {
	// 				"title": "200px",
	// 				"img": "200px"
	// 			},
	// 			"imgPath": "imgPath",
	// 			"singleImg": ["img"],
	// 			"text": ["title","desc"],
	// 			"rowHeight": "50px"
	// 		},
	// 		// 'initialize': product
	// 		'writeSet':'JSON/__products.json'
	// 	}

</script>
<?php
} else {
	include 'login.php';
}
?>
