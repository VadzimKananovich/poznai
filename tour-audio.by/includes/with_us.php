<?php
$withUs = new WithUs;
 ?>
<section id="withUs">
	<div class="container">
		<h2><?php echo $withUs->title; ?></h2>
		<div class="row">
			<?php $withUs->insertCards(); ?>
		</div>
	</div>
</section>
