<?php

function randomName($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function write_json($object,$path){
	$fp = fopen($path,'w');
	fwrite($fp,$object);
	fclose($fp);
	return true;
}


function delete_record($path,$array,$id){
	$object = json_decode(file_get_contents('../../'.$path));
	$index = (int)$id;
	$del_obj = $object->$array;
	if(isset($del_obj[$index])){
		unset($del_obj[$index]);
		$res_array = array_values($del_obj);
		$object->$array = $res_array;
		$fp = fopen('../../'.$path,'w');
		fwrite($fp,json_encode($object));
		fclose($fp);
	}
}


function cleare_path_str($pathStr){
	if($pathStr !== ''){
		$pathStr = str_replace(' ','',$pathStr);
		$ex_path = explode('/',$pathStr);
		$filter_arr = array_filter($ex_path);
		$res_path = implode('/',$filter_arr).'/';
		return $res_path;
	} else {
		return $pathStr;
	}
}

function create_path($path){
	if(!is_dir($path)){
		mkdir($path, 0777, true);
	}
}

function is_dir_empty($dir){
	if (!is_dir($dirname)) return false;
	foreach (scandir($dirname) as $file){
		if (!in_array($file, array('.','..','.svn','.git'))) return false;
	}
	return true;
}


?>
