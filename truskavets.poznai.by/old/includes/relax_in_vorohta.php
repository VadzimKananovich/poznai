<?php

$sliderContent = array(new stdClass,new stdClass,new stdClass,new stdClass,new stdClass);

$sliderContent[0]->title = 'Рестораны Трускавца';
$sliderContent[0]->desc = '
Рестораны Трускавца отличаются не только высоким качеством обслуживания и вкусом блюд, но и оригинальным оформлением залов, неповторимой атмосферой.Трускавец не ограничивается одним отелем-санаторием, на территории курорта расположен не один десяток кафе и ресторанов разных ценовых категорий. Посетители могут совместить трапезу с прогулкой по старинному городу, пообедать в традиционной украинской "хате" или посетить национальный азербайджанский ресторан, попить кофе с десертом в уютной кофейне , попробовать разные сорта пива в пабе. Трускавец очень туристический город и на выходные или в праздничные дни Вам вероятнее всего прийдется постоять в очереди в самые популярные заведения.
';
$sliderContent[0]->img = 'img/content/img2.jpg';


$sliderContent[1]->title = 'Креативные заведения';
$sliderContent[1]->desc = '
Душе нужны яркие впечатления, телу – вкусная еда! Трускавец подарит Вам все это. Заведения с уникальным «лицом», дарящие неординарные эмоции – наиболее точное определение этого городка. Каждое заведение позволяет посетителям полностью абстрагироваться от обыденности и насладиться волшебной атмосферой. Пабы и кафе Трускавца можно перечислять бесконечно, в каждом из них вы получите незабываемые впечатления и с удовольствием проведете время.
';
$sliderContent[1]->img = 'img/content/img3.jpg';


$sliderContent[2]->title = 'Интересные места Трускавца';
$sliderContent[2]->desc = '
Трускавец - это не только город-музей под открытым небом, но и город музеев. Не один час придется потратить, чтобы осмотреть все экспозиции местных музеев.
';
$sliderContent[2]->img = 'img/content/img4.jpg';


$sliderContent[3]->title = 'Трускавец - если едете с детьми';
$sliderContent[3]->desc = '
Культурное место Украины привлекает взрослых туристов историческими достопримечательностями, прогулками по старинным улицам, интересными экскурсиями. Ваша задача – сделать посещение Трускавца увлекательным для дошкольника. Это непросто, но возможно.
Итак, где "потусить" с детьми: Это батуты и лабиринты (возле бюветов) , катание на велосипеде, зоопарк и ландшафтный парк, если повезет, можете попасть и в заезжий цирк-шапито.
';
$sliderContent[3]->img = 'img/content/img5.jpg';



$sliderContent[4]->title = 'Что привезти из Трускавца';
$sliderContent[4]->desc = '
Самый популярный сувенир из Трускавца – куманец. Специальные керамические сосуды известны всем ценителям минеральным вод и бальнеологических курортов. Именно куманец – первое приобретение, которое пригодится каждому новоприбывшему отдыхающему. Сувениры – это не обязательно всевозможные фигурки и бытовые мелочи! Среди полезных и питательных приобретений в Трускавце – карпатский чай, известный своими целебными эффектами и хорошим вкусом. Также себе и близким можно привезти вкусный, экологичный и стопроцентно натуральный мед местного производства.
';
$sliderContent[4]->img = 'img/content/img7.jpg';

 ?>

<section class="mbr-section content4 cid-r9gkRP3RSV" id="content4-k">
	<div class="container section-title">
		<div class="media-container-row">
			<div class="title col-12 col-md-8">
				<h2 class="align-center pb-3 mbr-fonts-style display-2">Где отдохнуть в г.Трускавец?</h2>
				<h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-5">
					г.Трускавец - город областного значения в Львовской области Украины, бальнеологический курорт.
					С XIX века курорт "Трускавец"" известен своими целебными источниками и реабилитационными центрами. И "королевой" среди минеральных источников является "Нафтуся". К источнику "Трускавецкого" происхождения ежегодно приезжают тысячи туристов , из-за его уникальных лечебных свойств.
				</h3>
			</div>
		</div>
	</div>
	<div class="carousel slide cid-r9gw9pHYSH" data-interval="false" id="slider1-l">
		<div class="full-screen">
			<div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="false">
				<ol class="carousel-indicators">
					<?php
						for ($i = 0; $i < count($sliderContent); $i++){
							if($i == 0){
								$active = ' class="active"';
							} else {
								$active = '';
							}
							echo '<li data-target="#slider1-l" data-slide-to="'.$i.'"'.$active.'></li>';
						}
					 ?>
					<!-- <li data-app-prevent-settings="" data-target="#slider1-l" class=" active" data-slide-to="0"></li>
					<li data-app-prevent-settings="" data-target="#slider1-l" data-slide-to="1"></li>
					<li data-app-prevent-settings="" data-target="#slider1-l" data-slide-to="2"></li>
					<li data-app-prevent-settings="" data-target="#slider1-l" data-slide-to="3"></li>
					<li data-app-prevent-settings="" data-target="#slider1-l" data-slide-to="4"></li> -->
				</ol>
				<div class="carousel-inner" role="listbox">
					<?php
						for($i = 0; $i < count($sliderContent); $i++){
							if($i == 0){
								$active = ' active';
							} else {
								$active = '';
							}
							echo '<div class="carousel-item slider-fullscreen-image'.$active.'" data-bg-video-slide="false" style="background-image: url(\''.$sliderContent[$i]->img.'\');">';
							echo '<div class="container container-slide">';
							echo '<div class="image_wrapper">';
							echo '<div class="mbr-overlay"></div>';
							echo '<img src="'.$sliderContent[$i]->img.'">';
							echo '<div class="carousel-caption justify-content-center">';
							echo '<div class="col-10 align-center carousel-content">';
							echo '<h2 class="mbr-fonts-style display-1">'.$sliderContent[$i]->title.'</h2>';
							echo '<p class="lead mbr-text mbr-fonts-style display-5">';
							echo $sliderContent[$i]->desc;
							echo '</p>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
						}
					 ?>
				</div>
				<a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider1-l">
					<span aria-hidden="true" class="mbri-left mbr-iconfont"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider1-l">
					<span aria-hidden="true" class="mbri-right mbr-iconfont"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
</section>
