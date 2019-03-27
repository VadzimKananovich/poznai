<article id="toDelete" style="background-color: #6f6d75">
	<h3><?php echo $json_ld[0]; ?></h3>
	<h4>Маршрут: <?php echo $json_ld[4]; ?></h4>
	<h5>Стоимость: <?php echo $json_ld[2].' '.$json_ld[3]; ?></h5>
	<figure>
		<img src="<?php echo $json_ld[7]; ?>" alt="<?php echo $json_ld_preview[0]; ?>">
	</figure>
	<p style="font-size: 20px;">
		<?php echo 'Продолжительность: '.$json_ld[5]; ?>
		<?php echo $json_ld[1]; ?>
		<?php echo $json_ld[6]; ?>
	</p>
</article>
