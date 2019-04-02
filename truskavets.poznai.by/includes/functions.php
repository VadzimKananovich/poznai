<?php
function cleare_path_str($pathStr){
	$pathStr = str_replace(' ','',$pathStr);
	$ex_path = explode('/',$pathStr);
	$filter_arr = array_filter($ex_path);
	$res_path = implode('/',$filter_arr).'/';
	return $res_path;
}


class Price extends Eseful {

	private $dates,$url,$today;
	public $title, $sub_title, $dolar,$weeks,$price,$format;

	function __construct($url) {
		$this->format = 'd-m-Y';
		$this->today = strtotime(date('d-m-Y'));
		$this->url = $url;
		$this->dates = json_decode(file_get_contents($url.'JSON/price.json'));
		$this->get_dates();
		$this->create_weeks();
	}

	private function get_dates(){
		$this->title = strip_tags($this->dates->section_title);
		$this->sub_title = strip_tags($this->dates->section_sub_title);
		$this->dolar = (int)(strip_tags($this->dates->dolar));
	}

	private function create_weeks(){
		$price = &$this->dates->price;
		$this->weeks = array();
		for($i = 0; $i < count($price); $i++){
			$price[$i]->offer = strip_tags($price[$i]->offer);
			$this_date = strip_tags($price[$i]->date);
			$this_date = str_replace(' ','',$this_date);
			$first_day_week = $this->create_first_day_week($this_date);
			$price[$i]->date = $first_day_week;
			$this->weeks = array_merge($this->weeks,$first_day_week);
			$this->create_price($price[$i]);
		}
		$test_week = array();
		foreach($this->weeks as $day){
			array_push($test_week, date('d-m-Y',$day));
		}
		sort($this->weeks);
		$this->price = $price;
	}

	private function create_first_day_week($date){
		$date = explode('-',$date);
		$format = $this->format;
		$start = strtotime('-2 day',strtotime($date[0]));
		if($start < $this->today){
			return array();
		}
		$end = strtotime('-1 day',strtotime($date[1]));

		$result = array($start);
		$test_res = array(date('d-m-Y',$start));
		while(strtotime('+7 days',$start) < $end){
			$start = strtotime('+7 days',$start);
			array_push($result,$start);

			$test_start = date('d-m-Y',$start);
			array_push($test_res,$test_start);
		}
		return $result;
	}

	private function create_price($prices){
		foreach($prices as $key => &$value){
			if($key !== 'date' && $key !== 'offer'){
				$value = (int)$this->clear_str($value);
				$value = $value / $this->dolar;
				$value = $value * 10;
				$value = round($value);
				$value = round($value / 10);
			}
		}
	}

	public function find_room($data){
		$price = &$this->price;
		for($i = 0; $i < count($price); $i++){
			for($j = 0; $j < count($price[$i]->date); $j++){
				if($price[$i]->date[$j] === $data){
					return $price[$i];
				}
			}
		}
	}

	public function calc_week($start,$days){
		$increment = '+'.($days-1).' days';
		$end = strtotime($increment,$start);
		return array(
			date($this->format,$start),
			date($this->format,$end)
		);
	}

}

 ?>
