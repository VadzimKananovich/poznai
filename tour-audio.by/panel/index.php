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
	<div id="aboutContent"></div>
	<div id="whyWe"></div>
	<div id="withUs"></div>

	<?php
	include 'includes/scripts.php';
	?>

	<script>



	new Admin (['includes/request.php','JSON/__header.json']);
	new Admin (['includes/request.php','JSON/__about.json']);
	new Admin (['includes/request.php','JSON/__whyWe.json']);
	new Admin (['includes/request.php','JSON/__withUs.json']);

</script>
<?php
} else {
	include 'login.php';
}
?>
