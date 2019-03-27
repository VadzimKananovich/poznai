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
	<div id="commentsContainer"></div>

	<?php
	include 'includes/scripts.php';
	?>

	<script>
	
	new Admin (['includes/request.php','JSON/__comments.json']);

</script>
<?php
} else {
	include 'login.php';
}
?>
