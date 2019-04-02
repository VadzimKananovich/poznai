<section class="comments" data-file="comments">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="section-title">Отзывы</h2>
				<div class="swiper-slider swipper-comments">
					<div class="swiper-wrapper" id="comments">

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="leave-comment">
	<h2 class="section-title">Оставить отзыв</h2>
	<div class="container">
		<form class="" action="index.html" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name">Имя</label>
						<input type="text" name="name" id="name" class="form-control" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" id="email" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<label for="comment">Ваш отзыв</label>
					<textarea name="comment" id="comment" class="form-control"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" name="sendComment" class="submit-button btn btn-success">Отправить</button>
				</div>
			</div>
		</form>
	</div>
</section>
