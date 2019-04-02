<?php

// CARD 0
$programNumber = '00';
$cardName = 'Для лыжников';
$cardSubName = 'Для лыжников';
$sliderId = 'slider01';
$slideImgDir = 'img/relax/ski';
$slideImg = scandir($slideImgDir);
$cardContent = '
<span style="display:inline-block;">
<span class="modal-title" style="line-height:1;margin:5px 0; display:inline-block">Для лыжников, которые хотят воспользоваться "утренней" акцией ГК «БУКОВЕЛЬ»:</span><br>
7-00 завтрак;<br>
7-20 выезд из отеля;<br>
16-30 выезд из Буковеля;<br>
18-00 поздний обед.<br>
</span>

<span style="display:inline-block;">
<span class="modal-title" style="line-height:1;margin:5px 0; display:inline-block">Для лыжников, которые хотят воспользоваться акцией "пол дня" ГК «БУКОВЕЛЬ»:</span><br>
7-30 завтрак;<br>
8-00 выезд из отеля;<br>
16-00 выезд из Буковеля;<br>
18-00 поздний обед.<br>
</span>

<span style="display:inline-block;">
<span class="modal-title" style="line-height:1;margin:5px 0; display:inline-block">Для «ленивых» лыжников:</span><br>
8-00 завтрак;<br>
9-15 выезд из отеля;<br>
16-00 выезд из Буковеля;<br>
18-00 поздний обед.<br>
</span>

<span style="display:inline-block;">
<span class="modal-title" style="line-height:1;margin:5px 0; display:inline-block">Для экскурсий и походов:</span><br>
8-45 завтрак;<br>
9-15 начало экскурсий и походов;<br>
18-00 возвращение в отель;<br>
19-00 поздний обед<br>
</span>
';
include 'relax_card2.php';
 ?>
