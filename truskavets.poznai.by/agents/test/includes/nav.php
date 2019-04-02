<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
	<!-- <a class=" text-white display-4" href="https://poznai.by/" target="_blanck"> -->
	<img class="navbar-brand nav-logo" src="<?php echo $url.$_logo; ?>" alt="<?php echo $_logo_title; ?>">
	<!-- </a> -->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto" id="topMenu">
			<?php
			if($_phone && count($_phone) > 0 ||	$_email && count($_email) > 0){
				echo '<li class="nav-item dropdown">';
				echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
				echo '<i class="fas fa-mobile-alt"></i>';
				echo 'Контакты';
				echo '</a>';
				echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
				if($_phone && count($_phone) > 0){
					echo '<div class="dropdown-item">';
					echo '<a class="ico-link" href="tel:'.$_phone[0]->tel_link.'" title="'.$_phone[0]->name.'">';
					echo '<i class="nav-contact_ico '.$_phone[0]->ico.' ico-24"></i>';
					echo '</a>';
					if($_phone[0]->messenger && count($_phone[0]->messenger) > 0){
						$mess = &$_phone[0]->messenger;
						for($i = 0; $i < count($mess); $i++){
							echo '<a class="ico-link" href="'.$mess[$i]['link'].'" title="'.$mess[$i]['name'].'">';
							echo '<i class="nav-contact_ico '.$mess[$i]['ico'].' ico-24"></i>';
							echo '</a>';
						}
					}
					echo '<a class="nav-phone_name" href="tel:'.$_phone[0]->tel_link.'" title="'.$_phone[0]->name.'">';
					echo $_phone[0]->tel;
					echo '</a>';
					echo '</div>';
				}
				if($_email && count($_email) > 0){
					echo '<div class="dropdown-divider"></div>';
					echo '<div class="dropdown-item">';
					$email_link = "mailto:".$_email[0];
					echo '<a class="nav-email" href="'.$email_link.'"><i class="nav-contact_ico '.$_icon['email'].' ico-24"></i>'.$_email[0].'</a>';
					echo '</div>';
				}
				echo '</div>';
				echo '</li>';
			}
			?>
			<li class="nav-item nav-land" data-menu="relax">
				<a href="#relax" class="nav-link">
					<i class="fas fa-mountain  mbr-iconfont mbr-iconfont-btn nav-icon"></i>
					Где отдохнуть
				</a>
			</li>
			<li class="nav-item nav-land" data-menu="tourInclude">
				<a href="#tourInclude" class="nav-link">
					<i class="fas fa-book-reader mbr-iconfont mbr-iconfont-btn nav-icon"></i>
					В тур входит
				</a>
			</li>
			<li class="nav-item nav-land" data-menu="hotelSection">
				<a href="#hotelSection" class="nav-link">
					<i class="fas fa-hotel mbr-iconfont mbr-iconfont-btn nav-icon"></i>
					Гостиница
				</a>
			</li>
			<li class="nav-item nav-land" data-menu="priceSection">
				<a href="#programTour" class="nav-link">
					<i class="fas fa-dollar-sign"></i>
					Стоимость
				</a>
			</li>
			<li class="nav-item nav-land" data-menu="programSection">
				<a href="#programSection" class="nav-link">
					<i class="fas fa-clipboard-list mbr-iconfont mbr-iconfont-btn nav-icon"></i>
					Программа тура
				</a>
			</li>

		</ul>
	</div>
</nav>
