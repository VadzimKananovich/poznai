<?php
include 'includes/_main.php';
$header_title = 'КОНТАКТЫ';
$header_sub_title = 'ответим на все Ваши вопросы';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Радиогиды в Беларуси Оборудование для синхронного перевода</title>
	<base href="<?php echo $url; ?>" />
	<!-- Facebook Open Graph -->
	<meta name="keywords" content="" />
	<meta property="og:title" content="Радиогиды в Беларуси Оборудование для синхронного перевода" />
	<meta property="og:description" content="Продажа/аренда радиогидов и оборудования для синхронного перевода, экскурсий, конференций с доставкой по лучшей цене. Гарантия качественного звука." />
	<meta property="og:image" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="http://touraudioguide.by/" />
	<!-- Facebook Open Graph end -->
	<?php
	include 'includes/_stylesheets.php';
	?>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
	   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
	   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	   ym(52679659, "init", {
	        clickmap:true,
	        trackLinks:true,
	        accurateTrackBounce:true,
	        webvisor:true
	   });
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/52679659" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
</head>

<body id="top">
	<div class="bg-grediunt">
		<div class="rent-bg-banner-img ">
			<div class="overlay-all ">
				<?php
				include 'includes/header_nav.php';
				include 'includes/header_pages.php';
				?>
			</div>
		</div>




		<section>
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="section-heading left">
							<h4>Написать</h4>
						</div>
						<div class="contact-form-box margin-30px-top">
							<div class="no-margin-lr" id="success-contact-form" style="display: none;"></div>
							<form id="contactForm" method="post" class="contact-form" action="includes/mail_send.php?type=sendmail"  data-type="email">
								<div class="row">
									<div class="col-md-12">
										<input type="text" class="medium-input" placeholder="Имя *" required="required" id="contactName" required>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<input type="email" class="medium-input" placeholder="E-mail *" required="required" id="contactEmail" required>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<input type="text" class="medium-input" placeholder="Тема *" required="required" id="contactSubject" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<textarea class="medium-textarea" rows="12" placeholder="Сообщение *" required="required" id="contactMessage" required></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 sm-margin-30px-bottom">
										<div class="top-contact wow fadeInRight text-left" style="visibility: visible; animation-name: fadeInRight;">
											<button type="submit" class="btn btn-primary wow fadeInUp  js-scroll-trigger" data-wow-delay=" 0.5s" style="visibility: visible; animation-delay:  0.5s; animation-name: fadeInUp;">
												Отправить
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="contact-info-box padding-30px-left sm-no-padding">
							<div class="row">
								<div class="col-12">
									<div class="contact-info-section no-padding-top margin-10px-top">
										<h4>Банковские данные</h4>
										<p>
											<strong>Расчетный счет:</strong> BY17BLBB30120193110152001001
											в ОАО Белинвестбанк», BLBBBY2X<br>
											<strong>Адрес банка:</strong> 220002,
											г.Минск, пр-т Машерова, 29,
										</p>
									</div>
								</div>
								<div class="col-12">
									<div class="contact-info-section">
										<h4>Офис</h4>
										<ul class="list-style-1 no-margin-bottom">
											<li>
												<p><i class="fas fa-map-marker-alt text-center"></i> <strong>Юридический адрес:</strong><br> 220035, г.Минск, ул.Тимирязева, 67, пом.274, оф.1</p>
											</li>
											<li>
												<p><i class="fas fa-map-marked-alt text-center"></i> <strong>Физический адрес:</strong><br> 220029, г.Минск, пр-т Машерова, 17 - 703</p>
											</li>
											<!-- <li>
											<p><i class="fa fa-globe text-center"></i> <strong>Phone:</strong> (+44) 123 456 789</p>
										</li>
										<li>
										<p><i class="fa fa-envelope text-center"></i> <strong>Email:</strong> <a href="javascript:void(0)" class="email_color_site">email@youradress.com</a></p>
									</li> -->
								</ul>
							</div>
						</div>
						<div class="col-12">
							<div class="contact-info-section border-none no-padding-bottom no-margin-bottom">
								<h4>Время работы</h4>
								<ul class="list-style-2">
									<li>Круглосуточно без выходных</li>
									<!-- <li>Суббота, воскресенье - выходной</li> -->
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- #Contact Us Area End -->
<!-- #Start map  Area -->
<section class=" p0">
	<div class="container-fluid p0">
		<div id="contatti" class=" maps">
			<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A27161f3571dc268b6b81d15060895564afbc7cc688a65cd7c7c27d7c4a92ca42&amp;source=constructor" width="985" height="685" frameborder="0"></iframe>
		</div>
	</div>
</section>



</div>
<?php
include 'includes/footer.php';
include 'includes/modal.php';
include 'includes/_scripts_js.php';
?>
<script>
new SendMail('contactForm',{
	'contactName': 'empty',
	'contactEmail': 'empty',
	'contactSubject': 'empty',
	'contactMessage': 'empty'
});

//
// ymaps.ready(init);
//
// function init() {
// 	var myMap = new ymaps.Map('map', {
// 		center: [55.755773, 37.617761],
// 		zoom: 9
// 	}, {
// 		searchControlProvider: 'yandex#search'
// 	}),
// 	myPlacemark = new ymaps.Placemark(myMap.getCenter());
//
// 	myMap.geoObjects.add(myPlacemark);
//
// 	myPlacemark.events
// 	.add('mouseenter', function (e) {
// 		e.get('target').options.set('preset', 'islands#greenIcon');
// 	})
// 	.add('mouseleave', function (e) {
// 		e.get('target').options.unset('preset');
// 	});
// }


</script>
</body>
</html>
