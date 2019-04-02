<div class="container-fluid" id="footer">
	<div class="row">
		<div class="col-md-4">
			<div class="foot-logo">
				<img src="<?php echo $url.$_logo; ?>" alt="<?php echo $_logo_title; ?>">
			</div>
			<div class="foot-desc">
				<p>
					<?php echo $_company_desc; ?>
				</p>
			</div>
		</div>
		<div class="col-md-4 foot-info">
			<p class="foot-title">Адрес</p>
			<p class="foot-text"><span class="foot-info_name">Город: </span><?php echo $_city; ?></p>
			<p class="foot-text"><span class="foot-info_name">Адрес: </span><?php echo $_address; ?></p>
			<p class="foot-text"><span class="foot-info_name">Индекс: </span><?php echo $_postal; ?></p>
		</div>
		<div class="col-md-4 foot-info">
			<p class="foot-title">Контакты</p>
			<?php

			if($_phone && count($_phone) > 0){
				echo '<div class="foot-contact_block foot-phone">';
				for($i = 0; $i < count($_phone); $i++){
					echo '<div class="foot-contact_row">';
					if($_phone[$i]->operator !== 'skypeName' && $_phone[$i]->operator !== 'email'){
						echo '<a class="ico-link" href="tel:'.$_phone[$i]->tel_link.'" title="'.$_phone[$i]->name.'">';
						echo '<i class="foot-phone_ico '.$_phone[$i]->ico.' ico-24"></i>';
						echo '</a>';
					}
					if($_phone[$i]->messenger && count($_phone[$i]->messenger) > 0){
						$mess = &$_phone[$i]->messenger;
						for($j = 0; $j < count($mess); $j++){
							echo '<a class="ico-link" href="'.$mess[$j]['link'].'" title="'.$mess[$j]['name'].'">';
							echo '<i class="foot-phone_ico '.$mess[$j]['ico'].' ico-24"></i>';
							echo '</a>';
						}
					}
					if($_phone[$i]->operator !== 'skypeName' && $_phone[$i]->operator !== 'email'){
						$telLink = 'tel:'.$_phone[$i]->tel_link;
					} else {
						$telLink = 'skype://'.$_phone[$i]->tel_link.'?call';
					}
					echo '<a href="'.$telLink.'" title="'.$_phone[$i]->name.'">';
					echo $_phone[$i]->tel;
					echo '</a>';
					echo '</div>';
				}
				echo '</div>';
			}

			if($_email && count($_email) > 0){
				echo '<div class="foot-contact_block foot-email">';
				for($i = 0; $i < count($_email); $i++){
					echo '<div class="foot-contact_row email">';
					$email_link = "mailto:".$_email[$i];
					echo '<a href="'.$email_link.'"><i class="foot-contact_ico '.$_icon['email'].' ico-24"></i>'.$_email[$i].'</a>';
					echo '</div>';
				}
				echo '</div>';
			}
			?>
		</div>
	</div>
	<?php

	if($_social && count($_social) > 0){
		echo '<div class="foot-social-container">';
		for($i = 0; $i < count($_social); $i++){
			echo '<a href="'.$_social[$i]->link.'" title="'.$_social[$i]->name.'" target="_blank">';
			echo '<i class="'.$_social[$i]->ico.' foot-social-ico"></i>';
			echo '</a>';
		}
		echo '</div>';
	}

	 ?>
</div>
