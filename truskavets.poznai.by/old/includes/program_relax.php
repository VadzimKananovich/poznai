<section class="features17 cid-r9gk48CsyH program-relax" id="features17-i">
	<div class="mbr-section content4 cid-r9gdWSAZt4 section-title" id="content4-g">
		<div class="container">
			<div class="media-container-row">
				<div class="title col-12 col-md-8">
					<h2 class="align-center pb-3 mbr-fonts-style display-2">Программа отдыха в Трускавце на 9/10 дней</h2>
					<h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-7"></h3>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<?php
		$day2sliderPath = 'img/relax/day2';
		$day2SliderImg = scandir($day2sliderPath);
		?>
		<div class="mbr-section article content1 cid-r9gAyUPxka">
			<div class="container">
				<div class="media-container-row">
					<div class="mbr-text col-12 col-md-8 mbr-fonts-style display-7 relax-card-title"><strong>День 2</strong></div>
				</div>
			</div>
		</div>
		<div class="no-cards-container">
			<div class="no-day-container">
				<div class="no-day-gallery">
					<div class="carousel slide" data-interval="false" id="slider2-l">
						<div class="full-screen">
							<div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="false">
								<ol class="carousel-indicators">
									<?php
									for($i = 2; $i < count($day2SliderImg); $i++){
										if($i == 2){
											$active = ' class="active"';
										} else {
											$active = '';
										}
										echo '<li data-target="#slider2-l" data-slide-to="'.$i.'"'.$active.'></li>';
									}
									?>
								</ol>
								<div class="carousel-inner" role="listbox">
									<?php
									for($i = 2; $i < count($day2SliderImg); $i++){
										if($i === 2){
											$active = ' active';
										} else {
											$active = '';
										}
										echo '<div class="carousel-item slider-fullscreen-image'.$active.'" data-bg-video-slide="false" style="background-image: url(\''.$day2sliderPath.'/'.$day2SliderImg[$i].'\');">';
										echo '<div class="container container-slide">';
										echo '<div class="image_wrapper">';
										echo '<img src="'.$day2sliderPath.'/'.$day2SliderImg[$i].'">';
										echo '</div>';
										echo '</div>';
										echo '</div>';
									}
									?>
								</div>
								<a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider2-l">
									<span aria-hidden="true" class="mbri-left mbr-iconfont"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider2-l">
									<span aria-hidden="true" class="mbri-right mbr-iconfont"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="no-day-content">
					<h4 class="no-day-title">Знакомство с Трускавцом</h4>
					<p>
						Отдых в Трускавце наполнен яркими красками и позитивными эмоциями, которые навсегда останутся в памяти туристов. Отдыхающие, приехав на отдых в Трускавец, бессомненно сделали правильный выбор, так как остаются довольными от полученных приятных впечатлений и от увиденной красоты местных достопримечательностей. Изучая карпатскую природу, флору и фауну, посещая увлекательные экскурсии и просто дыша свежим горным воздухом, который насыщен озоном и кислородом, отдыхающие тут же заряжаются силой и бодростью.
					</p>
				</div>

			</div>
		</div>

		<?php
		$includeCard = scandir('includes/days_relax');
		for($i = 2; $i < (count($includeCard)-1); $i++){
			include 'days_relax/'.$includeCard[$i];
		}
		?>


		<?php
		$day2sliderPath = 'img/relax/day8';
		$day2SliderImg = scandir($day2sliderPath);
		?>
		<div class="mbr-section article content1 cid-r9gAyUPxka">
			<div class="container">
				<div class="media-container-row">
					<div class="mbr-text col-12 col-md-8 mbr-fonts-style display-7 relax-card-title"><strong>День 8</strong></div>
				</div>
			</div>
		</div>
		<div class="no-cards-container">
			<div class="no-day-container no-day-container-revers">

				<div class="no-day-content">
					<h4 class="no-day-title">Уезжаем, чтобы вернуться!</h4>
					<p>
						Для гостей, отправляющихся поездами со Львова, выезд из отеля в 8:30. К 10:30 автобус прибудет на ж/д вокзал, где туристы, уезжающие более поздними поездами, смогут оставить свои вещи в камере хранения.
					</p>
					<p>
						Затем автобус прибудет в центр, где организована пешеходная экскурсия по улицам средневекового Львова, который на протяжении XIV-XVII веков был окружен кольцом стен. Львов – древний город , основанный князем Данилой Галицким, является одним из самых красивых городов Европы. Вы увидите оборонительные сооружения города, жилые кварталы различных национальных общин, средневековые храмы и монастыри, а также сердце Львова и одновременно музей под открытым небом – площадь Рынок с ее главным украшением – Львовской ратушей высотой 65 метров, на которую можно взойти и насладиться видами центральной части, рассмотреть вблизи механизм старых немецких часов.
					</p>
					<p>
						Для туристов, уезжающих более ранними поездами, в 14:00 отправление автобуса из центра, примерно в 14:15 прибытие на ж/д вокзал. Для туристов, уезжающими более поздними поездами (на ж/д вокзал, который расположен в 3км от центра, нужно будет добираться самостоятельно), знакомство со Львовом будет продолжено кофейной прогулкой в историческом центре, сопровождаемой рассказами об истории и традициях приготовления кофе в Европе и Львове.
					</p>
					<p>
						В городе десятки заведений, где варят чудесный кофе и шоколад. Традиционно большинство из них оформлены в стиле Австро-венгерской монархии, где вы как будто погружаетесь во времена Франца-Иосифа, а выходя на улицу, удивляетесь, что на дворе 21 век. Памятник Юрию Кульчицкому, знаменитая площадь Рынок, популярные кофейни «Золотой Дукат» и «Волшебный фонарь», Львовская шоколадная фабрика, Львовская мастерская карамели, самая длинная кофейня «Книжный магазин», оригинальный концептуальный ресторан-трактир «Криївка», львовская мастерская медовых и имбирных пряников «Юрашки».
					</p>
				</div>


				<div class="no-day-gallery">
					<div class="carousel slide" data-interval="false" id="slider3-l">
						<div class="full-screen">
							<div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="false">
								<ol class="carousel-indicators">
									<?php
									for($i = 2; $i < count($day2SliderImg); $i++){
										if($i == 2){
											$active = ' class="active"';
										} else {
											$active = '';
										}
										echo '<li data-target="#slider3-l" data-slide-to="'.$i.'"'.$active.'></li>';
									}
									?>
								</ol>
								<div class="carousel-inner" role="listbox">
									<?php
									for($i = 2; $i < count($day2SliderImg); $i++){
										if($i === 2){
											$active = ' active';
										} else {
											$active = '';
										}
										echo '<div class="carousel-item slider-fullscreen-image'.$active.'" data-bg-video-slide="false" style="background-image: url(\''.$day2sliderPath.'/'.$day2SliderImg[$i].'\');">';
										echo '<div class="container container-slide">';
										echo '<div class="image_wrapper">';
										echo '<img src="'.$day2sliderPath.'/'.$day2SliderImg[$i].'">';
										echo '</div>';
										echo '</div>';
										echo '</div>';
									}
									?>
								</div>
								<a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider3-l">
									<span aria-hidden="true" class="mbri-left mbr-iconfont"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider3-l">
									<span aria-hidden="true" class="mbri-right mbr-iconfont"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>



		<!--
		<?php
		// $day2sliderPath = 'img/relax/day9';
		// $day2SliderImg = scandir($day2sliderPath);
		?>
		<div class="mbr-section article content1 cid-r9gAyUPxka">
		<div class="container">
		<div class="media-container-row">
		<div class="mbr-text col-12 col-md-8 mbr-fonts-style display-7 relax-card-title"><strong>День 9</strong></div>
	</div>
</div>
</div>
<div class="no-cards-container">
<div class="no-day-container">
<div class="no-day-gallery">
<div class="carousel slide" data-interval="false" id="slider4-l">
<div class="full-screen">
<div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="false">
<ol class="carousel-indicators">
<?php
// for($i = 2; $i < count($day2SliderImg); $i++){
// 	if($i == 2){
// 		$active = ' class="active"';
// 	} else {
// 		$active = '';
// 	}
// 	echo '<li data-target="#slider4-l" data-slide-to="'.$i.'"'.$active.'></li>';
// }
?>
</ol>
<div class="carousel-inner" role="listbox">
<?php
// for($i = 2; $i < count($day2SliderImg); $i++){
// 	if($i === 2){
// 		$active = ' active';
// 	} else {
// 		$active = '';
// 	}
// 	echo '<div class="carousel-item slider-fullscreen-image'.$active.'" data-bg-video-slide="false" style="background-image: url(\''.$day2sliderPath.'/'.$day2SliderImg[$i].'\');">';
// 	echo '<div class="container container-slide">';
// 	echo '<div class="image_wrapper">';
// 	echo '<img src="'.$day2sliderPath.'/'.$day2SliderImg[$i].'">';
// 	echo '</div>';
// 	echo '</div>';
// 	echo '</div>';
// }
?>
</div>
<a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider4-l">
<span aria-hidden="true" class="mbri-left mbr-iconfont"></span>
<span class="sr-only">Previous</span>
</a>
<a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider4-l">
<span aria-hidden="true" class="mbri-right mbr-iconfont"></span>
<span class="sr-only">Next</span>
</a>
</div>
</div>
</div>
</div>
<div class="no-day-content">
<h4 class="no-day-title">Знакомство с Трускавцом</h4>
<p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
</div>

</div>
</div> -->

</div>
</section>
