

<section class="contact" data-file="contact">
	<div id="contact">
		<h2 class="section-title" data-aos="fade-top">ОБРАТНАЯ СВЯЗЬ</h2>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 contact-container">
					<div class="contact-img" data-aos="fade-right">	</div>
					<div class="address-form-wrap" data-aos="fade-left">
						<div class="contact-address">
							<!-- <h3>Познай БЕЛ</h3> -->
							<div class="logo-container text-center mrb-1">
								<img src="img/logo/logo.png" alt="ПОЗНАЙ БЕЛ" class="ico-82 text-center">
							</div>
							<address>
								<p><strong>Город:</strong> <?php echo $city; ?></p>
								<p><strong>Адрес:</strong> <?php echo $address; ?></p>
								<p><strong>Индекс:</strong> <?php echo $postal; ?></p>
								<?php
								for($i = 0; $i < count($email); $i++){
									echo '<p><strong>E-mail:</strong> ';
									echo '<a href="mailto:'.$email[$i].'">'.$email[$i].'</a>';
									echo '</p>';
								}
								?>
							</address>
							<?php
							if(count($phone)>0){
								echo '<br>';
								for($i = 0; $i < count($phone); $i++){
									echo '<p class="social-row">';
									echo '<span class="'.$phone[$i]->ico.' '.$phone[$i]->operator.'" title="'.$phone[$i]->operator.'">&nbsp;</span>';
									for($j = 0; $j < count($phone[$i]->messenger); $j++){
										echo '<span class="'.$phone[$i]->messenger[$j][1].' '.$phone[$i]->messenger[$j][0].' ico-24" title="'.$phone[$i]->messenger[$j][0].'"></span>';
									}
									echo '<a class="mrr-10" href="tel:'.$phone[$i]->tel_link.'" title="'.$phone[$i]->operator.'">'.$phone[$i]->tel.'</a>';
									echo '</p>';
								}
							}
							if(count($social)>0){
								echo '<h3>В социальных сетях</h3>';
								for($i = 0; $i < count($social); $i++){
									echo '<p class="social-row">';
									echo '<span class="'.$social[$i]->ico.' ico-24"></span>';
									echo '<a class="mrr-10" href="'.$social[$i]->link.'" target="_blank" title="'.$social[$i]->link.'">';
									echo $social[$i]->social;
									echo '</a>';
									echo '</p>';
								}
							}
							?>
						</div>

						<div class="contact-form">
							<h3>Обратная связь</h3>
							<form class="customform" action="includes/request.php?action=sendmail" id="contactForm" data-type="email">
								<div class="s-12"><input name="email" placeholder="e-mail" title="e-mail" type="email" id="email" /></div>
								<div class="s-12"><input name="name" placeholder="имя" title="имя" type="text" id="name"/></div>
								<div class="s-12"><textarea placeholder="Сообщение" name="message" id="message" rows="5"></textarea></div>
								<div class="s-12"><button class="color-btn" type="submit">Отправить</button></div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</section>
