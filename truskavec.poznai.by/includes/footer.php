<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4 footer-section column">
				<h3><strong><strong>Poznai.by</strong></strong></h3>
				<h4>ООО «ФУТЭН»</h4>
				<p>Туроператор!
					<br>
					УНП 192240779<br>
					Свидетельство о государственной регистрации 192240779 выдано Мингорисполкомом от 21.03.2014г.<br>
					Сертификат соответствия СТБ №BY/112 04.03. 003 16933 от 19.09.2017г. действителен до 19.09.2022г.<br>
					Стоимость в валюте указана справочно. Оплата производится в белорусских рублях по установленному курсу.
				</div>

				<div class="col-md-4 col-md-offset-4 footer-section">


					<div class="social-icons-container"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- <a href="#header" class="back-to-top page-scroll" style="display: block;">
		<i class="fas fa-arrow-up"></i>
	</a> -->

	<div id="copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-12 copy">
					<p><strong><strong>&copy; 2014-2018 <a href="http://poznai.by/">Poznai.by</a> Все права защищены.</strong></strong></p>
				</div>
			</div>
		</div>
	</div>

	<div aria-hidden="false" aria-labelledby="galleryModalLabel" class="modal fade" id="galleryModal" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-nav">
					<div class="title pull-left">

					</div>
					<strong><strong><button class="close pull-right" data-dismiss="modal" type="button"><span aria-hidden="true">×</span><span class="sr-only">Закрыть</span></button> </strong></strong></div>

					<div class="modal-body" id="galleryModalLabel">

					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="inquiryModal" tabindex="-1" role="dialog" aria-labelledby="inquiryModalLabel" aria-hidden="true" data-backdrop="static" style="display: none;"><strong><strong>
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="http://truskavec.poznai.by/#" method="post" id="inquiry-form" name="inquiry-form">
						<input type="hidden" name="action" value="send_inquiry_form">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
							<h4 class="modal-title" id="inquiryModalLabel"><i class="icon-calendar"></i> Узнать наличие мест</h4>
						</div>
						<div class="modal-body">
							<div class="room-and-date">
								<div class="alert hidden" id="inquiry-form-msg">Сообщение...</div>
								<div class="room-select">
									<div class="input-group">
										<select name="inquiry-object" id="inquiry-object" class="form-control">
											<option value="">Выберите...</option>
											<option value="lvov-2-1">Львов 2 дня 1 ночь</option>
											<option value="lvov-3-2">Львов 3 дня 2 ночи</option>
											<option value="uml">Ужгород-Мукачево-Львов</option>
										</select>
									</div>
								</div>

								<div class="inquiry-people">
									<div class="people-select">
										<label for="inquiry-children">Количество детей?</label>

										<div class="input-group">
											<span class="input-group-addon"><i class="icon-user-follow"></i></span>
											<select name="inquiry-children" class="form-control" id="inquiry-children">
												<option value="Without children">Без детей</option>
												<option value="1 - Child">1 - Ребенок</option>
												<option value="2 - Children">2 - Ребенка</option>
												<option value="3 - Children">3 - Ребенка</option>
												<option value="4 - Children">4 - Ребенка</option>
												<option value="5 - Children">5 - Ребенка</option>
											</select>
										</div>
									</div>

									<div class="people-select" style="padding-right: 7px;">
										<label for="inquiry-adults">Количество взрослых?</label>

										<div class="input-group">
											<span class="input-group-addon"><i class="icon-user-follow"></i></span>
											<select name="inquiry-adults" class="form-control" id="inquiry-adults">
												<option value="1 - Adult">1 - Взрослый</option>
												<option value="2 - Adult">2 - Взрослых</option>
												<option value="3 - Adult">3 - Взрослых</option>
												<option value="4 - Adult">4 - Взрослых</option>
												<option value="5 - Adult">5 - Взрослых</option>
												<option value="6 - Adult">6 - Взрослых</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>

								<div class="inquiry-check-in">
									<div class="date-select">
										<label for="inquiry-date-check-in">Планируемая дата выезда?</label>

										<div class="input-group">
											<span class="input-group-addon"><i class="icon-calendar"></i></span>
											<input type="text" class="form-control datepicker" name="inquiry-date-check-in" id="inquiry-date-check-in" placeholder="С: мм/дд/год">
										</div>
									</div>
									<div class="date-select">
										<label for="inquiry-date-check-out">Планируемая дата возврата?</label>

										<div class="input-group">
											<span class="input-group-addon"><i class="icon-calendar"></i></span>
											<input type="text" class="form-control datepicker" name="inquiry-date-check-out" placeholder="По: мм/дд/год" id="inquiry-date-check-out">
										</div>
									</div>

									<div class="clearfix"></div>
								</div>

							</div>

							<hr>
							<div class="personal-information">
								<h2>Персональная информация</h2>
								<div class="form-group first-name-group">
									<label for="first-name">Имя</label>
									<input type="text" name="first-name" class="form-control" id="first-name" placeholder="Введите ваше имя">
								</div>
								<div class="form-group last-name-group">
									<label for="last-name">Фамилия</label>
									<input type="text" name="last-name" class="form-control" id="last-name" placeholder="Введите вашу фамилию">
								</div>
								<div class="form-group city-group">
									<label for="city">Город</label>
									<input type="text" name="city" class="form-control" id="city" placeholder="Город">
								</div>
								<div class="clearfix"></div>
								<div class="form-group phone-group">
									<label for="phone">Телефон</label>
									<input type="text" name="phone" class="form-control" id="phone" placeholder="Номер телефона с кодом">
								</div>
								<div class="form-group email-group">
									<label for="email">Email</label>
									<input type="text" name="email" class="form-control" id="email" placeholder="Электронная почта">
								</div>
								<div class="clearfix"></div>
								<div class="newsletter-checkbox">
									<input type="checkbox" id="newsletter-cb" name="newsletter" value="Хочу быть в курсе снижения цен и новых туров!">
									<label for="newsletter-cb">Хочу быть в курсе снижения цен и новых туров!</label>
								</div>
							</div>
						</div>
						<div class="modal-footer">

							<div class="inquiry-info">
								<div class="inquiry-info-sign hidden-xs">!</div>
								<p>Обратите внимание, это форма для запроса брони. А не для бронирования. <br>
									<strong>Мы свяжемся с вами как можно быстрее. Спасибо!</strong></p>
								</div>
								<button type="submit" class="btn btn-inquiry-submit">Узнать наличие</button>
							</div>
						</form>
					</div>
				</div>
			</strong></strong>
		</div>
