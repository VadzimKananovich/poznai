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
					<a class="nav-link" href="<?php echo $url; ?>panel/index.php">
						<i class="fas fa-home"></i>
						Главная
					</a>
				</li>
				<li class="nav-item<?php if (strpos($curr, 'hotel') !== false) {echo ' active';} ?>">
					<a href="<?php echo $url; ?>panel/hotel.php" class="nav-link">
						<i class="fas fa-hotel mbr-iconfont mbr-iconfont-btn nav-icon"></i>
						Гостиница
					</a>
				</li>
				<li class="nav-item dropdown <?php if ($curr === 'day2' || $curr === 'day3' || $curr === 'day4' || $curr === 'day5' || $curr === 'day6' || $curr === 'day7' || $curr === 'day8') {echo ' active';} ?>">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Программа тура
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item<?php if ($curr === 'day2') {echo ' active';} ?>" href="<?php echo $url; ?>panel/program/day2.php">День 2</a>
						<a class="dropdown-item<?php if ($curr === 'day3') {echo ' active';} ?>" href="<?php echo $url; ?>panel/program/day3.php">День 3</a>
						<a class="dropdown-item<?php if ($curr === 'day4') {echo ' active';} ?>" href="<?php echo $url; ?>panel/program/day4.php">День 4</a>
						<a class="dropdown-item<?php if ($curr === 'day5') {echo ' active';} ?>" href="<?php echo $url; ?>panel/program/day5.php">День 5</a>
						<a class="dropdown-item<?php if ($curr === 'day6') {echo ' active';} ?>" href="<?php echo $url; ?>panel/program/day6.php">День 6</a>
						<a class="dropdown-item<?php if ($curr === 'day7') {echo ' active';} ?>" href="<?php echo $url; ?>panel/program/day7.php">День 7</a>
						<a class="dropdown-item<?php if ($curr === 'day8') {echo ' active';} ?>" href="<?php echo $url; ?>panel/program/day8.php">День 8</a>
					</div>
				</li>
				<li class="nav-item<?php if (strpos($curr, 'price') !== false) {echo ' active';} ?>">
					<a href="<?php echo $url; ?>panel/price.php" class="nav-link">
						<i class="fas fa-dollar-sign"></i>
						Цены
					</a>
				</li>
				<!-- <li class="nav-item<?php if (strpos($curr, 'agent') !== false) {echo ' active';} ?>">
					<a href="<?php echo $url; ?>panel/agent.php" class="nav-link">
						<i class="fas fa-user"></i>
						Суб-агенты
					</a>
				</li> -->
				<li class="nav-item<?php if (strpos($curr, 'about') !== false) {echo ' active';} ?>">
					<a href="<?php echo $url; ?>panel/about.php" class="nav-link">
						<i class="fas fa-building"></i>
						О компании
					</a>
				</li>
				<li class="nav-item<?php if (strpos($curr, 'other') !== false) {echo ' active';} ?>">
					<a href="<?php echo $url; ?>panel/other.php" class="nav-link">
						<i class="fab fa-jsfiddle"></i>
						Другое
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
