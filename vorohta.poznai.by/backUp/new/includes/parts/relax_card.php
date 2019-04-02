
<div class="relax-card-container">
		<div class="relax-img-container">
			<img src="<?php echo 'img/relax/'.$dayNumber.'/'.$programNumber.'/'.$slideImg[0]; ?>" alt="Mobirise">
		</div>
			<h4 class="relax-title">
				<?php echo $cardName; ?>
			</h4>
			<p class="relax-content">
				<?php echo $cardContent; ?>
			</p>
		<div class="relax-card-button-container">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $sliderId; ?>">
				Подробнее
			</button>
		</div>
</div>
