<section id="contact">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-12">

				<h2 class="relative-opacity paralax-right"><strong>Контакты</strong></h2>

				<p class="above-list relative-opacity paralax-left"><strong><strong>Режим работы: Понедельник - Пятница с 9.00 до 19.00</strong></strong></p>

				<ul class="list-unstyled list-inline relative-opacity paralax-opacity">
					<li><strong><strong>г. Минск, пр-т Машерова 17, офис 701</strong></strong></li>
					<li><strong><strong><a class="phone-number" href="tel:+375(33)394-50-11">+375(29)694-50-11; +375(33)394-50-11; +375(17)284-50-11; +375(17)284-44-62</a></strong></strong></li>
					<li><strong><strong><a href="mailto:info@poznai.by">info@poznai.by</a></strong></strong></li>
					<li><strong><strong><a href="http://poznai.by/">poznai.by</a></strong></strong></li>
				</ul>
			</div>

			<div class="col-md-6">
				<div class="map-responsive">
					<iframe allowfullscreen="" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1976.0061425217816!2d27.563711501864336!3d53.91609825082627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dbcf99e0b00661%3A0x4b864c8be15dd52d!2z0L_RgNC-0YHQvy4g0JzQsNGI0LXRgNC-0LLQsCAxNywg0JzQuNC90YHQuiwg0JHQtdC70LDRgNGD0YHRjA!5e0!3m2!1sru!2sus!4v1537533867613" style="border:0" width="600" height="450" frameborder="0"></iframe>
				</div>
			</div>

			<div class="col-md-6">
				<form method="post" action="<?php echo $url; ?>?action=email_send" class="relative-opacity paralax-opacity">

					<div class="form-group">
							<label for="first_last_name">Ваше имя:</label>
							<input class="form-control" id="first_last_name" name="first_last_name" placeholder="Введите ваше имя" type="text" required>
					</div>

					<div class="form-group">
							<label for="email_address">Ваш телефон:</label>
							<input class="form-control" id="my_phone" name="my_phone" placeholder="Ваш телефон" type="text" required>
					</div>

					<div class="form-group">
							<label for="message">Сообщение:</label>
							<textarea class="form-control" id="message" name="message" rows="3" required></textarea>
					</div>

					<div class="form-group">
						<div class="row form-actions">
							<div class="col-md-5"><strong><strong><button class="btn btn-lg btn-success btn-submit" type="submit" id="emailSubmit">Отправить</button> </strong></strong></div>
						</div>
					</div>

				</form>
			</div>
		</div>
		<!-- end of row -->
	</div>
	<!-- end of container -->
</section>
