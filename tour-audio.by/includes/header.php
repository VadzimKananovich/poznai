<header>
	<div class="top_nav">
		<div class="contact-collapse">
			<i class="fas fa-file-contract"></i>
			<span>Контакты</span>
		</div>
		<ul class="top_nav-contact">
			<?php
			if($_phone && count($_phone) > 0){
				echo '<li>';
				echo '<div class="ico-nav-wrap">';
				echo '<i class="'.$_phone[0]->ico.'"></i>';
				if($_phone[0]->messenger && count($_phone[0]->messenger) > 0){
					$mess = &$_phone[0]->messenger;
					for($i = 0; $i < count($mess); $i++){
						echo '<a class="ico-link" href="'.$mess[$i]['link'].'" title="'.$mess[$i]['name'].'">';
						echo '<i class="'.$mess[$i]['ico'].' ico-24"></i>';
						echo '</a>';
					}
				}
				echo '</div>';
				echo '<a href="tel:'.$_phone[0]->tel_link.'" class="top_nav_link" title="'.$_phone[0]->ico.'">'.$_phone[0]->tel.'</a>';
				echo '</li>';
			}

			if($_email && count($_email) > 0){
				$email_link = "mailto:".$_email[0];
				echo '<li>';
				echo '<a class="top_mail top_nav_link" href="'.$email_link.'" title="'.$_email[0].'">';
				echo '<i class="email-ico '.$_icon['email'].' ico-24"></i>';
				echo $_email[0];
				echo '</a>';
				echo '</li>';
			}
			?>
		</ul>
		<ul class="top_nav-social">
			<?php

			if($_social && count($_social) > 0){
				for($i = 0; $i < count($_social); $i++){
					echo '<li>';
					echo '<a class="top_nav_link" href="'.$_social[$i]->link.'" title="'.$_social[$i]->name.'">';
					echo '<i class="nav_ico ico-24 '.$_social[$i]->ico.'"></i>';
					echo '</a>';
					echo '</li>';
				}
			}

			?>
			<!-- <li><a class="top_nav_link" href=""><span class="nav_ico fab ico-24 fa-instagram instagram-ico"></span></a></li> -->
			<!-- <li><a class="top_nav_link" href=""><span class="nav_ico fab ico-24 fa-facebook-f fb-ico"></span></a></li> -->
			<!-- <li><a class="top_nav_link" href=""><span class="nav_ico fab ico-24 fa-odnoklassniki ok-ico"></span></a></li> -->
			<!-- <li><a class="top_nav_link" href=""><span class="nav_ico fab ico-24 fa-youtube youtube-ico"></span></a></li> -->
		</ul>
	</div>
	<nav class="navbar bootsnav" id="topMenu">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
					<i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand" href=""><img class="logo" src="images/logo.png" alt=""></a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-menu">
				<ul class="nav navbar-nav menu">
					<!-- <li><a href="#">Г</a></li> -->
					<li><a href="#about" data-menu="#about">О радиогиде</a></li>
					<li><a href="#why_us" data-menu="#why_us">Почему мы</a></li>
					<li><a href="#withUs" data-menu="#withUs">Преимущества</a></li>
					<li><a href="#testimonial" data-menu="#testimonial">Отзывы</a></li>
					<li><a href="#contact_form" data-menu="#contact_form">Контакты</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>
