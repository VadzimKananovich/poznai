
<?php

//============================================
// FUNCTIONS
//============================================
function randomName($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function removeFiles($path){
	$folder = $path;
	$files = glob($folder . '/*');
	foreach($files as $file){
		if(is_file($file)){
			unlink($file);
		}
	}
	rmdir($folder);
}

function create_path($path){
	if(!is_dir($path)){
		mkdir($path, 0777, true);
	}
}

//============================================
// GET INFO
//============================================
function get_tours_info($type){
	if($type == 'belarus'){
		$patch = '../../jsdb/JSON/tours/belarus.json';
	}
	if($type == 'belarus_pref'){
		$patch = '../../jsdb/JSON/tours/belarus_pref.json';
	}
	if($type == 'foreigners'){
		$patch = '../../jsdb/JSON/tours/foreigners.json';
	}
	if($type == 'foreigners_pref'){
		$patch = '../../jsdb/JSON/tours/foreigners_pref.json';
	}
	$object = json_decode(file_get_contents($patch));
	foreach($object[0] as $key => $value){
		for($i = 1; $i < count($value); $i++){
			$img_patch = $value[$i]->img;
			$scan = scandir('../../'.$img_patch);
			array_splice($scan,0,2);
			$res_img = array();
			for($j = 0; $j < count($scan); $j++){
				$img_res_patch = $img_patch.'/'.$scan[$j];
				array_push($res_img,$img_res_patch);
			}
			$value[$i]->img = $res_img;
		}
	}
	return json_encode($object[0]);
}

//============================================
// EDIT TOUR
//============================================
function edit_tour($type,$item,$name,$desc,$price,$currency,$route,$duration,$program,$place,$date){
	if($type == 'belarus'){
		$patch = '../../jsdb/JSON/tours/belarus.json';
	}
	if($type == 'belarus_pref'){
		$patch = '../../jsdb/JSON/tours/belarus_pref.json';
	}
	if($type == 'foreigners'){
		$patch = '../../jsdb/JSON/tours/foreigners.json';
	}
	if($type == 'foreigners_pref'){
		$patch = '../../jsdb/JSON/tours/foreigners_pref.json';
	}
	$exItem = explode('%',$item);
	$type = $exItem[0];
	$tour = (int)$exItem[1];
	$object = json_decode(file_get_contents($patch));
	$object_item = $object[0]->$type;
	$object_item[$tour]->name = $name;
	$object_item[$tour]->desc = $desc;
	$object_item[$tour]->price = $price;
	$object_item[$tour]->currency = $currency;
	$object_item[$tour]->route = $route;
	$object_item[$tour]->duration = $duration;
	$object_item[$tour]->program = $program;
	$object_item[$tour]->place = $place;
	if($date !== false){
		$object_item[$tour]->date = $date;
	}
	$fp = fopen($patch,'w');
	fwrite($fp,json_encode($object));
	fclose($fp);
	return true;
}

//============================================
// ADD TOUR
//============================================
function add_tour($type,$item,$name,$desc,$price,$currency,$route,$program,$duration,$place,$date){
	if($type == 'belarus'){
		$patch = '../../jsdb/JSON/tours/belarus.json';
		$fold = 'belarus';
	}
	if($type == 'belarus_pref'){
		$patch = '../../jsdb/JSON/tours/belarus_pref.json';
		$fold = 'belarus_pref';
	}
	if($type == 'foreigners'){
		$patch = '../../jsdb/JSON/tours/foreigners.json';
		$fold = 'foreigners';
	}
	if($type == 'foreigners_pref'){
		$patch = '../../jsdb/JSON/tours/foreigners_pref.json';
		$fold = 'foreigners_pref';
	}
	create_path('../../img/tours/'.$fold.'/'.$item.'/');
	do {
		$folder = randomName(7);
	} while(file_exists('../../img/tours/'.$fold.'/'.$item.'/'.$folder));
	$object = json_decode(file_get_contents($patch));

	$object_item = new stdClass();
	$object_item->name = $name;
	$object_item->desc = $desc;
	$object_item->price = $price;
	$object_item->currency = $currency;
	$object_item->route = $route;
	$object_item->program = $program;
	$object_item->duration = $duration;
	$object_item->place = $place;
	if($date !== false){
		$object_item->date = $date;
	}
	create_path('../../img/tours/'.$fold.'/'.$item.'/'.$folder);
	$object_item->img = 'img/tours/'.$fold.'/'.$item.'/'.$folder;
	// mkdir('../../img/tours/'.$fold.'/'.$item.'/'.$folder, 0777);
	array_push($object[0]->$item,$object_item);
	$fp = fopen($patch,'w');
	fwrite($fp,json_encode($object));
	fclose($fp);
	return true;
}

//============================================
// ADD IMG IN TOUR
//============================================
function add_img_tour($type,$item,$file){
	if($type == 'belarus'){
		$patch = '../../jsdb/JSON/tours/belarus.json';
	}
	if($type == 'belarus_pref'){
		$patch = '../../jsdb/JSON/tours/belarus_pref.json';
	}
	if($type == 'foreigners'){
		$patch = '../../jsdb/JSON/tours/foreigners.json';
	}
	if($type == 'foreigners_pref'){
		$patch = '../../jsdb/JSON/tours/foreigners_pref.json';
	}
	$exItem = explode('%',$item);
	$type = $exItem[0];
	$tour = (int)$exItem[1];
	$object = json_decode(file_get_contents($patch));
	$object_item = $object[0]->$type;
	$folder = $object_item[$tour]->img;
	do{
		$img = randomName(10);
		$extension = explode('.',$file['name']);
		$imgName = $img.'.'.$extension[1];
	} while(file_exists('../../'.$folder.'/'.$imgName));
	move_uploaded_file($file['tmp_name'], '../../'.$folder.'/'.$imgName);
	return true;
}

//============================================
// DELETE IMG FROM TOUR
//============================================
function del_img_tour($type,$item){
	if($type == 'belarus'){
		$patch = '../../jsdb/JSON/tours/belarus.json';
	}
	if($type == 'belarus_pref'){
		$patch = '../../jsdb/JSON/tours/belarus_pref.json';
	}
	if($type == 'foreigners'){
		$patch = '../../jsdb/JSON/tours/foreigners.json';
	}
	if($type == 'foreigners_pref'){
		$patch = '../../jsdb/JSON/tours/foreigners_pref.json';
	}
	$exItem = explode('%',$item);
	$type = $exItem[0];
	$tour = (int)$exItem[1];
	$imgName = $exItem[2];
	$object = json_decode(file_get_contents($patch));
	$object_item = $object[0]->$type;
	$folder = $object_item[$tour]->img;
	// return $folder;
	unlink('../../'.$folder.'/'.$imgName);
	return true;
}

//============================================
// DELETE TOUR
//============================================
function del_tour($type,$item){
	if($type == 'belarus'){
		$patch = '../../jsdb/JSON/tours/belarus.json';
	}
	if($type == 'belarus_pref'){
		$patch = '../../jsdb/JSON/tours/belarus_pref.json';
	}
	if($type == 'foreigners'){
		$patch = '../../jsdb/JSON/tours/foreigners.json';
	}
	if($type == 'foreigners_pref'){
		$patch = '../../jsdb/JSON/tours/foreigners_pref.json';
	}
	$exItem = explode('%',$item);
	$type = $exItem[0];
	$tour = (int)$exItem[1];
	$object = json_decode(file_get_contents($patch));
	$object_item = $object[0]->$type;
	$folder = $object_item[$tour]->img;
	removeFiles('../../'.$folder.'/');
	array_splice($object[0]->$type,$tour,1);
	$fp = fopen($patch,'w');
	fwrite($fp,json_encode($object));
	fclose($fp);
	return true;
}


//============================================
// RENAME SECTION
//============================================
function rn_section($type,$item,$name){
	if($type == 'belarus'){
		$patch = '../../jsdb/JSON/tours/belarus.json';
	}
	if($type == 'belarus_pref'){
		$patch = '../../jsdb/JSON/tours/belarus_pref.json';
	}
	if($type == 'foreigners'){
		$patch = '../../jsdb/JSON/tours/foreigners.json';
	}
	if($type == 'foreigners_pref'){
		$patch = '../../jsdb/JSON/tours/foreigners_pref.json';
	}
	$object = json_decode(file_get_contents($patch));
	$object_item = $object[0]->$item;
	$object_item[0] = $name;
	$object[0]->$item = $object_item;
	$fp = fopen($patch,'w');
	fwrite($fp,json_encode($object));
	fclose($fp);
	return true;
}

?>
