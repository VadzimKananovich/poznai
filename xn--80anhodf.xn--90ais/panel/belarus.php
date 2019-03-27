<?php
$path = '../';
include '../includes/_main.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="owl-carousel/owl.theme.css">

	<title>Ponzai.bel - Cpanel</title>

</head>

<body>
	<?php
	if(isset($_SESSION['user'])){
		include 'includes/nav.php';
		include 'includes/belarus_tours.php';
	} else {
		header('location: index.php');
	}
	?>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.0-rc.1/jquery-ui.min.js" integrity="sha256-mFypf4R+nyQVTrc8dBd0DKddGB5AedThU73sLmLWdc0=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
	<script type="text/javascript" src="js/table.js"></script>
	<script type="text/javascript" src="js/tours/table.js"></script>
	<script type="text/javascript" src="js/tours/tours_admin.js"></script>
	<script type="text/javascript" src="js/nicEdit.js"></script>

	<script>
	new ToursAdmin('belarus');
	bkLib.onDomLoaded(function() {
		let itemsTextEditable = ['fontSize','bold','italic','underline','strikeThrough','link','unlink','hr','outdent','indent','justify','left','center','right','ol','ul','forecolor','bgcolor','image','html'];
		new nicEditor({
			'buttonList' : itemsTextEditable
		}).panelInstance('inputDesc');
		new nicEditor({
			'buttonList' : itemsTextEditable
		}).panelInstance('inputRoute');
		new nicEditor({
			'buttonList' : itemsTextEditable
		}).panelInstance('inputProgram');


		new nicEditor({
			'buttonList' : itemsTextEditable
		}).panelInstance('inputDescAdd');
		new nicEditor({
			'buttonList' : itemsTextEditable
		}).panelInstance('inputRouteAdd');
		new nicEditor({
			'buttonList' : itemsTextEditable
		}).panelInstance('inputProgramAdd');
	});
	</script>
</body>

</html>
