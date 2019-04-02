<?php
include 'includes/_main.php';
include 'includes/_company_info.php';
include 'includes/_classes.php';
include 'includes/functions.php';
$path = '';
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<meta name="yandex-verification" content="890a80804a44997b" />
	<meta name="description" content="Горнолыжный курорт Трускавец. Горный воздух, горная вода, оздоровительная программа. Все включено!">
	<meta name="keywords" content="буковель, ворохта, карпаты, курорт, горы, poznai, минск, все включено">
	<title>Туры в Трускавец из Минска - отдых для всей семьи в Украине</title>

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

	<link rel="stylesheet" href="<?php echo $src_url; ?>css/main-min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link href="<?php echo $src_url; ?>css/owl/owl.carousel.min.css" rel="stylesheet">
	<link href="<?php echo $src_url; ?>css/owl/owl.theme.default.min.css" rel="stylesheet">
	<link href="<?php echo $src_url; ?>css/animate.css" rel="stylesheet">
	<link href="<?php echo $src_url; ?>css/magnific-popup.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $src_url; ?>css/jquery.mCustomScrollbar.min.css" />
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script type="application/ld+json">
	<?php echo $_json_ld_organization; ?>
	</script>
	<?php echo $_meta_tags; ?>

	<meta name="google-site-verification" content="g194PVlWIaCf1pTRumecZXpD0sYQAp-yXuc1L5zGp2k" />
</head>
<body>

	<?php
	include 'includes/nav.php';
	include 'includes/preloader.php';
	include 'includes/blocks/header.php';
	include 'includes/blocks/relax.php';
	include 'includes/blocks/tour_include.php';
	include 'includes/blocks/hotel.php';
	include 'includes/blocks/price.php';
	include 'includes/blocks/program.php';
	include 'includes/modal.php';
	include 'includes/footer.php';

	?>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.0-rc.1/jquery-ui.min.js" integrity="sha256-mFypf4R+nyQVTrc8dBd0DKddGB5AedThU73sLmLWdc0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="<?php echo $src_url; ?>js/owl.carousel.min.js"></script>
	<script src="<?php echo $src_url; ?>js/parallax.min.js"></script>

	<script src="<?php echo $src_url; ?>js/preloader.js"></script>
	<script src="<?php echo $src_url; ?>js/filter_nav_active.js"></script>
	<script src="<?php echo $src_url; ?>js/land_page_menu.js"></script>
	<script src="<?php echo $src_url; ?>js/program_days.js"></script>
	<script src="<?php echo $src_url; ?>js/contact.js"></script>
	<script src="<?php echo $src_url; ?>js/price_rooms.js"></script>


	<script src="<?php echo $src_url; ?>js/jquery.filterizr.min.js"></script>
	<script src="<?php echo $src_url; ?>js/jquery.magnific-popup.js"></script>
	<script src="<?php echo $src_url; ?>js/jquery.mCustomScrollbar.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@14.0/dist/smooth-scroll.polyfills.min.js"></script>
	<script>
	// var src_url = 'http://vadzim.ddns.net/truskavets_new/app/';
	// var src_url = 'http://192.168.1.6:888/trsucavets.poznay.by/';
	var src_url = 'http://truskavets.poznai.by/';

	new Preloader;
	new Contact({
		'container':'.form-contact',
		'url':'includes/request.php?action=send_mail',
		'input':['name','email'],
		'submit':'#sendHeader'
	});
	$(document).ready(function() {
		$('#relaxCarousel').owlCarousel({
			nav : true,
			slideSpeed : 300,
			paginationSpeed : 400,
			items:1,
			autoplay:true,
			loop: true,
			animateIn:'fadeIn',
			animateOut:'fadeOut',
			autoplayHoverPause:true
		});
		$('.dropdown').on('show.bs.dropdown', function() {
			$(this).find('.dropdown-menu').first().stop(true, true).slideDown();
		});

		$('.dropdown').on('hide.bs.dropdown', function() {
			$(this).find('.dropdown-menu').first().stop(true, true).slideUp();
		});

		$('.filtr-container').filterizr({
			animationDuration: 0.5,
			layout:'sameSize'
		});
		$('.filtr-container').magnificPopup({
			delegate: 'a',
			type: 'image',
			callbacks: {
				elementParse: function(item) {
					this.st.image.markup =
					this.st.image.markup.replace('mfp-figure', 'mfp-figure animated ' + 'zoomIn');
				}
			},
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1]
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			}
		});
		$('.prgram-days-carousel').owlCarousel({
			nav : true,
			slideSpeed : 300,
			paginationSpeed : 400,
			items:5,
			autoplay:true,
			autoplayHoverPause:true
		});
	});
	new PriceRooms('.price-section');
	new LandPageMenu('#topMenu',70);
	new ProgramDays('#day2','JSON/program/day2.json','single',src_url);
	new ProgramDays('#day3','JSON/program/day3.json','modal',src_url);
	new ProgramDays('#day4','JSON/program/day4.json','modal',src_url);
	new ProgramDays('#day5','JSON/program/day5.json','modal',src_url);
	new ProgramDays('#day6','JSON/program/day6.json','modal',src_url);
	new ProgramDays('#day7','JSON/program/day7.json','modal',src_url);
	new ProgramDays('#day8','JSON/program/day8.json','single',src_url);
	window.addEventListener('load',()=>{
		AOS.init({duration: 1200});
		new FilterNavActive('.filter-nav','li',AOS.refresh);
	});
</script>
</body>
</html>
