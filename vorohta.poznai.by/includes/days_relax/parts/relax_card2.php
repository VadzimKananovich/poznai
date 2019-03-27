<div class="relax-card-container">
	<div class="relax-img-container">
		<?php
			unset($slideImg[0], $slideImg[1]);
			$imgFirst = $slideImgDir.'/'.$slideImg[2];
		?>
		<img src="<?php echo $imgFirst; ?>" alt="poznai" data-img="<?php echo $slideImgDir.','; ?><?php echo implode(',',$slideImg); ?>">
	</div>
	<h4 class="relax-title" data-title="<?php echo $cardSubName; ?>" data-day="<?php echo 'День '.$dayNumber; ?>">
		<?php echo $cardName; ?>
	</h4>
	<p class="relax-content" data-content="<?php echo htmlspecialchars($cardContent); ?>"></p>
	<div class="relax-card-button-container">
		<button type="button" class="btn btn-primary" data-toggle="modal" onclick="openModalRelax.call(this)">
			Подробнее
		</button>

	</div>
</div>
<!-- data-target= -->
