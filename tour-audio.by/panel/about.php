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

new Admin(['includes/request.php','JSON/__about_company.json']);

new Admin(['includes/request.php','JSON/__contacts.json']);

</script>
<?php
} else {
header('Location: ./');
}
?>
