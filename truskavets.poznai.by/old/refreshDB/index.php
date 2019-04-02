<?php

// if(isset($_POST['send'])){
// 	if($_POST['send'] == 'hotelRooms'){
// 		if(isset($_POST['postdates']) && isset($_POST['postrooms'])){
// 			$dates = $_POST['postdates'];
// 			$rooms = $_POST['postrooms'];
// 			// $fp = fopen('JSON/rooms.json', 'w');
// 			// fwrite($fp, $data);
// 			// fclose($fp);
//
// 			$fp = fopen('JSON/rooms.txt', 'w');
// 			fwrite($fp, $dates.'\n'.$rooms);
// 			fclose($fp);
// 			echo "Данные записаны на сервер";
// 		} else {
// 			echo 'Запрос получен без данных!';
// 		}
// 	}
// } else {
// 	echo 'Запроса нет';
// }

if(isset($_GET['postdates']) && isset($_GET['postrooms'])) {
				$dates = $_GET['postdates'];
				$rooms = $_GET['postrooms'];
				// $fp = fopen('JSON/rooms.json', 'w');
				// fwrite($fp, $data);
				// fclose($fp);



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

				$jsonResult = json_encode($result);

				$fp = fopen('JSON/dates.json', 'w');
				fwrite($fp, $jsonResult);
				fclose($fp);

				$fp = fopen('rooms.txt', 'w');
				fwrite($fp, $rooms);
				fclose($fp);
				$fp = fopen('dates.txt', 'w');
				fwrite($fp, $dates);
				fclose($fp);



				echo print_r($exDates);


} else {
	echo "ОШИБКА ПРИ ОБРАБОТКЕ ЗАПРОСА";
}
 ?>
