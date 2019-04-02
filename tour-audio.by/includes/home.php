<?php
$header = json_decode(file_get_contents('JSON/header.json'));
$slider = &$header->slider;
?>

<section id="home" class="home">
	<div id="carousel" class="owl-carousel head">
		<?php
		foreach($slider as $key => $item){
			$className = $key === 0 ? ' active' : '';
			$item_slider = new Slider($item,$className,$key);
			echo $item_slider->item;
		}
		?>
	</div>
</section>
