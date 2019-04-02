
<?php
$complectImg = scandir('img/complect/gallery');

?>
<section id="comments" class="menu-section" data-menuIco="far fa-comments" data-menuName="Отзывы" data-file="comments">

	<h2 class="section-title show-from-bottom"><span>Отзывы</span></h2>

<div class="wrapper-comments-bg ">
	<div class="overflow"></div>
	<!-- <div class="parallax-window" data-parallax="scroll" data-image-src="img/bg-comments.png"></div> -->
	<div class="comments-wrap mCustomScrollbar"  data-mcs-theme="inset-2-dark">
		<!-- <div class="comments-row">
			<div class="comments-img-name">
				<div class="comments-img">
					<img src="img/noprofile.png" alt="tour-audio">
				</div>
				<p class="comments-title">
					<span>VADZIM</span>
				</p>
			</div>
			<div class="comments-content">
				<p class="comments-text">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p class="comments-date">13.03.2018</p>
			</div>
		</div>


		<div class="comments-row comments-reverse">
			<div class="comments-img-name">
				<div class="comments-img">
					<img src="img/noprofile.png" alt="tour-audio">
				</div>
				<p class="comments-title">
					<span>VADZIM</span>
				</p>
			</div>
			<div class="comments-content">
				<p class="comments-text">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p class="comments-date">13.03.2018</p>
			</div>
		</div>

		<div class="comments-row comments-reverse">
			<div class="comments-img-date">
				<div class="comments-img">
					<img src="img/noprofile.png" alt="tour-audio">
				</div>
				<p class="comments-date">13.03.2018</p>
			</div>
			<div class="comments-content">
				<p class="comments-title">
					<span>VADZIM</span>
				</p>
				<p class="comments-text">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			</div>
		</div> -->

	</div>
</div>


	<h3 class="section-title show-from-bottom" id="openCommentWrite"><span><i class="fas fa-comment"></i>Оставить отзыв</span></h2>
		<div class="write-comment-wrap hide-comments" id="writeCommentContainer">
			<form class="write-comment" enctype="multipart/form-data" action="?action=sendcomment" method="post">

				<div class="write-comment-dates-row ">
					<div class="write-comment-private">
						<div class="write-comment-row required">
							<i class="fas fa-asterisk"></i>
							<p class="write-comment-name">Ваше имя:</p>
							<input type="text" name="name" id="nameComment" placeholder="Ваше имя" required>
						</div>
						<div class="write-comment-row required">
							<i class="fas fa-asterisk"></i>
							<p class="write-comment-name">Ваш email:</p>
							<input type="email" name="email" id="email" placeholder="Ваш email" required>
						</div>
						<div class="write-comment-row form-element">
							<p class="write-comment-name">Аватарка / логотип компании:</p>
							<input type="file" name="myfile" id="myfile" data-label="Выберите файл" accept="image/*" >
						</div>
					</div>

					<div class="write-comment-company">
						<div class="write-comment-row">
							<p class="write-comment-name">Название компании:</p>
							<input type="text" name="company" id="company" placeholder="Название компании">
						</div>
						<div class="write-comment-row">
							<p class="write-comment-name required">Официальный сайт:</p>
							<input type="text" name="address" id="address" placeholder="http://">
						</div>
					</div>
				</div>

				<div class="write-comment-row required message-row">
					<i class="fas fa-asterisk"></i>
					<p class="write-comment-name">Ваш отзыв:</p>
					<textarea name="comment" id="comment" required></textarea>
				</div>

				<div class="write-comment-row button-row">
					<button class="btn" type="submit" name="sendcomment" id="sendComment">Отправить</button>
				</div>

			</form>
		</div>
	</section>
