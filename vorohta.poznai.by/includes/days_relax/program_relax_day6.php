

<?php
$dayNumber = '7';
?>
<?php
include 'parts/relax_card_title.php';
?>
<div class="relax-row">


	<?php

	include 'parts/program_relax_card_repeat.php';

	// CARD 1
	$programNumber = '1';
	$cardName = 'ЭКСКУРС-1';
	$cardSubName = 'ПРОГРАММА ТУРА: ЭКСКУРС-1';
	$slideImgDir = 'img/relax/'.$dayNumber.'/'.$programNumber;
	$slideImg = scandir($slideImgDir);
	$cardContent = '
	Коломыя – симпатичный город-страж гуцульского колорита, колыбель Западно-Украинской истории, с подлинной архитектурой, сохранившейся со времен правления Австро – Венгерской империи. Побродив по тесным улочкам исторической части города, почувствуете себя в другом столетии. Обед в уютном ресторане "Хвалена хата" в историческом центре города. Посетим уникальный музей «Пысанка», музей народного искусства «Гуцульщина».
	';
	include 'parts/relax_card2.php';

	// CARD 2
	$programNumber = '2';
	$cardName = 'ЭКСКУРС-2';
	$cardSubName = 'ПРОГРАММА ТУРА: ЭКСКУРС-2';
	$slideImgDir = 'img/relax/'.$dayNumber.'/'.$programNumber;
	$slideImg = scandir($slideImgDir);

	$cardContent = '
	Черновцы — один из немногих городов Украины, который справедливо считается жемчужиной архитектуры. Обзорная экскурсия по городу. Прогулка по старому городу — целостному, почти нетронутому ансамблю XIX — начала XX веков. Посещение Национального университета - архитектурного шедевра бывшей Резиденции православных митрополитов Буковины и Далмации. В 2012 году г.Черновцы был признан самым комфортным городом Украины.
	';
	include 'parts/relax_card2.php';

	// CARD 3
	$programNumber = '3';
	$cardName = 'АКТИВ+СУПЕР-АКТИВ';
	$cardSubName = 'ПРОГРАММА ТУРА: АКТИВ+СУПЕР-АКТИВ';
	$slideImgDir = 'img/relax/'.$dayNumber.'/'.$programNumber;
	$slideImg = scandir($slideImgDir);
	$cardContent = '
	Восхождение на Говерлу по традиционному маршруту (вторник, пятница) - уже ради одного этого события стоит ежегодно приезжать в наш тур. Возможность взирать на мир с вершины Говерлы (2061м, подъем 1150м, 10км) не дает покоя не только людям подготовленным, но и энтузиастам всех возрастов. Сюда совершают восхождение почти круглый год и школьники, и студенты, и туристы, и президенты. После активно проведенного дня – отдых и праздничный пикник на лоне природы.
	';
	include 'parts/relax_card2.php';

	// CARD 4
	$programNumber = '4';
	$cardName = 'АКТИВ-2';
	$cardSubName = 'ПРОГРАММА ТУРА: АКТИВ-2';
	$slideImgDir = 'img/relax/'.$dayNumber.'/'.$programNumber;
	$slideImg = scandir($slideImgDir);
	$cardContent = '
	Легкий поход вдоль реки Прут будет прекрасным завершением программы для умеренно активных туристов. Песни птиц, шум воды в порогах, замечательный лес с высокими соснами, с черникой и грибами, красивая горная река, проложившая себе путь среди гор по живописным местам дикой природы, оголив взглядам интересный «слоеный пирог» из скальных пород - все это лучшее место для единения с природой! Обед – уха на природе
	';
	include 'parts/relax_card2.php';


	// CARD 5
	$programNumber = '5';
	$cardName = 'СУПЕР-АКТИВ-2';
	$cardSubName = 'ПРОГРАММА ТУРА: СУПЕР-АКТИВ-2';
	$slideImgDir = 'img/relax/'.$dayNumber.'/'.$programNumber;
	$slideImg = scandir($slideImgDir);
	$cardContent = '
	Путешествие в сердце Карпатских гор к водопаду у подножья Говерлы. Многие считают, что это самое красивое и необычное место, которое они видели в своей жизни. Более активным туристам советуем подняться выше и полюбоваться «субальпийской долиной», увидеть, как из небольшого истока зарождается могучая река Прут. «Чемпионы» могут продолжить поход на озеро Несамовитое – совершенная жемчужина в ожерелье Карпат, в хорошую погоду - синий яркий цветок на зеленом ковре (1750м, подъем 600м, 16км). После активно проведенного дня – отдых и праздничный пикник на лоне природы.
	';
	include 'parts/relax_card2.php';

	?>
</div>
