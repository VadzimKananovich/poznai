

<?php


if(isset($_GET['request'])){


if($_GET['request'] == 'connect'){
	echo 'truskavec connect';
}



	if($_GET['request'] == 'pricerooms'){
		include 'mysqlConnect.php';
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
		$roomsPriceJSON = json_encode($roomsPrice);
		echo $roomsPriceJSON;
	}
	// if($_GET['request'] == 'inforooms'){
	// 	// $json_info = file_get_contents('../JSON/roomsInfo.json');
	// 	$roomsPriceJSON = json_encode($roomsPrice);
	// 	echo $roomsPriceJSON;
	// }
}


?>
