<?php
$relax_json = json_decode(file_get_contents($src_url.'JSON/relax.json'));
$title = strip_tags($relax_json->section_title);
$sub_title = strip_tags($relax_json->section_sub_title);
$slider = $relax_json->slider;
?>

<section id="relax" class="relax-section">
	<h2 class="section-title mrb-2 aos-wrap">
		<span class="block aos-el" data-aos="fade-down"><?php echo $title; ?></span>
		<span class="divider-xs aos-el" data-aos="flip-left"></span>
	</h2>
	<h5 class="section-sub-title mrb-3 aos-wrap">
		<span class="aos-el" data-aos="fade-up"><?php echo $sub_title; ?></span>
	</h5>

	<div class="owl-carousel owl-theme" id="relaxCarousel">
		<?php
		for($i = 0; $i < count($slider); $i++){
			echo '<div class="item relax-carousel-item" style="background-image:url('.$src_url.$slider[$i]->imgPath.$slider[$i]->img.')">';
			echo '<div class="relax-carousel-content">';
			echo '<h6  data-animation-in="rollIn" data-animation-out="rollOut" class="slider-relax-title">';
			echo strip_tags($slider[$i]->title);
			echo '</h6>';
			echo '<p data-animation-in="fadeInLeft" data-animation-out="fadeOutRight" class="slider-relax-content">';
			echo strip_tags($slider[$i]->desc);
			echo '</p>';
			echo '</div>';
			echo '</div>';
		}
		?>
	</div>
</section>
