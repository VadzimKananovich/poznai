<?php
$comments = new Comments;
?>
<section id="testimonial">
	<div class="container text-center testimonial_area">
		<h2><?php echo $comments->dates['title']; ?></h2>
		<p>
			<?php echo $comments->dates['subTitle']; ?>
		</p>
		<div class="row">
			<?php
			$comments->insertComments();
			?>
		</div>
	</div>
</section>
