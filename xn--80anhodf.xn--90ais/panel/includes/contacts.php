<section id="contactForms">
	<div class="container-fluid">
		<div class="row mrt-1">
			<div class="col-md-12 mrb-1">
				<h2 class=" text-center">КОНТАКТЫ</h2>
			</div>
		</div>
	</div>

	<div class="container">
		<form id="formCity" action="index.html" method="post">
			<div class="row">
				<div class="col-md-2">
					<label for="city">Город:</label>
				</div>
				<div class="col-md-10">
					<input type="text" name="city" class="form-control" data-type="city">
				</div>
			</div>
			<div class="row submit-wrap">
				<div class="col-md-12">
					<div class="form-group text-right">
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="container">
		<form id="formPostal" action="index.html" method="post">
			<div class="row">
				<div class="col-md-2">
					<label for="city">Почтовый код (индекс):</label>
				</div>
				<div class="col-md-10">
					<input type="text" name="postal" class="form-control" data-type="postal">
				</div>
			</div>
			<div class="row submit-wrap">
				<div class="col-md-12">
					<div class="form-group text-right">
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="container">
		<form id="formAddress" action="index.html" method="post">
			<div class="row">
				<div class="col-md-2">
					<label>Адрес:</label>
				</div>
				<div class="col-md-10">
					<input type="text" name="address" class="form-control" data-type="address">
				</div>
			</div>
			<div class="row submit-wrap">
				<div class="col-md-12">
					<div class="form-group text-right">
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="container">
		<form id="formEmail" action="index.html" method="post">
			<div class="row">
				<div class="col-md-2">
					<label>Email:</label>
				</div>
				<div class="col-md-10">
					<input type="text" name="address" class="form-control" data-type="email">
				</div>
			</div>
			<div class="row submit-wrap">
				<div class="col-md-12">
					<div class="form-group text-right">
					</div>
				</div>
			</div>
		</form>
	</div>


	<div class="container">
		<form action="index.html" method="post" id="formPhone">

			<div class="row submit-wrap">
				<div class="col-md-12">
					<div class="form-group text-right">
						<button type="button" name="addButton" class="btn btn-success mrt-1 add-btn">ДОБАВИТЬ</button>
					</div>
				</div>
			</div>

		</form>
	</div>

	<div class="container">
		<form action="index.html" method="post" id="formSocial">


			<div class="row submit-wrap">
				<div class="col-md-12">
					<div class="form-group text-right">
						<button type="button" name="addButton" class="btn btn-success mrt-1 add-btn">ДОБАВИТЬ</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="container mrb-2">
		<div class="row">
			<div class="col-md-12 text-right">
				<button type="submit" name="submitButton" id="submitButton" class="btn btn-primary">сохранить изменения</button>
			</div>
		</div>
	</div>


</section>
