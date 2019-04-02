<footer>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<p class="footer-title">ООО «ФУТЭН»</p>
				<p class="footer-sub-title">УНП 192240779</p>
				<p class="footer-sub-title">Свидетельство о государственной регистрации 192240779 выдано Мингорисполкомом от 21.03.2014г.</p>
				<p class="footer-sub-title">Сертификат соответствия СТБ №BY/112 04.03. 003 16933 от 19.09.2017г. действителен до 19.09.2022г.</p>

			</div>
			<div class="col-md-3">
				<p class="footer-title">ТЕЛЕФОНЫ</p>
				<?php
					echo '<div class="footer-block">';
					for($i = 0; $i < count($phone); $i++){
						echo '<div class="contact-foot-row">';
						echo '<div class="contact-foot-ico">';
						echo '<span class="'.$phone[$i]->ico.' '.$phone[$i]->operator.'" title="'.$phone[$i]->operator.'">&nbsp;</span>';
						for($j = 0; $j < count($phone[$i]->messenger); $j++){
							echo '<span class="'.$phone[$i]->messenger[$j][1].' '.$phone[$i]->messenger[$j][0].' ico-24" title="'.$phone[$i]->messenger[$j][0].'"></span>';
						}
						echo '</div>';
						echo '<a class="mrr-10" href="tel:'.$phone[$i]->tel_link.'" title="'.$phone[$i]->operator.'">'.$phone[$i]->tel.'</a>';
						echo '</div>';
					}
					echo '</div>';
					?>
			</div>
			<div class="col-md-3">
				<p class="footer-title">EMAIL</p>

				<?php

				echo '<div class="footer-block">';
				for($i = 0; $i < count($email); $i++){
					echo '<div class="contact-foot-row">';
					echo '<a class="mrr-10 mail-foot" href="mailto:'.$email[$i].'" title="'.$email[$i].'"><i class="fas fa-envelope ico-24"></i>'.$email[$i].'</a><br>';
					echo '</div>';
				}
				echo '</div>';
				 ?>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php
				echo '<div class="footer-row">';
				for($i = 0; $i < count($social); $i++){
					echo '<a href="'.$social[$i]->link.'" target="_blank" title="'.$social[$i]->link.'">';
					echo '<span class="'.$social[$i]->ico.' ico-32 hover-rotate">';
					echo '</a>';
				}
				echo '</div>';
				?>
			</div>
		</div>
	</div>
	</div>
</footer>
