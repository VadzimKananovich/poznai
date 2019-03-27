<?php
$path = '';
include 'includes/_main.php';
$curr_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<?php
	include 'includes/create_schema.php';
	if(isset($_GET['preview'])){
		$key = urldecode($_GET['key']);
		$item = urldecode($_GET['item']);
		$json_ld_preview = create_schema_preview($key,$item);
		$page_title = 'Познай Бел ✪✪✪ ❝'.$json_ld_preview[2].'❞';
		$page_logo = $url.$json_ld_preview[1];
		$page_desc = $json_ld_preview[2].'. ➢ '.$json_ld_preview[3];
		// $im_keywords = implode(',',$json_ld_preview[2]);
		$page_keywords = 'экскурсии, Беларусь, познай, бел, сборные туры, корпоративные группы, школьные группы';
	} else {
		$page_title = 'Познай Бел ✪✪✪ туры и экскурсии по всей Беларуси';
		$page_desc = '
		Тур в Беларусь ➢ сборные туры и экскурсии для детских, взрослых групп и семейные.
		Экскурсии по Беларуси ➢ сборные туры для детских и взрослых групп.
		① Выбираете тур, ② Оставляете заявку, ③ Наш специалист с вами связывается
		';
		$page_keywords = 'экскурсии по беларуси, экскурсии из минска по беларуси, экскурсии в беларусь из москвы, экскурсия минск, тур беларусь, беларусь отдых, беларусь достопримечательность';
	}
	?>
	<meta charset="utf-8">
	<title><?php echo $page_title; ?></title>
	<meta name="description" content="<?php echo $page_desc; ?>">
	<meta name="keywords" content="<?php echo $page_keywords; ?>">
	<?php
	include 'includes/_stylesheet.php';

	$json_ld = create_contact_schema();
	?>

	<link rel="stylesheet" href="css/interesting.css">
	<link rel="stylesheet" href="css/popular.css">

	<?php  if(empty($_GET['preview'])) { ?>
		<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "Organization",
			"url": "<?php echo $url; ?>",
			"name": "Познай.бел",
			"description": "Познай Бел ✪✪✪ туры и экскурсии по всей Беларуси",
			"sameAs": [
				<?php
				for($i = 0; $i < count($json_ld[5]); $i++){
					if($i === count($json_ld[5])-1){
						echo '"'.$json_ld[5][$i]->link.'"';
					} else {
						echo '"'.$json_ld[5][$i]->link.'",';
					}
				}
				?>
			],
			"logo": "<?php echo $url; ?>img/logo/logo.png",
			"address": {
				"addressCountry": "BY",
				"addressRegion": "<?php echo $json_ld[0]; ?>",
				"postalCode": "<?php echo $json_ld[2]; ?>",
				"streetAddress": "<?php echo $json_ld[1]; ?>"
			}
		}

	</script>
<?php } ?>
<meta itemprop="name" content="Познай.бел"/>
<meta itemprop="description" content="Познай Бел ✪✪✪ туры и экскурсии по всей Беларуси"/>
<meta itemprop="image" content="<?php echo $page_logo; ?>"/>

<meta property="og:locale" content="ru_RU"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $page_title; ?>"/>
<meta property="og:description" content="<?php echo $page_desc; ?>"/>
<meta property="og:image" content="<?php echo $page_logo; ?>"/>
<meta property="og:image:width" content="610">
<meta property="og:image:height" content="230">
<meta property="og:url" content="<?php echo $curr_url; ?>"/>
<meta property="og:site_name" content="Познай.бел"/>

<meta name="twitter:card" content="<?php echo $page_title; ?>">
<meta name="twitter:site" content="Познай.бел">
<meta name="twitter:title" content="<?php echo $page_title; ?>">
<meta name="twitter:description" content="<?php echo $page_desc; ?>">
<meta name="twitter:image" content="<?php echo $page_logo; ?>">

<meta name="google-site-verification" content="8-Fptx3aiOfpbsfBzWSXf9H_AxD9T6IdDAf86wuTbpo" />
<meta name="yandex-verification" content="668b18c57b751df3" />

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

ym(52679569, "init", {
	clickmap:true,
	trackLinks:true,
	accurateTrackBounce:true,
	webvisor:true
});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52679569" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>

<body class="size-1140">
	<?php
	include 'includes/nav.php';
	include 'includes/header.php';
	?>
	<?php
	include 'includes/home/present.php';
	include 'includes/home/tourinclude.php';
	include 'includes/home/interesting.php';
	if(isset($_GET['preview'])){
		include 'includes/home/_schema.php';
	}
	?>
	<?php
	include 'includes/footer.php';
	include 'includes/modal.php';
	include 'includes/_scripts.php';
	?>
	<script src="js/about_belarus.js"></script>
	<script src="js/animateBox.js"></script>
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
	new AnimateBox('fh5co-destination-list');
	new AboutBelarus('interestingBlock');
	</script>
</body>

</html>
<?php
?>
