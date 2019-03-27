<?php
include 'includes/_main.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Ponzai.bel</title>
	<?php
	include 'includes/_stylesheet.php';
	?>
	<link rel="stylesheet" href="css/interesting.css">
	<link rel="stylesheet" href="css/popular.css">
</head>
<body class="size-1140">
	<?php
	include 'includes/nav.php';
	include 'includes/header.php';
	?>

	<?php
	include 'includes/home/interesting.php';
	include 'includes/home/tourinclude.php';
	include 'includes/home/popular.php';
	?>


	<?php
	include 'includes/footer.php';
	include 'includes/modal.php';
	include 'includes/_scripts.php';
	?>
	<script src="js/popular.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script>

	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {
			if( direction === 'down' && !$(this.element).hasClass('animated') ) {

				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							el.addClass('fadeInUp animated');
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});

				}, 100);

			}

		} , { offset: '85%' } );
	};
	contentWayPoint();
	let vad = new JSONconnect('vadzim','arrogaminca');
	new AnimateBox;
	
	</script>
</body>
</html>
