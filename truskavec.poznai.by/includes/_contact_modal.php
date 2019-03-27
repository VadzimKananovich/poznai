

<a href="#x" class="overlay" id="win1"></a>
<div class="popup">
	<h3>Заказать обратный звонок</h3>
	<form method="post" action="?action=modal_send">

		<div class="form-group">
			<label for="first_last_name">Ваше имя:</label>
			<input class="form-control" id="first_last_name" name="name" placeholder="Введите ваше имя" type="text">
		</div>

		<div class="form-group">
			<label for="email_address">Ваш телефон:</label>
			<input class="form-control" id="email_address" name="phone" placeholder="Ваш телефон" type="text">
		</div>

		<div class="form-group">
			<div class="row form-actions">
				<div class="col-md-51">
					<button class="btn btn-lg btn-success btn-submit" type="submit" id="modalSubmit">Отправить</button>
				</div>
			</div>
		</div>

	</form>
	<a class="close" title="Закрыть" href="#close"></a>
</div>
