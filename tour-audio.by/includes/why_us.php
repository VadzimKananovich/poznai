<?php
$whyWe = new WhyWe;
$items = &$whyWe->whyWe;
?>

<section id="why_us">
	<div class="container text-center">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="head_title">
					<h2><?php echo $items['title']; ?></h2>
					<p>
						<?php echo $items['subTitle']; ?>
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<?php
			$whyWe->insertCards();
			?>
		</div>
	</div>
</section>
