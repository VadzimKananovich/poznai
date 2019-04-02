<section class="features17 cid-r9gk48CsyH program-relax" id="features17-i">
	<div class="mbr-section content4 cid-r9gdWSAZt4 section-title" id="content4-g">
		<div class="container">
			<div class="media-container-row">
				<div class="title col-12 col-md-8">
					<h2 class="align-center pb-3 mbr-fonts-style display-2">Программа отдыха в Ворохте на 9/10 дней</h2>
					<h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-7"></h3>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<?php
		$includeCard = scandir('includes/days_relax');
		for($i = 3; $i < count($includeCard); $i++){
			include 'days_relax/'.$includeCard[$i];
		}
		?>
	</div>
</section>
