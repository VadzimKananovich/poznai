<?php
$url = 'http://192.168.1.2:888/truskavec.poznai.by/';
// $url = 'http://truskavec.poznai.by/';


if (isset($_GET['action'])) {
	if($_GET['action'] === 'modal_send'){
		// SEND EMAIL CODE
		mail('sales@poznai.by',
		'Письмо с truskavec.poznai.by',
		'Вам написал: '.$_POST['name'].
		'<br />Его номер: '.$_POST['phone'].
		'<br />С сайта: <a href="http://truskavec.poznai.by" target="_blank" title="трускавец">http://truskavec.poznai.by</a>',
		"Content-type:text/html;charset=utf-8");

		header("Location: $url#win2");
	}
	if($_GET['action'] === 'email_send'){
		// SEND EMAIL CODE
		mail('sales@poznai.by',
		'Письмо с truskavec.poznai.by',
		'Вам написал: '.$_POST['first_last_name'].
		'<br />Его телефон: '.$_POST['my_phone'].
		'<br />С сайта: <a href="http://truskavec.poznai.by" target="_blank" title="трускавец">http://truskavec.poznai.by</a>'.
		'<br />Сообщение: <br />'.$_POST['message'],
		"Content-type:text/html;charset=utf-8");

		header("Location: $url#win2");
	}
}


// MYSQL CONNECTION / CREATE ARRAY COUNTRIES=========================================

include 'includes/mysqlConnect.php';
$query = 'SELECT rooms, roomsRus, roomsPhoto FROM truskavec_roomsInfo';

// mysqli_set_charset($conn,'utf8');
// $result = mysqli_query($conn,$query);
//
// $roomsInfo = array();
// while ($obj = mysqli_fetch_object($result)){
// 	array_push($roomsInfo,$obj);
// }
//
// for($i = 0; $i < count($roomsInfo); $i++){
// 	$photo = explode(',',$roomsInfo[$i]->roomsPhoto);
// 	$roomsInfo[$i]->roomsPhoto = $photo;
// }

mysqli_set_charset($conn,'utf8');
$result = mysqli_query($conn,$query);

$roomsInfo = array();
while ($obj = mysqli_fetch_object($result)){
	array_push($roomsInfo,$obj);
}

$query = 'SELECT roomsDate8, roomsDate10, room_4_1, room_2_block, room_3, room_4_2, room_2_econom, room_2_standart, status FROM truskavec_roomsPrice';

mysqli_set_charset($conn,'utf8');
$result = mysqli_query($conn,$query);

$roomsPrice = array();
while ($obj = mysqli_fetch_object($result)){
	array_push($roomsPrice,$obj);
}

function roundPrice($intPrice){
	$intPrice = $intPrice / 10;
	$intPrice = ceil($intPrice);
	$intPrice = $intPrice * 10;
	$intPrice = intval($intPrice);
	return $intPrice;
}

for($i = 0; $i< count($roomsPrice); $i++){
	$roomsPrice[$i]->room_4_1 = roundPrice($roomsPrice[$i]->room_4_1);
	$roomsPrice[$i]->room_2_block = roundPrice($roomsPrice[$i]->room_2_block);
	$roomsPrice[$i]->room_3 = roundPrice($roomsPrice[$i]->room_3);
	$roomsPrice[$i]->room_4_2 = roundPrice($roomsPrice[$i]->room_4_2);
	$roomsPrice[$i]->room_2_econom = roundPrice($roomsPrice[$i]->room_2_econom);
	$roomsPrice[$i]->room_2_standart = roundPrice($roomsPrice[$i]->room_2_standart);
}


?>

<!DOCTYPE html>
<html lang="ru" style="">

<?php
include 'includes/__head.php';
?>
<script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>

<body data-spy="scroll" data-target=".navbar-fixed-top">

	<?php
	include 'includes/_contact_modal.php';
	include 'includes/_mess_modal.php';
	include 'includes/_email_modal.php';
	include 'includes/nav.php';
	include 'includes/home.php';

	include 'includes/excursion.php';
	include 'includes/entertainment.php';
	include 'includes/tours.php';
	include 'includes/testimonials.php';
	include 'includes/contact.php';
	include 'includes/how_we_working.php';
	include 'includes/footer.php';

	?>

	<script src="js/upButton.js"></script>
	<script>
	let upButton = new UpButton(300,'img/up.svg');
	</script>
	<script src="js/paralax_bg.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery.easing.min.js" type="text/javascript"></script>
	<script src="js/swiper.js" type="text/javascript"></script>
	<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	<script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<script src="js/validator.min.js" type="text/javascript"></script>
	<script src="js/owl.carousel.min.js" type="text/javascript"></script>
	<script src="js/scripts.js" type="text/javascript"></script>
	<script src="js/custom.js" type="text/javascript"></script>
	<script src="js/analytics.js" type="text/javascript"></script>
	<script src="js/main.js" type="text/javascript"></script>

</body>

</html>
