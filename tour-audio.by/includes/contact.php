<section id="contact_form">
	<div class="container">
		<div class="row">
			<div class="col-md-4 centered">
				<h2>Нуждаетесь в консультации?</h2>
				<h2 class="second_heading">Заполните форму и наш специалист с вами свяжется</h2>
			</div>
			<div class="col-md-8 center-left">
				<form id="ContactForm" class="form-inline" action="includes/request.php?action=send_call">
					<div class="form-group">
						<input type="text" class="form-control" name="callName" id="callName" placeholder="Имя" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="callNum" id="callNum" placeholder="Телефон" required>
					</div>
					<div class="form-group">
						<input type="email" data-type="email" class="form-control" name="callEmail" id="callEmail" placeholder="Email"></input>
					</div>
					<button type="submit" class="btn submit_btn">Отправить</button>
				</form>
			</div>

		</div>
	</div>
</section>
