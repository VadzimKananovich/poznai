<?php
$hotel_json = json_decode(file_get_contents($src_url.'JSON/hotel.json'));
$title = strip_tags($hotel_json->section_title);
$slider = $hotel_json->rooms;

?>

<section class="hotel-section" id="hotelSection">
	<h2 class="section-title mrb-2 aos-wrap">
		<span class="block aos-el" data-aos="fade-down"><?php echo $title; ?></span>
		<span class="divider-xs aos-el" data-aos="flip-left"></span>
	</h2>

	<div class="filter-nav filter-img-hotel">
		<ul>
			<li data-filter="all" class="active">Все комнаты</li>
			<?php
			for($i = 0; $i < count($slider); $i++){
				echo '<li data-filter="'.$i.'">'.$slider[$i]->name.'</li>';
			}
			?>
		</ul>
	</div>
	<div class="filtr-container">
		<?php
		for($i = 0; $i < count($slider); $i++){
			for($j = 0; $j < count($slider[$i]->img); $j++){
				$imgUrl = $src_url.cleare_path_str($slider[$i]->imgPath).$slider[$i]->img[$j];
				$imgTitle = strip_tags($slider[$i]->name);
				echo '<div class="filtr-item" data-category="'.$i.'">';
				echo '<a href="'.$imgUrl.'" title="'.$imgTitle.'">';
				echo '<i class="fas fa-search-plus zoom-ico"></i>';
				echo '<img src="'.$imgUrl.'" alt="'.$imgTitle.'">';
				echo '</a>';
				echo '</div>';
			}
		}
		?>
	</div>


</section>
