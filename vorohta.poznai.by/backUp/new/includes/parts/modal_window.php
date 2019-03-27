
<!-- The Modal -->
<div class="modal fade relax-modal-window" id="<?php echo $sliderId; ?>">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $cardName; ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
      <div class="modal-wrapper">
        <div class="modal-slider-wrap">
          <div class="carousel slide cid-r9gw9pHYSH" data-interval="false" id="<?php echo $sliderId; ?>-l">
              <div class="">
                <div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="4000">
                  <ol class="carousel-indicators">
										<li data-app-prevent-settings="" data-target="#<?php echo $sliderId; ?>-l" class=" active" data-slide-to="0"></li>
										<?php
												for($i = 1; $i<count($slideImg); $i++){
													echo '<li data-app-prevent-settings="" data-target="#'.$sliderId.'-l" data-slide-to="'.$i.'"></li>';
												}
											?>

                  </ol>
                  <div class="carousel-inner" role="listbox">

										<?php

											for($i = 0; $i<count($slideImg); $i++) {
												if($i === 0){
													$active = ' active';
												} else {
													$active = '';
												}

												echo '
												<div class="carousel-item slider-fullscreen-image'.$active.'" data-bg-video-slide="false" style="background-image: url(img/relax/'.$dayNumber.'/'.$programNumber.'/'.$slideImg[$i].');">
													<div class="container container-slide">
														<div class="image_wrapper">
															<img src="img/relax/'.$dayNumber.'/'.$programNumber.'/'.$slideImg[$i].'">
														</div>
													</div>
												</div> ';
											}
											// <div class="mbr-overlay"></div>

											?>
                  </div>
                  <a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#<?php echo $sliderId; ?>-l">
                    <span aria-hidden="true" class="mbri-left mbr-iconfont"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#<?php echo $sliderId; ?>-l">
                    <span aria-hidden="true" class="mbri-right mbr-iconfont"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-content-wrap">
          <h3><?php echo $cardSubName; ?></h3>
          <p>
						<?php echo $cardContent; ?>
          </p>
        </div>

      </div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
			</div>

		</div>
	</div>
</div>
