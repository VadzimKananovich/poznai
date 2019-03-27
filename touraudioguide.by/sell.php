<?php
include 'includes/_main.php';
$header_title = 'КУПИТЬ';
$header_sub_title = 'радиогид в Беларуси';
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


		<div  class="py-70 pb_90 rent-first-block">
			<div class="container">
				<div class="row text-left">
					<div class="col-md-5">
						<div class="service_left_text_top wow fadeInUp">
							<h3>Продажа радиогидов в Беларуси</h3>
						</div>
					</div>
					<div class="col-md-7">
						<div class="service_left_text_top wow fadeInUp">
							<p>
								Компания ТурАудиоГид предоставляет полный комплекс услуг по продаже оборудования для максимально качественного и комфортного проведения экскурсий, автобусных туров и круизов.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="py-70 pb_90 product-row darck-p">
			<div class="container ">
				<div class="row text-left">
					<div class="col-md-5">
						<img src="gallery_gen/4b0d39ce2acac8abf839027b0971671b_498x330.26206896552.jpg" class="img_radius">
					</div>
					<div class="col-md-7">
						<div class="service_left_text_top wow fadeInUp">
							<h3 class="text-uppercase">Наши специалисты Вас проконсультируют</h3>
							<p>
								Наши специалисты максимально доступно и понятно проконсультируют Вас в выборе оборудования для синхронного перевода к проведению конференций и деловых встреч.
							</p>
						</div>
					</div>

				</div>
			</div>
		</div>

		<section class="sell-section video_bg_img">
			<div class="container py-70">
				<div class="row">
					<div class="col-md-6  wow fadeInUp">
						<div class="rent-form">
							<h5 class="rent-form-title">Купить оборудование</h5>
							<form action="includes/mail_send.php?type=buy" id="formBuy" data-type="request">
								<div class="form-group">
									<label for="requestName" class="col-form-label">Имя:</label>
									<input type="text" class="request-name" id="buyName" name="requestName" placeholder="Имя" required>
								</div>
								<div class="form-group">
									<label for="requestNumber" class="col-form-label">Телефон:</label>
									<input type="text" class="request-number" id="buyNumber" name="requestNumber" placeholder="+375" required>
								</div>
								<input type="hidden" id="buyType" value="покупке оборудования">
								<div class="form-row-btn">
									<button type="submit" class="btn btn-primary">Отправить</button>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-6  wow fadeInUp">
						<h2 class="wow fadeInUp video_top_h">ПОЧЕМУ МЫ</h2>
						<p class="left-tabs-text-2"><span><i class="fas fa-check-circle"></i></span>Полная комплектация</p>
						<p class="left-tabs-text-2"><span><i class="fas fa-check-circle"></i></span>Консультация по эксплуатации</p>
						<p class="left-tabs-text-2"><span><i class="fas fa-check-circle"></i></span>Самые низкие цены на рынке</p>
						<!-- <p class="left-tabs-text-2"><span><i class="fas fa-check-circle"></i></span>Оптимальные условия аренды</p> -->
					</div>
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
	new SendMail('formBuy',{
		'buyName': 'empty',
		'buyNumber': 'empty'
	});
</script>
</body>
</html>
