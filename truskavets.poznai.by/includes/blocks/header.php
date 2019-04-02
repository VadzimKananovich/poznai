<?php
$header_json = json_decode(file_get_contents($src_url.'JSON/header.json'));
$bg_img_arr = &$header_json->bgImg[0];
$bg_img = $src_url.cleare_path_str($bg_img_arr->imgPath).$bg_img_arr->img;
$header_title = strip_tags($bg_img_arr->title);
$header_desc = $bg_img_arr->sub_title;
?>

<header id="header" class="header overflow">
	<div class="header-bg">
		<img src="<?php echo $bg_img; ?>" alt="<?php echo $header_title; ?>">
	</div>
	<div class="header-content top-overflow txt-white">
		<div class="header-left">
			<h1 class="section-title mrb-1" data-aos="fade-right">
				<?php echo $header_title; ?>
			</h1>
			<div class="section-sub-title" data-aos="fade-right" data-aos-delay="300">
				<?php echo $header_desc; ?>
				<!-- <button type="button" class="btn btn-primary open-map-button mrt-1" data-toggle="modal" data-target="#openModalMap"><i class="fas fa-map-marked-alt"></i> на карте</button> -->
			</div>
		</div>
		<div class="header-right" data-aos="fade-left">
			<div class="bd-white form-contact">
				<div data-for="name">
					<div class="form-group">
						<input id="name" type="text" class="form-control px-3" name="name"  placeholder="Имя" required>
					</div>
				</div>
				<div data-for="phone">
					<div class="form-group">
						<input id="email" type="tel" class="form-control px-3" name="phone" placeholder="Телефон" required>
					</div>
				</div>
				<div class="input-group-btn text-center">
					<button type="submit" id="sendHeader" class="submit-btn btn">обратный звонок</button>
				</div>
			</div>
		</div>
	</div>


</header>
<div class="modal fade" id="openModalMap">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">ТРУСКАВЕЦ</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- <iframe style="min-height: 70vh; max-height: 100vh; width: 100%;" src="https://yandex.ru/map-widget/v1/?um=constructor%3A69f4c17cd856792af522ada9caa2ee6dea3afbbebc71efdc8290d92d4cfdf21f&amp;source=constructor" width="887" height="645" frameborder="0"></iframe> -->
		</div>
	</div>
</div>
