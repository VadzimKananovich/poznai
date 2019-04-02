<?php
$aboutProductClass = new AboutProduct;
$aboutProduct = $aboutProductClass->result;
?>
<section id="about">
	<div class="container about_bg" style="background-image:URL('<?php echo $aboutProduct['bg']; ?>');">
		<div class="row">
			<div class="col-lg-7 col-md-6 bg-white-opacity">
				<div class="about_content">
					<h2><?php echo $aboutProduct['title']; ?></h2>
					<h3><?php echo $aboutProduct['subTitle']; ?></h3>
					<div data-aos="fade-up" class="about_content_wrap">
						<?php echo $aboutProduct['desc']; ?>
						<!-- <button  class="btn know_btn">узнать больше</button> -->
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-lg-offset-1">
				<div class="about_banner" data-aos="zoom-in" data-aos-duration="2000">
					<img src="<?php echo $aboutProduct['img']; ?>" alt="<?php echo $aboutProduct['title']; ?>" />
				</div>
			</div>
		</div>
	</div>
</section>
