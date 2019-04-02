<div class="container-fluid">
	<div class="mrt-3 mrt-5">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center mrb-1">НАША БЕЛАРУСЬ</h2>
			</div>
		</div>
		<div class="row mrt-1 mrb-1">
			<div class="col-md-2">
				<h4>Раздел:</h4>
			</div>
			<div class="col-md-6 text-center">
				<select class="form-control" id="aboutBelarusSelect">
				</select>
			</div>
			<div class="col-md-2 text-center">
				<button type="button" name="button" class="btn-primary btn" id="renameBtn">Переименовать</button>
			</div>
			<div class="col-md-2 text-center">
				<button type="button" name="button" class="btn-success btn" id="addBtn">Добавить</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Заголовок</th>
						<th scope="col">Описание</th>
						<th scope="col">Картинка</th>
						<th scope="col">#</th>
						<th scope="col">#</th>
					</tr>
				</thead>
				<tbody id="aboutBelarusTable">

				</tbody>
			</table>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="editAbout" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Изменить</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form  method="post" action="includes/request.php?action=edit_info&section=about_belarus" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="inputName">Заголовок</label>
						<input type="text" class="form-control" id="inputName" name="inputName">
						<input type="hidden" id="inputItem" name="inputItem">
					</div>
					<div class="form-group">
						<label for="inputDesc">Описание</label>
						<textarea class="form-control" id="inputDesc" name="inputDesc"></textarea>
					</div>
					<div class="form-group">
						<label for="image">Загрузить другую картинку</label>
						<input type="file" class="form-control-file" id="image" name="image">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>




<div class="modal fade" id="addAbout" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Добавить</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form  method="post" action="includes/request.php?action=edit_info&section=add_about_belarus" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="inputName">Заголовок</label>
						<input type="text" class="form-control" id="inputName" name="inputName" required>
						<input type="hidden" id="inputItem" name="inputItem">
					</div>
					<div class="form-group">
						<label for="inputDesc">Описание</label>
						<textarea class="form-control" id="inputDesc" name="inputDesc" required></textarea>
					</div>
					<div class="form-group">
						<label for="image">Загрузить картинку</label>
						<input type="file" class="form-control-file" id="image" name="image" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>




<div class="modal fade" id="delAbout" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Удалить</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form  method="post" action="includes/request.php?action=edit_info&section=del_about_belarus" enctype="multipart/form-data">
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
					<button type="submit" class="btn btn-primary">Подтвердить</button>
				</div>
			</form>
		</div>
	</div>
</div>
