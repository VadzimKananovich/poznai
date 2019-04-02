<div class="container-fluid">
	<div class="mrt-3 mrb-2">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center mrb-1">Для организованных групп</h2>
			</div>
		</div>
		<div class="row center-content mrt-2 mrb-1">
			<div class="col-md-2">
				<h4>Раздел:</h4>
			</div>
			<div class="col-md-6 text-center">
				<select class="form-control" id="belarusMenu">
				</select>
			</div>
			<div class="col-md-2 text-center">
				<button type="button" name="button" class="btn-primary btn" id="renameBtn">Переименовать</button>
			</div>
			<div class="col-md-2 text-center">
				<button type="button" name="button" class="btn-success btn" id="addBelarusTourBtn">Добавить</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-secondary" id="belarusTorus" >

			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="belarusSetImgModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Слайдер</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="" id="imgBelarusContainer">
				</div>
				<form  method="post" action="includes/request_tours.php?action=edit_info&type=belarus_add_img" enctype="multipart/form-data">
					<div class="row mrb-1">
						<div class="col-md-5">
							<div class="form-group">
								<label for="image">Добавить картинку</label>
								<input type="file" class="form-control-file" id="image" name="image" required>
								<input type="hidden" id="inputItem" name="inputItem">
							</div>
						</div>
						<div class="col-md-7">
							<button type="submit" name="button" class="btn btn-success" id="sendModal">Загрузить</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editBelarusTour" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="margin:0; margin-left:13px">
		<div class="modal-content" style="width:96vw;">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Изменить</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form  method="post" action="includes/request_tours.php?action=edit_info&type=belarus_edit_tour">
				<div class="modal-body">
					<div class="form-group">
						<label for="inputName">Заголовок</label>
						<input type="text" class="form-control" id="inputName" name="inputName">
						<input type="hidden" id="inputItem" name="inputItem">
					</div>
					<div class="form-group">
						<label for="inputDesc">Краткое описание</label>
						<textarea cols="100" class="form-control" id="inputDesc" name="inputDesc" ></textarea>
					</div>
					<div class="form-group">
						<label for="inputPrice">Стоимость</label>
						<input type="text" class="form-control" id="inputPrice" name="inputPrice">
					</div>
					<div class="form-group">
						<label for="inputCurrency">Валюта</label>
						<input type="text" class="form-control" id="inputCurrency" name="inputCurrency">
					</div>
					<div class="form-group">
						<label for="inputRoute">Маршрут</label>
						<textarea class="form-control" id="inputRoute" name="inputRoute"></textarea>
					</div>
					<div class="form-group">
						<label for="inputDuration">Продолжительность</label>
						<input type ='text' class="form-control" id="inputDuration" name="inputDuration">
					</div>
					<div class="form-group">
						<label for="inputProgram">Программа</label>
						<textarea class="form-control" id="inputProgram" name="inputProgram"></textarea>
					</div>
					<div class="form-group">
						<label for="inputProgram">Основные места</label>
						<input type="text" class="form-control" id="inputPlace" name="inputPlace" placeholder="Введите основные места тура через запятую">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					<button type="submit" class="btn btn-primary" id="sendModal">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addBelarusTour" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="margin:0; margin-left:13px">
		<div class="modal-content" style="width:96vw;">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Добавить</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form  method="post" action="includes/request_tours.php?action=edit_info&type=belarus_add_tour">
				<div class="modal-body">
					<div class="form-group">
						<label for="inputName">Заголовок</label>
						<input type="text" class="form-control" id="inputName" name="inputName">
						<input type="hidden" id="inputItem" name="inputItem">
					</div>
					<div class="form-group">
						<label for="inputDescAdd">Краткое описание</label>
						<textarea class="form-control" id="inputDescAdd" name="inputDescAdd"></textarea>
					</div>
					<div class="form-group">
						<label for="inputPrice">Стоимость</label>
						<input type="text" class="form-control" id="inputPrice" name="inputPrice">
					</div>
					<div class="form-group">
						<label for="inputCurrency">Валюта</label>
						<input type="text" class="form-control" id="inputCurrency" name="inputCurrency">
					</div>
					<div class="form-group">
						<label for="inputRouteAdd">Маршрут</label>
						<textarea class="form-control" id="inputRouteAdd" name="inputRouteAdd"></textarea>
					</div>
					<div class="form-group">
						<label for="inputProgramAdd">Программа</label>
						<textarea class="form-control" id="inputProgramAdd" name="inputProgramAdd"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					<button type="submit" class="btn btn-primary" id="sendModal">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>




<div class="modal fade" id="delBelarusTour" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Удалить</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form  method="post" action="includes/request_tours.php?action=edit_info&type=belarus_del_tour">
				<div class="modal-body">
					<div class="col-md-12">
						<p class="text-center">Вы уверены что хотите удалить?</p>
					</div>
					<div class="col-md-12">
						<input type="hidden" id="inputItem" name="inputItem">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					<button type="submit" class="btn btn-primary" id="sendModal">Подтвердить</button>
				</div>
			</form>
		</div>
	</div>
</div>




<div class="modal fade" id="renameSectionModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Переименовать</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form  method="post" action="includes/request_tours.php?action=edit_info&type=belarus_rm_section">
				<div class="modal-body">
					<div class="form-group">
						<label for="inputName">Название раздела</label>
						<input type="text" class="form-control" id="inputName" name="inputName">
						<input type="hidden" id="inputItem" name="inputItem">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					<button type="submit" class="btn btn-primary" id="sendModal">Подтвердить</button>
				</div>
			</form>
		</div>
	</div>
</div>
