
<?php
$complectImg = scandir('img/complect/gallery');

?>
<section id="partners" class="menu-section" data-menuIco="far fa-handshake" data-menuName="Партнеры" data-file="partners">

	<h2 class="section-title show-from-bottom"><span>Наши парнеры</span></h2>

	<div class="complect-row-img slick">
		<?php
			for($i = 2; $i < count($complectImg); $i++ ){
				echo '<div class="complect-row-img-container">';
				echo '<img src="img/complect/gallery/'.$complectImg[$i].'" alt="РАДИОГИД">';
				echo '</div>';
			}
		 	?>
	</div>
</section>
