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
</body>
</html>
<?php
} else {
header('Location: ./');
}
?>
