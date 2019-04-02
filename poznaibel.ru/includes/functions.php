<?php

function get_tours_info($type){
	if($type == 'belarus'){
		$file = json_decode(file_get_contents('../jsdb/JSON/tours/belarus.json'));
	}
	if($type == 'belarus_pref'){
		$file = json_decode(file_get_contents('../jsdb/JSON/tours/belarus_pref.json'));
	}
	if($type == 'foreigners'){
		$file = json_decode(file_get_contents('../jsdb/JSON/tours/foreigners.json'));
	}
	if($type == 'foreigners_pref'){
		$file = json_decode(file_get_contents('../jsdb/JSON/tours/foreigners_pref.json'));
	}
	foreach($file[0] as $key => $value){
		$item = $file[0]->$key;
		for($i = 1; $i < count($item); $i++){
			$scan_img = scandir('../'.$item[$i]->img);
			array_splice($scan_img,0,2);
			if($scan_img){
				$res_img = array();
				for($j = 0; $j < count($scan_img); $j++){
					$row = $item[$i]->img.'/'.$scan_img[$j];
					array_push($res_img,$row);
				}
				$item[$i]->img = $res_img;
			} else {
				$item[$i]->img = 0;
			}
		}
		$file[0]->$key = $item;
	}
	return json_encode($file[0]);
}



 ?>
