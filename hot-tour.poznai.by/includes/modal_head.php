<div class="modal" id="<?php echo $modalId; ?>">
	<div class="modal-name-wrap">
		<img src="<?php echo $flagModal; ?>" alt="<?php echo $modalName; ?>">
		<h3 class="modal-name"><?php echo $modalName; ?></h3>
	</div>
	<div class="modal-container">
		<div class="modal-description">
			<?php echo $modalDescription; ?>
		</div>
		<div class="modal-form-wrap">
			<form class="modal-form" action="<?php echo $url; ?>?action=send_modal" method="post">
				<div class="form-row">
					<label for="name">Ваше имя:</label>
					<input type="text" name="name" id="name" placeholder="Ваше имя" required>
				</div>
				<div class="form-row">
					<label for="tel">Номер телефона:</label>
					<input type="text" name="tel" id="tel" placeholder="+375" required>
				</div>
				<input type="hidden" name="tour" id="tour" value="<?php echo $modalName; ?>">
				<div class="form-row-button">
					<button type="submit" name="sendTour" class="btn btn-blue btn-effect">Оставить заявку</button>
				</div>
			</form>
			<div class="form-description">
				<p>
					Оставьте заявку и в ближайшее время с вами свяжется наш менеджер
				</p>
				<span class="white-enter"></span>
				<a href="tel:+375333645011" title="Позвонить нам"><i class="fas fa-phone"></i> <span class="modal-tel">+375 (33) 364-50-11 (МТС)</span> </a>
				<span class="white-enter"></span>
				<a href="viber://chat?number=+375296645011" title="Открыть в вайбере"><i class="fab fa-viber"></i> <span class="modal-tel">+375 (29) 664-50-11</span> </a>
			</div>
		</div>
		<a href="" class="closeModal"><i class="fas fa-times-circle"></i></a>
	</div>
</div>
