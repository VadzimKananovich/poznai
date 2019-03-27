<div class="modal" id="<?php echo $modalId; ?>">
	<div class="modal-name-wrap">
		<img src="img/flag/<?php echo $flag; ?>" alt="<?php echo $modalName; ?>">
		<h3 class="modal-name"><?php echo $modalName; ?></h3>
	</div>
	<div class="modal-container">
		<div class="modal-description">
			<?php echo $modalDescription; ?>
		</div>
		<div class="modal-form-wrap">
			<form class="modal-form" action="<?php echo $url; ?>/action=send_modal" method="post">
				<div class="form-row">
					<label for="name">Ваше имя:</label>
					<input type="text" name="name" id="name" placeholder="Ваше имя" required>
				</div>
				<div class="form-row">
					<label for="tel">Номер телефона:</label>
					<input type="text" name="tel" id="tel" placeholder="+375" required>
				</div>
				<input type="hidden" name="tour" id="tour" value="egypt">
				<div class="form-row-button">
					<button type="button" name="sendTour" class="btn btn-blue btn-effect">Оставить заявку</button>
				</div>
			</form>
			<p class="form-description">
				Оставьте заявку и в ближайшее время с вами свяжется наш менеджер
			</p>
		</div>
	</div>
</div>
