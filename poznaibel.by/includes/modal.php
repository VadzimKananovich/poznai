<div class="modal-from-right" id="modalTour">
	<div class="container-fluid container-modal-tour">
		<div class="row modal-right-header">
			<div class="col-md-12">
				<h5 class="modal-right-title">some title</h5>
			</div>
			<div class="close-btn-wrap">
				<div class="close-btn">
					<i class="fas fa-window-close"></i>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="modal-slider" id="modal-carousel">
				</div>
				<p class="modal-right-price">
					от <span class="price">200</span> <sup class="currency">BIN</sup>
				</p>
				<p class="modal-route-content route-wrap">
					<span class="title-text">Маршрут: </span>
					<span class="modal-tour-route"></span>
				</p>
				<p class="modal-route-content">
					<span class="title-text">Продолжительность: </span>
					<span class="modal-tour-duration"></span>
				</p>
				<p class ="modal-right-content">
				</p>
				<div class="btn-wrap-right">
					<button id="sendRequest"type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRequest" >Предварительный заказ</button>
				</div>
			</div>
		</div>
		<div class="container-modal-content">
			<div class="row">
				<div class="col-md-12">
					<h6 class="tour-modal-title">Программа тура</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="modal-tour-program">

						</div>
					</div>
				</div>
				<!-- <div class="row">
				<div class="col-md-12">
				<div class="modal-tour-route">

			</div>
		</div>
	</div> -->
</div>
</div>
</div>





<div class="modal-from-right" id="modalAllTours">
	<div class="container-fluid">
		<div class="row modal-right-header">
			<div class="col-md-12">
				<h5 class="modal-right-title">ВСЕ ТУРЫ ПО БЕЛАРУСИ</h5>
			</div>
			<div class="close-btn">
				<i class="fas fa-window-close"></i>
			</div>
		</div>
		<div class="modal-right-content"></div>
	</div>
</div>







<div class="modal fade" id="modalRequest" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Обратный звонок</h5>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> -->
			<div class="close-btn" data-dismiss="modal">
				<i class="fas fa-window-close"></i>
			</div>
		</div>
		<form id="modalRequestForm" data-type="request" action="includes/request.php?action=sendrequest">
			<div class="modal-body">
				<div class="form-group">
					<label for="name" class="col-form-label">Имя:</label>
					<input type="text" class="form-control" id="name">
					<input type="hidden" id="tourInput" value="">
				</div>
				<div class="form-group">
					<label for="tel" class="col-form-label">Телефон:</label>
					<input type="text" class="form-control" id="tel">
				</div>
				<div class="form-group">
					<label for="tel" class="col-form-label">Email:</label>
					<input type="text" class="form-control" id="email">
				</div>
				<hr>
				<div class="form-group">
					<p>Способ связи:</p>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="prefTel" name="prefTel" value="1">
						<label class="form-check-label" for="prefTel"><i class="fas fa-mobile-alt modal-ico"></i> Телефон</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="prefEmail" value="prefEmail">
						<label class="form-check-label" for="prefEmail"><i class="fas fa-at modal-ico"></i> Email</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="prefViber" value="prefViber">
						<label class="form-check-label" for="prefViber"><i class="fab fa-viber modal-ico"></i> Viber</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="prefWhatsApp" value="prefWhatsApp">
						<label class="form-check-label" for="prefWhatsApp"><i class="fab fa-whatsapp modal-ico"></i> WhatsApp</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="prefSkype" value="prefSkype">
						<label class="form-check-label" for="prefSkype"><i class="fab fa-skype modal-ico"></i> Skype</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="btn-container text-right">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
					<button type="submit" class="btn btn-primary" id="sendBtn">Заказать</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>

<div class="contact-us-fixed">
	<div class="btn-wrap">
		<i class="fas fa-phone" data-toggle="modal" data-target="#modalRequest"></i>
	</div>
	<p>Заказать<br> консультацию</p>
</div>
