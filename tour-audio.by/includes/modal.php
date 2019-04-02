<div class="modal fade" id="readMoreModal" tabindex="-1" role="dialog" aria-labelledby="readMoreTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content modal-xl">
      <div class="modal-header">
        <h5 class="modal-title" id="readMoreTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-caption">
        </div>
        <p class="modal-slogan"></p>
        <div class="modal-text">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactModalLabel">Обратный звонок</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="backCallForm" action="includes/request.php?action=send_call">
          <div class="form-group">
            <label for="callName">Имя</label>
            <input type="text" class="form-control" name="callName" id="callName" id="nameLabel" required>
          </div>
          <div class="form-group">
            <label for="callNum">Телефон</label>
            <input type="text" class="form-control" name="callNum" id="callNum" required>
          </div>
          <div class="form-group">
            <label for="numLabel">Email</label>
            <input type="email" data-type="email" class="form-control" name="callEmail" id="callEmail">
          </div>
          <div class="btn-wrap-right">
            <button type="submit" class="btn btn-submit">Отправить</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="send" class="btn btn-reverse" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
