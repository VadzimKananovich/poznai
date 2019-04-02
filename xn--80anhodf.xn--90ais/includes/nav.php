<?php

$file = basename($_SERVER['PHP_SELF']);
$ex_file = explode('.',$file);
$curr_page = $ex_file[0];

 ?>
<header>
	<div id="topbar">
		<div class="line">
			<div class="s-12">
				<?php
				if(count($phone)>0){
					echo '<div class="contact-top-row">';
					echo '<span class="mrr-10">Телефон:</span>';
					echo '<span class="'.$phone[0]->ico.' '.$phone[0]->operator.'" title="'.$phone[0]->operator.'">&nbsp;</span>';
					for($j = 0; $j < count($phone[0]->messenger); $j++){
						echo '<span class="'.$phone[0]->messenger[$j][1].' '.$phone[0]->messenger[$j][0].' ico-24" title="'.$phone[0]->messenger[$j][0].'"></span>';
					}
					echo '<a class="mrr-10" href="tel:'.$phone[0]->tel_link.'" title="'.$phone[0]->operator.'">'.$phone[0]->tel.'</a>';
					echo '</div>';
				}
				echo '<div class="contact-top-row">';
				echo '<span class="mrr-10">Email: </span>';
				echo '<a class="mrr-10" href="mailto:'.$email[0].'" title="'.$email[0].'"><i class="fas fa-envelope ico-24"></i>'.$email[0].'</a>';
				echo '</div>';
				?>
			</div>
		</div>
	</div>
	<nav>
		<div class="line menu-container">
			<div class="s-12 l-2 logo-top-container">
        <img src="img/logo/logo.png" alt="Познай.бел" role="logo" class="logo ico-48">
			</div>
			<div class="top-nav s-12 l-10">
				<p class="nav-text"></p>
				<ul class="right">
					<li <?php if (strpos($curr_page, 'index') !== false) {echo 'class="active-item"';} ?>><a href="<?php echo $url; ?>">Главная</a></li>
					<li  <?php if (strpos($curr_page, 'belarus') !== false) {echo 'class="active-item"';} ?>><a href="<?php echo $url.'belarus'; ?>">Экскурсии по Беларуси</a></li>
					<li  <?php if (strpos($curr_page, 'foreigners') !== false) {echo 'class="active-item"';} ?>><a href="<?php echo $url.'foreigners'; ?>">Туры в Беларусь</a></li>
					<li  <?php if (strpos($curr_page, 'about') !== false) {echo 'class="active-item"';} ?>><a href="<?php echo $url.'about'; ?>">О нас</a></li>
					<li  <?php if (strpos($curr_page, 'contact') !== false) {echo 'class="active-item"';} ?>><a href="<?php echo $url.'contact'; ?>">Контакты</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>
