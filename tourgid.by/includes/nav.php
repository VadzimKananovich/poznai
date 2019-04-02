<nav id="navBar" class="head-nav">
	<div class="nav-logo">
		<img src="<?= $src_url.$about['info']->logo['img'] ?>" alt="<?= $about['info']->logo['title'] ?>">
	</div>
	<div class="drop-down-btn">
		<i class="fas fa-bars"></i>
	</div>
	<ul class="nav-menu" id="topMenu">
		<li class="nav-menu-item">
			<a href="#" class="nav-land nav-menu-link" data-menu="header">Главная</a>
		</li>
		<li class="nav-menu-item">
			<a href="#aboutProduct" class="nav-land nav-menu-link" data-menu="aboutProduct">Оборудование</a>
		</li>
		<li class="nav-menu-item">
			<a href="#contactSection" class="nav-land nav-menu-link" data-menu="contactSection">Контакты</a>
		</li>
		<li class="close-btn">
			<i class="fas fa-times"></i>
		</li>
	</ul>
</nav>
