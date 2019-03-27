<?php
	$curr_file = basename($_SERVER['PHP_SELF']);
	$ex_curr = explode('.',$curr_file);
	$curr = $ex_curr[0];
	?>

	<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand text-white display-4" href="https://poznai.by/" target="_blanck">
			POZNAI.BY
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item<?php if (strpos($curr, 'index') !== false) {echo ' active';} ?>">
					<a href="<?php echo $url; ?>panel/index.php" class="nav-link">
						<i class="fas fa-building"></i>
						О компании
					</a>
				</li>
				<li class="nav-item dropdown <?php if ($curr === 'user_set') {echo ' active';} ?>">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user-tie"></i>
						<?php echo $_user; ?>
					</a>
					<div class="dropdown-menu user-menu">
						<a class="dropdown-item<?php if ($curr === 'user_set') {echo ' active';} ?>" href="<?php echo $url; ?>panel/user_set.php">
							<i class="fas fa-cog"></i>
							Настройки
						</a>
						<a class="dropdown-item logout-btn" href="<?php echo $url; ?>panel/includes/user.php?action=logout&user=<?php echo $_user; ?>">
							<i class="fas fa-sign-out-alt"></i>
							Выйти
						</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
	<?php

?>
