<section class="features17 cid-r9gk48CsyH hotel-section" id="features17-i">
	<div class="mbr-section content4 cid-r9gdWSAZt4 section-title" id="content4-g">
		<div class="container">
			<div class="media-container-row">
				<div class="title col-12 col-md-8">
					<h2 class="align-center pb-3 mbr-fonts-style display-2">Отель в Ворохте</h2>

				</div>
			</div>
		</div>
	</div>


	<div class="mbr-gallery mbr-slider-carousel cid-r9tLiDZl1z" id="gallery2-13">
		<div class="container">
			<div>


				<div class="mbr-gallery-filter container gallery-filter-active">
					<ul buttons="0">
						<li class="mbr-gallery-filter-all">
							<a class="btn btn-md btn-primary-outline active display-7" href="">Все</a>
						</li>
					</ul>
				</div>

				<div class="mbr-gallery-row">
					<div class="mbr-gallery-layout-default">
						<div>
							<div>
								<?php
								for($i = 0; $i < count($roomsInfo); $i++){
									for($j = 1; $j < count($roomsInfo[$i]->roomsPhoto); $j++){
										echo '
										<div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="'.$roomsInfo[$i]->roomsRus.'">
										<div href="#lb-gallery2-13" data-slide-to="0" data-toggle="modal">
										<img src="'.$roomsInfo[$i]->roomsPhoto[0].$roomsInfo[$i]->roomsPhoto[$j].'" alt="'.$roomsInfo[$i]->roomsRus.'" title="">
										<span class="icon-focus"></span>
										</div>
										</div>
										';
									}
								}
								?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>

				<div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery2-13">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<div class="carousel-inner">
									<?php
									for($i = 0; $i < count($roomsInfo); $i++){
										for($j = 1; $j < count($roomsInfo[$i]->roomsPhoto); $j++){
											if($j == 1){
												$active = 'active';
											} else {
												$active = '';
											}
											echo '
											<div class="carousel-item '.$active.'">
											<img src="'.$roomsInfo[$i]->roomsPhoto[0].$roomsInfo[$i]->roomsPhoto[$j].'" alt="" title="">
											</div>
											';
										}
									}
									?>
								</div>
								<a class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#lb-gallery2-13">
									<span class="mbri-left mbr-iconfont" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control carousel-control-next" role="button" data-slide="next" href="#lb-gallery2-13">
									<span class="mbri-right mbr-iconfont" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
								<a class="close" href="#" role="button" data-dismiss="modal">
									<span class="sr-only">Close</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-7 hotel-price-h3">Цены комнат по датам</h3>
	<div class="hotel-room-select-wrap">
		<div class="room-res-container">
			<div class="room-res-title">
				<?php
				for($i = 0; $i < count($roomsInfo); $i++){
					echo '<p>'.$roomsInfo[$i]->roomsRus.'</p>';
				}
				?>
			</div>
			<div class="room-res-days">
				<p class="rooms-select-desc">На 9 дней:</p>
				<div class="room-select-container">
					<p class="room-select-title-wrap room-8"> <span class="room-select-title room-8">Выберите дату</span><i class="fas fa-chevron-circle-down"></i> </p>
					<ul class="room-select-hide room-8">
						<?php
						for($i = 0; $i < count($roomsPrice); $i++){
							echo '
							<li> <span class="room-select-name room-8" data-id="date8'.$i.'" data-date="'.$roomsPrice[$i]->roomsDate8.'">'.$roomsPrice[$i]->roomsDate8.'</span> </li>
							';
						}
						?>
					</ul>
				</div>
				<?php
				for($i = 0; $i < count($roomsPrice); $i++){
					echo '
					<div class="room-res-price room-8" id ="date8'.$i.'">
					<p class="room-res-content">'.$roomsPrice[$i]->room_4_1.'$</p>
					<p class="room-res-content">'.$roomsPrice[$i]->room_2_block.'$</p>
					<p class="room-res-content">'.$roomsPrice[$i]->room_3.'$</p>
					<p class="room-res-content">'.$roomsPrice[$i]->room_4_2.'$</p>
					<p class="room-res-content">'.$roomsPrice[$i]->room_2_econom.'$</p>
					<p class="room-res-content">'.$roomsPrice[$i]->room_2_standart.'$</p>
					';
					echo '</div>';
				}
				?>
			</div>
			<div class="room-res-days">
				<p class="rooms-select-desc">На 10 дней:</p>
				<div class="room-select-container">
					<p class="room-select-title-wrap room-10"> <span class="room-select-title room-10">Выберите дату</span><i class="fas fa-chevron-circle-down"></i> </p>
					<ul class="room-select-hide room-10">
						<?php
						for($i = 0; $i < count($roomsPrice); $i++){
							echo '
							<li> <span class="room-select-name room-10" data-id="date10'.$i.'" data-date="'.$roomsPrice[$i]->roomsDate10.'">'.$roomsPrice[$i]->roomsDate10.'</span> </li>
							';
						}
						?>
					</ul>
				</div>
				<?php
				for($i = 0; $i < count($roomsPrice); $i++){
					echo '
					<div class="room-res-price room-10" id ="date10'.$i.'">
					<p class="room-res-content">'.($roomsPrice[$i]->room_4_1 + 15).'$</p>
					<p class="room-res-content">'.($roomsPrice[$i]->room_2_block + 15).'$</p>
					<p class="room-res-content">'.($roomsPrice[$i]->room_3 + 15).'$</p>
					<p class="room-res-content">'.($roomsPrice[$i]->room_4_2 + 15).'$</p>
					<p class="room-res-content">'.($roomsPrice[$i]->room_2_econom + 15).'$</p>
					<p class="room-res-content">'.($roomsPrice[$i]->room_2_standart + 15).'$</p>
					';
					echo '</div>';
				}
				?>
			</div>
		</div>
	</section>
