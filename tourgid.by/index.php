<?php
include 'includes/_main.php';
include 'includes/_classes.php';
include 'includes/_company_info.php';


$info = new CompanyInfo(array(
	'url'=>$url,
	'numRegional'=>'BEL',
));

$info->create_schema_ld();
$about = &$info->about;
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
	<title>Тур АудиоГид</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<meta name="description" content="Продажа/аренда радиогидов и оборудования для синхронного перевода, экскурсий, конференций с доставкой по лучшей цене. Гарантия качественного звука.">
	<meta name="keywords" content="радиогид, купить, арендовать, минск, беларусь">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= $url; ?>css/main.css?version=<?php echo uniqid(); ?>">
	<link rel="stylesheet" href="<?= $url; ?>css/modal.css?version=<?php echo uniqid(); ?>">
	<link rel="stylesheet" href="<?= $url; ?>css/native_carousel.css?version=<?php echo uniqid(); ?>">
	<link rel="stylesheet" href="<?= $url; ?>css/animate.css?version=<?php echo uniqid(); ?>">
	<link rel="stylesheet" href="<?= $url; ?>css/owl.carousel.min.css?version=<?php echo uniqid(); ?>">
	<link rel="stylesheet" href="<?= $url; ?>css/owl.theme.default.min.css?version=<?php echo uniqid(); ?>">
	<link rel="stylesheet" href="<?= $url; ?>css/check_form.css?version=<?php echo uniqid(); ?>">
	<link rel="stylesheet" href="<?= $url; ?>css/icons.css?version=<?php echo uniqid(); ?>">
	<link rel="stylesheet" href="<?= $url; ?>css/preloader.css?version=<?php echo uniqid(); ?>">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Roboto|Roboto:900|Roboto:700|Roboto:400" rel="stylesheet">
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
	<?php
	echo $info->json_organisation;
	?>
	</script>
	<?php
	echo $info->meta_tags;
	?>
</head>

<body>

	<?php
	include 'includes/nav.php';
	?>

	<header id="header" class="header">
		<div class="owl-carousel">
			<?php new HeaderSlider($src_url); ?>
		</div>
	</header>

	<section class="counter-section" id="counterSection">
		<?php new Counter($src_url); ?>
	</section>

	<section class="about-product" id="aboutProduct">
		<?php new AboutProduct($src_url); ?>
	</section>

	<section class="contact-section" id="contactSection">
		<?php new Contact($src_url); ?>
		<form class="contact-form" action="includes/request.php?action=contact_mail" method="post" id="emailForm">
			<div class="form-group">
				<label for="mailName">Имя<span class="label-required">*</span></label>
				<input class="bg-input person" type="text" name="mailName" id="mailName" required>
			</div>
			<div class="form-group">
				<label for="mailEmail">Email<span class="label-required">*</span></label>
				<input class="bg-input email" type="email" name="mailEmail" id="mailEmail" required>
			</div>
			<div class="form-group">
				<label for="mailNum">Телефон</label>
				<input class="bg-input phone" type="text" name="mailNum" id="mailNum">
			</div>
			<div class="form-group">
				<label for="mailMsg">Сообщение</label>
				<textarea name="mailMsg" id="mailMsg"></textarea>
			</div>
			<div class="btn-group right">
				<button type="submit" name="button" class="btn">отправить</button>
			</div>
		</form>
	</section>
	<?php
	include 'includes/footer.php';
	include 'includes/modal.php';
	include 'includes/preloader.php';
	?>



	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.0-rc.1/jquery-ui.min.js" integrity="sha256-mFypf4R+nyQVTrc8dBd0DKddGB5AedThU73sLmLWdc0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="<?= $url; ?>js/apply_aos.js?version=<?php echo uniqid(); ?>"></script>
	<script src="<?= $url; ?>js/modal.js?version=<?php echo uniqid(); ?>"></script>
	<script src="<?= $url; ?>js/counter.js?version=<?php echo uniqid(); ?>"></script>
	<script src="<?= $url; ?>js/land_nav.js?version=<?php echo uniqid(); ?>"></script>
	<script src="<?= $url; ?>js/owl.carousel.min.js?version=<?php echo uniqid(); ?>"></script>
	<script src="<?= $url; ?>js/owl_animate.js?version=<?php echo uniqid(); ?>"></script>
	<script src="<?= $url; ?>js/navbar_collapse.js?version=<?php echo uniqid(); ?>"></script>
	<script src="<?= $url; ?>js/back_to_top.js?version=<?php echo uniqid(); ?>"></script>
	<script src="<?= $url; ?>js/preloader.js?version=<?php echo uniqid(); ?>"></script>

	<script>

	new Preloader();

	new Modal({
		'from':'top',
		'transition':'.4',
		'width':'900px'
	});

	new LandNav({
		'container':'#navBar',
		'navigate':false
	});

	new OwlAnimate({
		'container':'.owl-carousel',
		'owlSet':{
			'items':1,
			'loop':true,
			'nav': true,
			'dots': true,
			'autoplay': false
		},
		'animate':{
			'items':['.like-h1','.section-content'],
			// 'animateCss':['fadeIn','bounceIn'],
			'nth-1': {
				'animateCss': ['slideInDown','slideInRight']
			},
			'nth-2': {
				'animateCss': ['slideInLeft','slideInUp']
			}
		}
	});

	new Counter({
		'item':'.counter',
		'delay': 100,
		'time': 30
	});

	new ApplyAos({
		'items':[
			'.counter-item',
			'.contact-form',
			'.sub-title',
			'.about-product .section-img',
			'.about-product .section-content',
			'.about-product .reverse .section-img',
			'.about-product .reverse .section-content'
		],
		'animate':[
			'fade-up',
			'fade-right',
			'fade-up',
			'fade-right',
			'fade-left',
			'fade-left',
			'fade-right'
		],
		'globalSet':{
			'duration': 1000
		}
	});

	new NavbarCollapse();

	jQuery.extend(jQuery.validator.messages, {
		required: "Заполните это поле",
		remote: "Please fix this field.",
		email: "Введите корректный адрес",
		url: "Please enter a valid URL.",
		date: "Please enter a valid date.",
		dateISO: "Please enter a valid date (ISO).",
		number: "Please enter a valid number.",
		digits: "Please enter only digits.",
		creditcard: "Please enter a valid credit card number.",
		equalTo: "Please enter the same value again.",
		accept: "Please enter a value with a valid extension.",
		maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
		minlength: jQuery.validator.format("Please enter at least {0} characters."),
		rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
		range: jQuery.validator.format("Please enter a value between {0} and {1}."),
		max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
		min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
	});

	$('#emailForm').validate({
		submitHandler: (form) => {
			let p = document.createElement('p');
			p.className = 'success-msg';
			p.innerHTML = 'Ваше сообщение успешно отправлено<br>В ближайеше время с Вами свяжется наш специалист';
			p.style.transition = '.3s';
			let group = form.querySelector('.btn-group');
			group.parentNode.insertBefore(p,group);
			setTimeout(()=>{
				p.style.opacity = '0';
				setTimeout(()=>{
					p.parentNode.removeChild(p);
				},300);
			},5000);
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				success: (res) => {
					console.log(JSON.parse(res));
				}
			});
		},
	});

	$('#modalContactForm').validate({
		submitHandler: (form) => {
			let p = document.createElement('p');
			p.className = 'success-msg';
			p.innerHTML = 'Ваше сообщение успешно отправлено<br>В ближайеше время с Вами свяжется наш специалист';
			p.style.transition = '.3s';
			let group = form.querySelector('.btn-group');
			group.parentNode.insertBefore(p,group);
			setTimeout(()=>{
				p.style.opacity = '0';
				setTimeout(()=>{
					p.parentNode.removeChild(p);
				},300);
			},5000);
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				success: (res) => {
					console.log(JSON.parse(res));
				}
			});
		},
	});

	new BackToTop({
		'set':'asdasd'
	});

</script>
</body>

</html>
