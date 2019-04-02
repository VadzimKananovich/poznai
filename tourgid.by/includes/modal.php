<div class="modal" id="contactModal">
	<div class="modal-container">
		<div class="modal-head">
			<h5 class="modal-title">Форма обратной связи</h5>
			<i class="fas fa-times font-ico close-modal"></i>
		</div>
		<div class="modal-body">
			<form id="modalContactForm" action="includes/request.php?action=contact_call_back" method="post">
				<div class="form-group">
					<label for="modalName">Имя<span class="label-required">*</span></label>
					<input type="text" name="modalName" id="modalName" class="bg-input person" required>
				</div>
				<div class="form-group">
					<label for="modalNum">Телефон<span class="label-required">*</span></label>
					<input type="text" name="modalNum" id="modalNum" class="bg-input phone" required>
				</div>
				<div class="btn-group right">
					<button type="submit" name="button" class="btn">отправить</button>
				</div>
			</form>
		</div>
		<div class="modal-footer">

		</div>
	</div>
</div>
