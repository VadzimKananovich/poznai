<header id="header" class="menu-section" data-menuIco="fas fa-home" data-menuName="Главная" data-file="header">
	<div class="video-head-container">
		<video autoplay muted loop id="myVideo">
			<source src="source/header-xs.mp4" type="video/mp4" />
		</video>
	</div>
	<div class="overflow"></div>
	<div class="head-content-wrap content">
		<div class="head-content_info">
			<h1 class="show-from-bottom"><span>Радиогид</span></h1>
			<h2 class="show-from-top"><span>лучшее оборудование для экскурсий</span></h2>
			<ul>
				<li class="show-from-left" data-timer="1"><span>Качество звука и постоянная слышимость гида-экскурсовода без посторонних шумов и помех.</span></li>
				<li class="show-from-left" data-timer="2"><span>Возможность использования при любой погоде круглый год.</span></li>
				<li class="show-from-left" data-timer="3"><span>Проведение множества экскурсий одновременно, как для иностранных, так и для русскоязычных гостей, благодаря наличию 40 отдельных каналов связи.</span></li>
				<li class="show-from-left" data-timer="4"><span>Компактность оборудования и предельная простота его использования.</span></li>
				<li class="show-from-left" data-timer="5"><span>Радиус устойчивого приема сигнала превышает 100м вне зависимости от стен и перегородок</span></li>
			</ul>
		</div>
		<div class="head-content_form show-from-right">
				<span>
				<form class="header-form" action="<?php echo $url; ?>?action=send" method="post">
					<div class="header-form-row row-input">
						<input type="text" name="header_name" placeholder="Имя" required>
					</div>
					<div class="header-form-row row-input">
						<input type="text" name="header_num" placeholder="Номер" required>
					</div>
					<div class="header-form-row row-button">
						<button type="submit" name="button" class="btn">Обратный звонок</button>
					</div>
					<p class="head-form-desc">
						Оставьте ваш номер для консультации
					</p>
				</form>
			</span>
		</div>
	</div>

</header>
