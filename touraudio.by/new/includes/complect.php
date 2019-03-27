
<?php
$complectImg = scandir('img/complect/gallery');

?>
<section id="complect" class="menu-section" data-menuIco="fas fa-headset" data-menuName="Комплектация" data-file="complect">

	<h2 class="section-title show-from-bottom"><span>Комплектация</span></h2>
	<div class="complect-row-container">
		<div class="complect-img">
			<img src="img/complect/map.jpg" alt="Комплектация">
		</div>
		<div class="complect-content">
			<ol>
				<li class="complect-item show-from-right" data-timer="0"> <span><b>1.</b> Приемник</span> </li>
				<li class="complect-item show-from-right" data-timer="1"> <span><b>2.</b> Передатчик</span> </li>
				<li class="complect-item show-from-right" data-timer="2"> <span><b>3.</b> Микрофонная гарнитура для передатчика</span> </li>
				<li class="complect-item show-from-right" data-timer="3"> <span><b>4.</b> Зарядное устройство для передатчика</span> </li>
				<li class="complect-item show-from-right" data-timer="4"> <span><b>5.</b> Ремешок для крепления устройства на шее</span> </li>
				<li class="complect-item show-from-right" data-timer="5"> <span><b>6.</b> Наушник</span> </li>
				<li class="complect-item show-from-right" data-timer="6"> <span><b>7.</b> Зарядное устройство и блок питания</span> </li>
				<li class="complect-item show-from-right" data-timer="7"> <span><b>8.</b> Пластиковый планшет</span> </li>
				<li class="complect-item show-from-right" data-timer="8"> <span><b>9.</b> Сумка для наушников</span> </li>
				<li class="complect-item show-from-right" data-timer="9"> <span><b>10.</b> Сумка для приемников</span> </li>
			</ol>
		</div>
	</div>
	<div class="complect-row-img slick">
		<?php
			for($i = 2; $i < count($complectImg); $i++ ){
				echo '<div class="complect-row-img-container">';
				echo '<img src="img/complect/gallery/'.$complectImg[$i].'" alt="РАДИОГИД">';
				echo '</div>';
			}
		 	?>
	</div>
</section>
