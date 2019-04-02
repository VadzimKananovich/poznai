<?php
$page = basename($_SERVER['PHP_SELF']);
$curr_page_ex = explode('.',$page);
$curr_page = $curr_page_ex[0];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand" href="<?php echo $url; ?>" target="_blank">
			<img src="<?php echo $url; ?>img/logo/logo.png" class="ico-32" alt="Открыть сайт" title="Открыть сайт">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item<?php if ($curr_page === 'index') {echo ' active';} ?>">
					<a class="nav-link" href="<?php echo $url.'panel'; ?>">Главная</a>
				</li>
				<li class="nav-item dropdown <?php if ($curr_page === 'belarus' || $curr_page === 'belarus_pref') {echo ' active';} ?>">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Экскурсии по Беларуси
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item<?php if ($curr_page === 'belarus') {echo ' active';} ?>" href="belarus.php">Для организованных групп</a>
						<a class="dropdown-item<?php if ($curr_page === 'belarus_pref') {echo ' active';} ?>" href="belarus_pref.php">Сборные туры</a>
					</div>
				</li>
				<li class="nav-item dropdown <?php if ($curr_page === 'foreigners' || $curr_page === 'foreigners_pref') {echo ' active';} ?>">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Туры в Беларусь
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item<?php if ($curr_page === 'foreigners') {echo ' active';} ?>" href="foreigners.php">Для организованных групп</a>
						<a class="dropdown-item<?php if ($curr_page === 'foreigners_pref') {echo ' active';} ?>" href="foreigners_pref.php">Сборные туры</a>
					</div>
				</li>
				<li class="nav-item<?php if ($curr_page === 'contacts') {echo ' active';} ?>">
					<a class="nav-link" href="contacts.php">Контакты</a>
				</li>
				<li class="nav-item<?php if ($curr_page === 'comments') {echo ' active';} ?>">
					<a class="nav-link" href="comments.php">Отзывы</a>
				</li>
				<li class="nav-item<?php if ($curr_page === 'settings') {echo ' active';} ?>">
					<a class="nav-link" href="settings.php">Настройки</a>
				</li>
				<li>
					<form action="includes/user.php?action=logout" method="post">
						<button type="submit" class="btn btn-primary" name="button">Выйти</button>
					</form>
				</li>
			</ul>
		</div>
	</div>
</nav>
