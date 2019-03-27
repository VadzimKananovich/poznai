<?php
include 'includes/_main.php';
include 'includes/_company_info.php';
include 'includes/_class.php';
?>
<html lang="ru" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Радиогиды в Беларуси Оборудование для синхронного перевода</title>
	<meta name="description" content="Продажа/аренда радиогидов и оборудования для синхронного перевода, экскурсий, конференций с доставкой по лучшей цене. Гарантия качественного звука.">
	<meta name="keywords" content="радиогид, купить, арендовать, минск, беларусь">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootsnav.css">
	<link rel="stylesheet" href="css/custom.css" />
	<link rel="stylesheet" href="css/animate.css" />
	<link rel="stylesheet" href="css/icons.css" />
	<link rel="stylesheet" href="css/check_form.css" />
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= $url; ?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= $url; ?>css/owl.theme.default.min.css">


	<?php
	if(file_exists('favicon.ico')){
		echo '<link rel="shortcut icon" href="'.$url.'/favicon.ico" />';
	}
	if(file_exists('favicon.png')){
		echo '<link rel="shortcut icon" href="'.$url.'/favicon.png" />';
	}
	if(file_exists('favicon.gif')){
		echo '<link rel="shortcut icon" href="'.$url.'/favicon.gif" />';
	}
	?>

	<script type="application/ld+json">
	<?php echo $_json_ld_organization; ?>
	</script>
	<?php echo $_meta_tags; ?>
	<meta name="google-site-verification" content="76o1BSCDFg9e3a5PCMmq413azzhCLuFNneFZpcYSrxY" />
	<meta name="yandex-verification" content="02554eb54d482fcf" />
</head>
<body>

	<?php
	include 'includes/preloader.php';
	include 'includes/header.php';
	include 'includes/home.php';
	include 'includes/aboutProduct.php';
	include 'includes/why_us.php';
	include 'includes/with_us.php';
	include 'includes/testimonial.php';
	include 'includes/contact.php';
	include 'includes/footer.php';
	include 'includes/modal.php';
	?>

	<script src="js/common_functions.js"></script>
	<script src="js/jquery-1.12.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="js/main.js"></script>
	<script src="js/jquery.paroller.min.js"></script>
	<script src="js/land_page_menu.js"></script>
	<script src="js/check_form.js"></script>
	<script src="js/owl.carousel.min.js"></script>

	<script>
	AOS.init({
		disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
		startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
		offset: 300, // offset (in px) from the original trigger point
		delay: 0, // values from 0 to 3000, with step 50ms
		duration: 2000, // values from 0 to 3000, with step 50ms
		easing: 'ease-out', // default easing for AOS animations
		once: false, // whether animation should happen only once - while scrolling down
		mirror: false, // whether elements should animate out while scrolling past them
	});
	new LandPageMenu('#topMenu',70);

	new Header('#carousel');

	new CheckForm({
		'form':'#backCallForm'
	});
	new CheckForm({
		'form':'#ContactForm'
	});
	$(document).ready(function(){
	  $("#carousel").owlCarousel({
			'items':1,
			'loop':true,
			'nav': true,
			'dots': false,
			'autoplay': true,
			'autoplayHoverPause': true
		});
	});

</script>
</body>
</html>
