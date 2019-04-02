<?php
include 'includes/main.php';

if(isset($_GET['action'])) {
	if( $_GET['action'] === 'send_mail' ){
		mail('sales@poznai.by', $_POST['subject'], 'Вам написал: '.$_POST['name'].'<br />Его email: '.$_POST['email'].'<br />Сообщение:<br /> '.$_POST['message'],"Content-type:text/html;charset=utf-8");
		header("Location: $url#win2");
	}
	if( $_GET['action'] === 'send_modal' ){
		mail('sales@poznai.by', 'Письмо с hot-tour.poznai.by' , 'Вам написал: '.$_POST['name'].'<br />Его телефон: '.$_POST['tel'].'<br />Тур: '.$_POST['tour'],"Content-type:text/html;charset=utf-8");
		header("Location: $url#win1");
	}
	if($_GET['action'] === 'send_first_modal') {
		mail('sales@poznai.by', 'Письмо с hot-tour.poznai.by' , 'Вам написал: '.$_POST['modalName'].'<br />Его телефон: '.$_POST['modalTel'].'<br />Тур: '.$_POST['modalTour'],"Content-type:text/html;charset=utf-8");
		header("Location: $url#win1");
	}
}

// MYSQL CONNECTION / CREATE ARRAY COUNTRIES=========================================

include 'includes/mysqlConnect.php';

$query = 'SELECT country, price, currency, rus, rusCase, description, photo, flag, status FROM countries ORDER BY sort';

mysqli_set_charset($conn,'utf8');
$result = mysqli_query($conn,$query);

$countries = array();
while ($obj = mysqli_fetch_object($result)){
	array_push($countries,$obj);
}

// for($i = 0; $i < count($countries); $i++){
// 	echo '<img src="'.$imgUrl.$countries[$i]->photo.'" style="width:300px;height:175px;"><br><br>';
// }

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->


<head>
	<!-- meta character set -->
	<meta charset="utf-8">
	<!-- Always force latest IE rendering engine or request Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Горящие туры / poznai.by</title>
	<!-- Meta Description -->
	<meta name="description" content="Горящие туры">
	<meta name="keywords" content="горящие туры, горящие туры минск, тур, минск">
	<meta name="author" content="poznai.by">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSS
	================================================== -->

	<meta name="msapplication-TileColor" content="#ffc40d">
	<meta name="theme-color" content="#ffffff">
	<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700|Play:400,700' rel='stylesheet' type='text/css'>

	<!-- Fontawesome Icon font -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- bootstrap.min -->
	<link rel="stylesheet" href="css/jquery.fancybox.css">
	<!-- bootstrap.min -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- bootstrap.min -->
	<link rel="stylesheet" href="css/owl.carousel.css">
	<!-- bootstrap.min -->
	<link rel="stylesheet" href="css/slit-slider.css">
	<!-- bootstrap.min -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Main Stylesheet -->
	<link rel="stylesheet" href="css/main.css">
	<!-- Main Stylesheet -->
	<link rel="stylesheet" href="css/my_main.css">

	<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed|Scada" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- Modernizer Script for old Browsers -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<script src="js/jquery-1.11.1.min.js"></script>

	<script type="text/javascript">




	function clearBody () {
		let myBody = document.querySelector('body');
		if(myBody.classList.contains('modal-open')){
			myBody.classList.remove('modal-open');
		}
		myBody.style.paddingRight = '0';
	}
	$(window).on('load',function(){
		$('#myModal').modal('show');
		let myModal = document.querySelector('.my-modal-form-wrap');
		myModal.classList.add('show-modal');
	});
	</script>
	<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter25285517 = new Ya.Metrika({id:25285517,
                    webvisor:true,
                    clickmap:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/25285517" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>

<body id="body">

	<!-- preloader -->
	<div id="preloader">
		<div class="loder-box">
			<div class="battery"></div>
		</div>
	</div>
	<div class="my-modal" id="myModal">
		<div class="my-modal-form-wrap">
			<i class="fas fa-times" onclick="closeModal()"></i>
			<div class="my-modal-title">
				<h3>ВЫБЕРИТЕ СВОЙ ТУР</h3>
				<h4>ОСТАВЬТЕ ЗАЯВКУ</h4>
				<h5>НАШ МЕНЕДЖЕР С ВАМИ СВЯЖЕТСЯ</h5>
			</div>
			<div class="my-modal-form">
				<form class="modal-form" action="<?php echo $url; ?>?action=send_first_modal" method="post">
					<div class="form-row">
						<label for="name">Ваше имя:</label>
						<input type="text" name="modalName" id="modalName" placeholder="Ваше имя" required>
					</div>
					<div class="form-row">
						<label for="tel">Номер телефона:</label>
						<input type="text" name="modalTel" id="modalTel" placeholder="+375" required>
					</div>
					<input type="hidden" name="modalTour" id="modalTour" value="">
					<div class="form-row">
						<label for="tourList">Выберите тур:</label>
						<div class="tour-list-container">
							<span class="tour-list-label"><span class="tour-list-text-label">Выберите тур</span> <i class="fas fa-angle-down tour-list-label-ico"></i></span>

							<ul class="tour-list" id="tourList">
								<li class="tour-list-title">Горящие туры</li>
								<?php
								for($i = 0; $i < count($countries); $i++){
									if($countries[$i]->status == 'hot'){
										echo '<li class="tour-list-item" onclick="tourListFun(\''.$countries[$i]->rus.'\')"><img src="'.$flag.$countries[$i]->flag.'"><span class="tour-list-name">'.$countries[$i]->rus.'</span><span class="tour-list-prize">от '.$countries[$i]->currency.$countries[$i]->price.'</span></li>';
									}
								}
								?>
								<li class="tour-list-title">Раннее бронирование</li>
								<?php
								for($i = 0; $i < count($countries); $i++){
									if($countries[$i]->status == 'early'){
										echo '<li class="tour-list-item" onclick="tourListFun(\''.$countries[$i]->rus.'\')"><img src="'.$flag.$countries[$i]->flag.'"><span class="tour-list-name">'.$countries[$i]->rus.'</span><span class="tour-list-prize">от '.$countries[$i]->currency.$countries[$i]->price.'</span></li>';
									}
								}
								?>
							</ul>
						</div>
						<input type="hidden" name="tour" id="tour" value="<?php echo $modalName; ?>">
					</div>

					<div class="form-row-button">
						<button type="submit" name="sendTour" class="btn btn-blue btn-effect">Оставить заявку</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end preloader -->
	<a href="#x" class="overlayEmail" id="win2"></a>
	<div class="popupEmail">
		<h3>Сообщение успешно отправлено</h3>
		<a class="closeEmail" title="Закрыть" href="#close"></a>
	</div>

	<a href="#x" class="overlayTrue" id="win1"></a>
	<div class="popupTrue">
		<h3>Ваша заявка успешно отправлена</h3>
		<a class="closeTrue" title="Закрыть" href="#close"></a>
	</div>
	<!--
	Fixed Navigation
	==================================== -->
	<header id="navigation" class="navbar-inverse navbar-fixed-top animated-header">
		<div class="container">
			<div class="navbar-header">
				<!-- responsive nav button -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- /responsive nav button -->

				<!-- logo -->
				<h1 class="navbar-brand">
					<a href="http://www.poznai.by">Poznai.by</a>
				</h1>
				<!-- /logo -->
			</div>

			<!-- main nav -->
			<nav class="collapse navbar-collapse navbar-right" role="navigation">
				<ul id="nav" class="nav navbar-nav">
					<li><a href="#body">Горящие туры</a></li>
					<li><a href="#booking">Раннее бронирование</a></li>
					<li><a href="#about">О нас</a></li>
					<li><a href="#contact">Контакты</a></li>
				</ul>
			</nav>
			<!-- /main nav -->

		</div>
	</header>
	<!--
	End Fixed Navigation
	==================================== -->

	<main class="site-content" role="main">

		<!--
		Home Slider
		==================================== -->

		<section id="home-slider">
			<div id="slider" class="sl-slider-wrapper">

				<div class="sl-slider">
					<?php
					for($i = 0; $i < count($countries); $i++){
						if($countries[$i]->status == 'hot'){
							$modalId = 'modal'.$countries[$i]->country;
							$flagModal = $flag.$countries[$i]->flag;
							$modalName = $countries[$i]->rus;
							$modalDescription = $countries[$i]->description;
							echo '
							<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
							<div class="bg-img" style="background-image:url('.$img.$countries[$i]->photo.');"></div>
							<div class="slide-caption">
							<div class="caption-content">
							<h2 class="animated fadeInDown"><span class="slider-title">ГОРЯЩИЕ ТУРЫ <span class="slider-city-name open'.$countries[$i]->country.'">'.$countries[$i]->rusCase.'</span><span class="white-enter"></span> от </span><span class="slider-price">'.$countries[$i]->price.$countries[$i]->currency.'</span></h2>
							<span class="animated fadeInDown">Закажи прямо сейчас</span>
							<a href="" class="btn btn-blue btn-effect openModal open'.$countries[$i]->country.'">Узнать больше</a>
							</div>
							</div>
							</div>
							';
							include 'includes/modal_head.php';
						}
					}
					?>
				</div>
				<nav id="nav-arrows" class="nav-arrows hidden-xs hidden-sm visible-md visible-lg">
					<a href="javascript:;" class="sl-prev">
						<i class="fa fa-angle-left fa-3x"></i>
					</a>
					<a href="javascript:;" class="sl-next">
						<i class="fa fa-angle-right fa-3x"></i>
					</a>
				</nav>
				<nav id="nav-dots" class="nav-dots visible-xs visible-sm hidden-md hidden-lg">
					<?php
					$class = true;
					for($i = 0; $i < count($countries); $i++){
						if($countries[$i]->status == 'hot'){
							if($class){
								echo '<span class="nav-dot-current"></span>';
								$class = false;
							} else {
								echo '<span></span>';
							}
						}
					}
					?>
				</nav>
			</div>
		</section>



		<section id="booking">
			<div class="container">
				<div class="row">

					<div class="sec-title text-center wow animated fadeInDown">
						<h2>ГОРЯЩИЕ ТУРЫ 2019-2020</h2>
						<p class="">Скидки от 10% на ВСЕ горящие туры!</p>
					</div>

					<ul class="project-wrapper wow animated fadeInUp">
						<?php
						for($i = 0; $i < count($countries); $i++){
							if($countries[$i]->status == 'hot'){
								$modalId = 'modal'.$countries[$i]->country;
								$flagModal = $flag.$countries[$i]->flag;
								$modalName = $countries[$i]->rus;
								$modalDescription = $countries[$i]->description;
								$oldPrice = $countries[$i]->price + $countries[$i]->price / 8;
								echo '
								<li class="booking-item openModal open'.$countries[$i]->country.'">
								<img src="'.$img.$countries[$i]->photo.'" class="img-responsive" alt="'.$countries[$i]->rus.'">
								<figcaption class="mask">
								<div class="booking-title">
								<img src="'.$flag.$countries[$i]->flag.'" alt="'.$countries[$i]->rus.'">
								<h3>'.$countries[$i]->rus.'</h3>
								<p class="booking-price"><span class="booking-old-price">'.intval($oldPrice).$countries[$i]->currency.'</span><span class="booking-new-price">от '.$countries[$i]->price.$countries[$i]->currency.'</span></p>
								</div>
								<p>Раннее бронирование на <i><bold>2019</bold></i></p>
								</figcaption>
								</li>
								';
								include 'includes/modal_head.php';
							}
						}
						?>
					</ul>

				</div>
			</div>
		</section>




		<section id="booking">
			<div class="container">
				<div class="row">

					<div class="sec-title text-center wow animated fadeInDown">
						<h2>РАННЕЕ БРОНИРОВАНИЕ 2019-2020</h2>
						<p class="">Раннее бронирование – удобный вариант заказать тур заранее со скидкой.</p>
					</div>

					<ul class="project-wrapper wow animated fadeInUp">
						<?php
						for($i = 0; $i < count($countries); $i++){
							if($countries[$i]->status == 'early'){
								$modalId = 'modal'.$countries[$i]->country;
								$flagModal = $flag.$countries[$i]->flag;
								$modalName = $countries[$i]->rus;
								$modalDescription = $countries[$i]->description;
								$oldPrice = $countries[$i]->price + $countries[$i]->price / 8;
								echo '
								<li class="booking-item openModal open'.$countries[$i]->country.'">
								<img src="'.$img.$countries[$i]->photo.'" class="img-responsive" alt="'.$countries[$i]->rus.'">
								<figcaption class="mask">
								<div class="booking-title">
								<img src="'.$flag.$countries[$i]->flag.'" alt="'.$countries[$i]->rus.'">
								<h3>'.$countries[$i]->rus.'</h3>
								<p class="booking-price"><span class="booking-old-price">'.intval($oldPrice).$countries[$i]->currency.'</span><span class="booking-new-price">от '.$countries[$i]->price.$countries[$i]->currency.'</span></p>
								</div>
								<p>Раннее бронирование на <i><bold>2019</bold></i></p>
								</figcaption>
								</li>
								';
								include 'includes/modal_head.php';
							}
						}
						?>
					</ul>

				</div>
			</div>
		</section>


		<!-- about section -->
		<section id="about" >
			<div class="container">
				<div class="row">
					<div class="col-md-4 wow animated fadeInLeft">
						<div class="recent-works">
							<h3><i class="fas fa-comments comments-ico"></i>ОТЗЫВЫ</h3>
							<div id="comments">

								<?php
								$commentName = 'Мария';
								$commentDate = '05.11.2018';
								$commentContent = '
								Спасибо ДЕНИСУ!!! Он очень внимателен и всегда был на связи!!!! Чувствовали себя под присмотром!!!
								Всё соответствовало нашим пожеланиям!!!! И отдельное спасибо Александру
								';
								include 'includes/comment.php';
								?>

								<?php
								$commentName = 'Анастасия';
								$commentDate = '03.11.2018';
								$commentContent = '
								Здравствуйте!!! Хотелось бы поблагодарить Poznai. by, а точнее сотрудника Дениса за наш замечательный отдых в Египте. Отдых прошёл на высшем уровне!!! Было очень приятно, что Денис не забывал про нас и интересовался о том, как проходит наш отдых. Спасибо Вам Денис за вашу безупречную работу! Теперь отдыхать только с Poznai. by)
								';
								include 'includes/comment.php';
								?>

								<?php
								$commentName = 'Мария';
								$commentDate = '03.11.2018';
								$commentContent = '
								Спасибо ДЕНИСУ
								';
								include 'includes/comment.php';
								?>

								<?php
								$commentName = 'Катерина';
								$commentDate = '29.10.2018';
								$commentContent = '
								Добрый день! Спасибо за прекрасно проведённые выходные. Тур выходного дня Каунас-Тракай-Вильнюс (2 ночлега + SPA-комплекс + 3 экскурсии) - всё включено! Интересные экскурсии, много впечатлений. Отдельное спасибо сопровождающему Александру!
								';
								include 'includes/comment.php';
								?>

								<?php
								$commentName = 'Майя';
								$commentDate = '19.10.2018';
								$commentContent = '
								Привет.Очень благодарна за прекрасный отдых в Алании организованный poznai.by.Отдельное спасибо сотруднику агенства Денису за личное внимание и профессионализм.Рекомендую!!!! Огромное спасибо!Команде турфирмы здоровья благополучия и дальнейшего процветания!
								';
								include 'includes/comment.php';
								?>

								<?php
								$commentName = 'Ольга';
								$commentDate = '11.10.2018';
								$commentContent = '
								Замечательный отдых в конце сентября в Тунисе. Прекрасный город Монастир. Даже несколько дней непогоды неиспортили впечитлений от отдыха. За организацию моего отдыха хочу поблагодарить компанию poznai.by, заинтересованному в организации хорошего отдыха для нас Дениса и работающую с нами в Тунисе Анастасию. Надеемся на дальнейшее плаготворное сотрудничество.
								';
								include 'includes/comment.php';
								?>

							</div>
						</div>
					</div>
					<div class="col-md-7 col-md-offset-1 wow animated fadeInRight">
						<div class="welcome-block">
							<h3>О нас:</h3>
							<div class="message-body">
								<img src="img/logo2.png" class="pull-left about-logo" alt="member">
								<p>
									Для нас Ваш комфорт и удобство стоят на первом месте. Именно поэтому мы постоянно работаем над новыми услугами, чтобы сделать подбор и покупку тура максимально понятными и легкими для Вас, занимающими минимум времени и сил. С нами Ваш отдых станет незабываемым!
								</p>
							</div>
							<!-- <a href="#" class="btn btn-border btn-effect pull-right">Read More</a> -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- end about section -->

		<!-- Contact section -->
		<section id="contact" >
			<div class="container">
				<div class="row">

					<div class="sec-title text-center wow animated fadeInDown">
						<h2>Контакты</h2>
						<p>Связаться с нами</p>
					</div>


					<div class="col-md-7 contact-form wow animated fadeInLeft">
						<form action="<?php echo $url; ?>?action=send_mail" method="post">
							<div class="input-field">
								<input type="text" name="name" class="form-control" id="name" placeholder="Имя..." required>
							</div>
							<div class="input-field">
								<input type="email" name="email" class="form-control" id="email" placeholder="Email..." required>
							</div>
							<div class="input-field">
								<input type="text" name="subject" class="form-control" id="subject" placeholder="Тема..." required>
							</div>
							<div class="input-field">
								<textarea name="message" class="form-control" id="message" placeholder="Сообщение..." required></textarea>
							</div>
							<button type="submit" id="submit" class="btn btn-blue btn-effect">Отправить</button>
						</form>
					</div>

					<div class="col-md-5 wow animated fadeInRight">
						<address class="contact-details">
							<h3>Адрес офиса</h3>
							<p><i class="fas fa-map-marked"></i>220029<span>г.Минск</span> <span>пр-т Машерова, 17, офис 701</span></p><br>
							<p><i class="fa fa-phone"></i>Телефоны:
								<span>+375 (29) 664-50-11 (Vel)</span>
								<span>+375 (33) 364-50-11 (МТС)</span>
							</p>
							<p><i class="fa fa-envelope"></i>info@poznai.by</p>
						</address>
					</div>

				</div>
			</div>
		</section>
		<!-- end Contact section -->

		<section id="google-map">
			<div id="map-canvas" class="wow animated fadeInUp"></div>
		</section>

	</main>

	<footer id="footer">
		<div class="container">
			<div class="row text-center">
				<div class="footer-content">
					<div class="wow animated fadeInDown">
						<p>POZNAI.BY</p>
						<p>Туроператор! </p>
					</div>
					<!-- <form action="#" method="post" class="subscribe-form wow animated fadeInUp">
					<div class="input-field">
					<input type="email" class="subscribe form-control" placeholder="Enter Your Email...">
					<button type="submit" class="submit-icon">
					<i class="fa fa-paper-plane fa-lg"></i>
				</button>
			</div>
		</form> -->
		<!-- <div class="footer-social">
		<ul>
		<li class="wow animated zoomIn"><a href="#"><i class="fa fa-thumbs-up fa-3x"></i></a></li>
		<li class="wow animated zoomIn" data-wow-delay="0.3s"><a href="#"><i class="fa fa-twitter fa-3x"></i></a></li>
		<li class="wow animated zoomIn" data-wow-delay="0.6s"><a href="#"><i class="fa fa-skype fa-3x"></i></a></li>
		<li class="wow animated zoomIn" data-wow-delay="0.9s"><a href="#"><i class="fa fa-dribbble fa-3x"></i></a></li>
		<li class="wow animated zoomIn" data-wow-delay="1.2s"><a href="#"><i class="fa fa-youtube fa-3x"></i></a></li>
	</ul>
</div> -->

<p>
	УНП 192240779
</p>
<p>
	Свидетельство о государственной регистрации 192240779 выдано Мингорисполкомом от 21.03.2014г.
	Сертификат соответствия СТБ №BY/112 04.03. 003 16933 от 19.09.2017г. действителен до 19.09.2022г.
	Стоимость в валюте указана справочно. Оплата производится в белорусских рублях по установленному курсу.
</p>
</div>
</div>
</div>
</footer>

<!-- Essential jQuery Plugins
================================================== -->
<!-- Main jQuery -->
<!-- Twitter Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Single Page Nav -->
<script src="js/jquery.singlePageNav.min.js"></script>
<!-- jquery.fancybox.pack -->
<script src="js/jquery.fancybox.pack.js"></script>
<!-- Google Map API -->
<!-- <script src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
<!-- Owl Carousel -->
<script src="js/owl.carousel.min.js"></script>
<!-- jquery easing -->
<script src="js/jquery.easing.min.js"></script>
<!-- Fullscreen slider -->
<script src="js/jquery.slitslider.js"></script>
<script src="js/jquery.ba-cond.min.js"></script>
<!-- onscroll animation -->
<script src="js/wow.min.js"></script>
<!-- Custom Functions -->
<script src="js/main.js"></script>

<script src="js/jquery.plainmodal.js"></script>
</body>
</html>
