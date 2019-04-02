<div class="modal-from-right" id="modalTour">
	<div class="container-fluid">
		<div class="row modal-right-header">
			<div class="col-md-12">
				<h5 class="modal-right-title">some title</h5>
			</div>
			<div class="close-btn">
				<i class="fas fa-window-close"></i>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<div class="modal-slider" id="modal-carousel">
					<div class="item">
						<img src="img/header/castels.jpg" alt="">
					</div>
					<div class="item">
						<img src="img/header/minsk.jpg" alt="">
					</div>
					<div class="item">
						<img src="img/header/water.jpg" alt="">
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="modal-right-container">
					<p class="modal-right-price">
						от <span class="price">200</span> <sup class="currency">BIN</sup>
					</p>
					<p class ="modal-right-content">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRequest" >Предварительный заказ</button>
				</div>
			</div>
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
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New message</h5>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> -->
			<div class="close-btn" data-dismiss="modal">
				<i class="fas fa-window-close"></i>
			</div>
		</div>
		<div class="modal-body">
			<form>
				<div class="form-group">
					<label for="recipient-name" class="col-form-label">Recipient:</label>
					<input type="text" class="form-control" id="recipient-name">
				</div>
				<div class="form-group">
					<label for="message-text" class="col-form-label">Message:</label>
					<textarea class="form-control" id="message-text"></textarea>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Send message</button>
		</div>
	</div>
</div>
</div>
