<?php
function cleare_path_str($pathStr){
	$pathStr = str_replace(' ','',$pathStr);
	$ex_path = explode('/',$pathStr);
	$filter_arr = array_filter($ex_path);
	$res_path = implode('/',$filter_arr).'/';
	return $res_path;
}

function date_sort($a, $b){
	return strtotime($a) - strtotime($b);
}
function create_dates($date){
	$items = array();
	$date = str_replace(' ','',$date);
	$_ex_date = explode(',',$date);
	$ex_date = array_filter($_ex_date);
	for($i = 0; $i < count($ex_date); $i++){
		$_curr_ex_date = explode('-',$ex_date[$i]);
		$curr_ex_date = array_filter($_curr_ex_date);
		for($j = 0; $j < count($curr_ex_date); $j++){
			$final_date = date('d.m.Y',strtotime($curr_ex_date[$j]));
			array_push($items,$final_date);
		}
	}
	usort($items, "date_sort");
	return $items;
}

function check_in_range($start_date, $end_date, $date_from_user){
	$start_ts = strtotime($start_date);
	$end_ts = strtotime($end_date);
	$user_ts = strtotime($date_from_user);
	return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

function get_all_weeks($start_date,$stop_date,$price){
	$weeks = array();
	$startTime = new DateTime($start_date);
	$endTime = new DateTime($stop_date);
	$interval = new DateInterval('P9D');
	$period = new DatePeriod($startTime, $interval, $endTime);
	foreach($period as $day){
		$curr_day = $day->format('d.m.Y');
		$object_price = get_object_date($curr_day,$price);
		array_push($weeks,array($curr_day,$object_price));
	}
	return $weeks;
}

function get_object_date($date,$price){
	for($i = 0; $i < count($price); $i++){
		$get_date = &$price[$i]->date;
		for($j = 0; $j < count($get_date); $j++){
			if((strtotime($get_date[$j]) < strtotime($date)) && (strtotime($get_date[$j+1]) >= strtotime($date))){
				$price_return = &$price[$i];
				return $price_return;
			}
			$j++;
		}
	}
}
 ?>
