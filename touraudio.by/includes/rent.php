<section id="rentBuy" class="menu-section" data-menuIco="fas fa-retweet" data-menuName="Приобрести" data-file="rent">
	<div class="overflow">

	</div>
	<h2 class="section-title show-from-bottom"><span>Приобрести оборудование</span></h2>
	<h3 class="section-sub-title show-from-top"><span>Предлагаем оборудование в аренду или для покупки</span></h3>
	<div class="rent-buy-wrapper">
		<div class="rent-wrap">
			<h4 class="rent-buy-title"><span><i class="fas fa-retweet"></i></span><span class="show-from-bottom"><span>Арендовать</span></span></h4>
			<div class="rent-wrap-content">
				<h5 class="rent-buy-sub-title">Для кого:</h5>
				<ul class="rent-content">
					<li>Круизные компании</li>
					<li>Средние и крупные музеи</li>
					<li>Средние и крупные туристические бюро</li>
					<li>Средние и крупные экскурсионные бюро</li>
				</ul>
				<h5 class="rent-buy-sub-title">Услуги:</h5>
				<ul class="rent-buy-services">
					<li> <span> <i class="fas fa-truck"></i> </span><span>Доставка оборудования на объект</span> </li>
					<li> <span> <i class="fas fa-chalkboard-teacher"></i> </span><span>Обучение персонала эксплуатации оборудования</span> </li>
					<li> <span> <i class="fas fa-battery-three-quarters"></i> </span><span>Зарядка устройств специалистами Радио Гид</span> </li>
					<li> <span> <i class="fas fa-broom"></i> </span><span>Очистка устройств и всех аксессуаров</span> </li>
					<li> <span> <i class="fas fa-user"></i> </span><span>100% техническое сопровождение мероприятий (конференции, форумы, семинары, саммиты)</span> </li>
				</ul>
				<span class="show-from-left"><span><a href="#modalContact" data-type="left" data-modal="rent" rel="modal:open" class="btn openModal">Оставить заявку</a></span></span>
			</div>
		</div>

		<div class="buy-wrap">
			<h4 class="rent-buy-title"><span><i class="fas fa-shopping-cart"></i></span><span class="show-from-bottom"><span>Купить</span></span></h4>
			<div class="buy-wrap-content">
				<h5 class="rent-buy-sub-title">Для кого</h5>
				<ul class="rent-content">
					<li>Круизные компании</li>
					<li>Частные экскурсоводы (10-15 чел. в группе)</li>
					<li>Небольшие и средние музеи</li>
					<li>Гостиницы</li>
					<li>Автобусные туры</li>
					<li>Небольшие туристические бюро</li>
				</ul>
				<h5 class="rent-buy-sub-title">Услуги:</h5>
				<ul class="rent-buy-services">
					<li> <span> <i class="fas fa-headset"></i> </span> <span>Круглосуточная служба поддержки</span> </li>
					<li> <span> <i class="fas fa-medal"></i> </span> <span>Гарантия на оборудование 1 год</span> </li>
					<li> <span> <i class="fas fa-toolbox"></i> </span> <span>Модернизация и ремонт по истечении срока гарантии</span> </li>
					<li> <span> <i class="fas fa-hands-helping"></i> </span> <span>Гибкость предлагаемых решений</span> </li>
				</ul>
				<span class="show-from-right"><span><a href="#modalContact" data-type="right" data-modal="buy" rel="modal:open" class="btn openModal">Оставить заявку</a></span></span>
			</div>
		</div>
	</div>
	<div id="modalContact" class="modal">
		<div class="modal-content-wrap">
			<h6 class="modal-title"></h6>
			<form action="<?php echo $url; ?>?action=send&modal=" method="post">
				<input type="text" id="name" name="name" placeholder="Имя" required>
				<input type="text" id="number" name="number" placeholder="Телефон" required>
				<div class="btn-wrap">
					<button type="submit" name="button" class="btn">Отправить</button>
				</div>
			</form>
		</div>
	</div>
</section>
