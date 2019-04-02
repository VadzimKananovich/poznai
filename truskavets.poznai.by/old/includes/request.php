<?php
if(isset($_GET['request'])){
	if($_GET['request'] == 'pricerooms'){
		include '__main.php';
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



	if($_GET['request'] == 'refreshprice8'){
		include '__main.php';
		$result = array();
		$text = urldecode($_GET['dates']);
		$file = fopen('res.txt','w');
		fwrite($file,$text);
		fclose($file);
		$exText = explode('@',$text);
		for($i = 0; $i < count($exText); $i++){
			$newArray = array();
			$price = explode('|',$exText[$i]);
			for($j = 0; $j < count($price); $j++){
				array_push($newArray,$price[$j]);
			}
			array_push($result,$newArray);
		}
		echo 'Данные обновлены';
		mysqli_query($conn, "TRUNCATE TABLE `truskavec_roomsPrice`");
		for($i = 0; $i < count($result); $i++){
			$exdate = explode('-',$result[$i][0]);
			$firstDay = $exdate[0];
			$exdata = explode('/',$firstDay);
			$newDate = array();
			$newDate[0] = $exdata[2];
			$newDate[1] = $exdata[1];
			$newDate[2] = $exdata[0];
			$resData = implode('-',$newDate);
			$finalDate = str_replace(' ', '', $resData);
			$testDate = new DateTime($finalDate);
			$testDate->modify('-1 day');
			$strDate = $testDate->format('d/m/Y');
			$secondDate = str_replace(' ', '', $exdate[1]);
			$finalResultDay = $strDate.' - '.$secondDate;
			$roomsDate8 = $result[$i][0];
			$roomsDate10 = $finalResultDay;
			$room_4_1 = $result[$i][1];
			$room_2_block = $result[$i][2];
			$room_3 = $result[$i][3];
			$room_4_2 = $result[$i][4];
			$room_2_econom = $result[$i][5];
			$room_2_standart = $result[$i][6];
			$status = $result[$i][7];
			$query = "INSERT INTO `truskavec_roomsPrice`
			(`roomsDate8`, `roomsDate10`, `room_4_1`,`room_2_block`,`room_3`,`room_4_2`,`room_2_econom`,`room_2_standart`,`status`)
			VALUES ('$roomsDate8','$roomsDate10','$room_4_1','$room_2_block','$room_3','$room_4_2','$room_2_econom','$room_2_standart','$status')";
			mysqli_query($conn, $query);
		}
	}



	if($_GET['request'] == 'setroomstruskavec'){

		if(isset($_GET['postdates']) && isset($_GET['postrooms'])) {
			$dates = urldecode($_GET['postdates']);
			$rooms = urldecode($_GET['postrooms']);

			$result = array();
			$exDates = explode(',', $dates);
			$count = 0;

			for($i = 0; $i < count($exDates); $i++) {
				$result[$count] = new stdClass();
				$result[$count]->date = $exDates[$i];
				$count = $count+1;
			}
			$exRowRooms = explode("/",$rooms);

			for($i = 0; $i < count($exRowRooms); $i++){
				$exRoom = explode(",", $exRowRooms[$i]);
				for($j =0; $j < count($exRoom); $j++){
					if($j == 0){
						$roomType = 'all';
					}
					if($j == 1){
						$roomType = '2_room';
					}
					if($j == 2){
						$roomType = '3_room';
					}
					if($j == 3){
						$roomType = '3_room_econom';
					}
					$result[$i]->$roomType = $exRoom[$j];
				}
			}

			$fp = fopen('rooms.txt', 'w');
			fwrite($fp, $rooms);
			fclose($fp);
			$fp = fopen('dates.txt', 'w');
			fwrite($fp, $dates);
			fclose($fp);

			echo "Данные обновлены";
		} else {
			echo "ОШИБКА ПРИ ОБРАБОТКЕ ЗАПРОСА";
		}

	}


	// if($_GET['request'] == 'inforooms'){
	// 	// $json_info = file_get_contents('../JSON/roomsInfo.json');
	// 	$roomsPriceJSON = json_encode($roomsPrice);
	// 	echo $roomsPriceJSON;
	// }
}


?>
