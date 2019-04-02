<?php

/*======================================
FUNCTION LOGIN
========================================*/
function login($name,$pass){
	if(!$name || !$pass){
		return 'no dates';
	}
	$user_set = json_decode(file_get_contents('user_set.json'));
	for($i = 0; $i < count($user_set); $i++){
		if($user_set[$i]->name == $name && $user_set[$i]->password == $pass){
			session_start();
			$_SESSION['user'] = $user_set[$i]->name;
			return 'connected';
		}
	}
	return 'user does not exist';
}

/*======================================
FUNCTION LOGOUT
========================================*/
function logout(){
	session_start();
	session_unset();
}

/*======================================
FUNCTION CREATE FOLDER
========================================*/
function create_folder($json_path,$name){
	if (!file_exists($json_path)){
		mkdir($json_path, 0777);
	}
	if(!file_exists($json_path.'_info.json')){
		$fp = fopen($json_path.'_info.json','w');
		fwrite($fp,'[]');
		fclose($fp);
	}
	if (file_exists($json_path.$name)){
		return 'folder exist';
	} else {
		mkdir($json_path.$name, 0777);
		$fp = fopen($json_path.$name.'/_info.json','w');
		fwrite($fp,'[]');
		fclose($fp);
		if($name != ''){
			write_info_file($json_path,$name);
		}
		return 'created';
	}
}

/*======================================
FUNCTION GET INFO FILE
========================================*/
function get_info($json_path,$folder){
	if($folder == ''){
		$dir = $json_path;
	} else {
		$dir = $json_path.$folder;
	}
	if(!file_exists($dir)){
		return 'no exist';
	} else {
		$file = file_get_contents($dir.'/_info.json');
		if($file == '' || $file == '[]'){
			return 'empty';
		} else {
			return $file;
		}
	}
}

/*======================================
FUNCTION OPEN FOLDER
========================================*/
function open_folder($json_path,$folder){
	if($folder == ''){
		$dir = $json_path;
	} else {
		$dir = $json_path.$folder.'/';
	}
	if(!file_exists($dir)){
		return 'no exist';
	} else {
		$files = scandir($dir);
		array_splice($files,0,2);
		$result = new stdClass();
		for($i = 0; $i < count($files); $i++){
			if(is_dir($dir.$files[$i])){
				$subdir = scandir($dir.$files[$i]);
				array_splice($subdir,0,2);
				$subdir_res = new stdClass();
				for($j = 0; $j < count($subdir); $j++){
					$json = file_get_contents($dir.$files[$i].'/'.$subdir[$j]);
					$array_json = json_decode($json);
					$name = explode('.',$subdir[$j]);
					$subdir_res->$name[0] = $array_json;
				}
				$result->$files[$i] = $subdir_res;
			} else {
				$json = file_get_contents($dir.$files[$i]);
				$array_json = json_decode($json);
				$name = explode('.',$files[$i]);
				$result->$name[0] = $array_json;
			}
		}
		return json_encode($result);
	}
}

/*======================================
FUNCTION DELETE FOLDER
========================================*/
function delete_folder($json_path,$folder){
	if($folder == ''){
		$dir = $json_path;
	} else {
		$dir = $json_path.$folder.'/';
	}
	if(!file_exists($dir)){
		return 'no exist';
	} else {
		if($folder != ''){
			$json = json_decode(file_get_contents($json_path.'_info.json'));
			for($i = 0; $i < count($json); $i++){
				if($json[$i]->name == $folder){
					array_splice($json,$i,1);
				}
			}
			$open = fopen($json_path.'_info.json','w');
			fwrite($open,json_encode($json));
			fclose($open);
		}
		return removeDirectory($dir);
	}
}
function removeDirectory($dir){
	$dirPath = $dir;
	if (!is_dir($dirPath)) {
		throw new InvalidArgumentException("$dirPath must be a directory");
	}
	if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
		$dirPath .= '/';
	}
	$files = glob($dirPath.'*', GLOB_MARK);
	foreach ($files as $file) {
		if (is_dir($file)) {
			removeDirectory($file);
		} else {
			unlink($file);
		}
	}
	rmdir($dirPath);
	return 'removed';
}

/*======================================
FUNCTION RENAME FOLDER
========================================*/
function rename_folder($json_path,$folder,$newFolder){
	$oldPath = $json_path.$folder;
	$newPath = $json_path.$newFolder;
	if(!file_exists($oldPath)){
		return 'no exist';
	}
	if(file_exists($newPath)){
		return 'folder just exist';
	}
	if(rename($oldPath,$newPath)){
		return 'renamed';
	} else {
		return 'fatal error';
	}
}

/*======================================
FUNCTION CREATE JSON FILE
========================================*/
function create_json($json_path,$folder,$name,$object){
	$dir = $json_path.$folder.'/';
	if(file_exists($dir.$name.'.json')){
		return 'file exist';
	}
	if(!file_exists($dir)){
		create_folder($json_path,$folder);
	}
	write_info_file($dir,$name);
	$fp = fopen($dir.$name.'.json','w');
	fwrite($fp,'[]');
	fclose($fp);
	if($object != ''){
		$push = json_push($json_path,$folder,$name,$object);
	}
	add_last_changes($json_path,$folder,true);
	add_last_changes($dir,$name,true);
	return 'json is created';
}

/*======================================
FUNCTION OPEN JSON FILE
========================================*/
function open_json($json_path,$folder,$name){
	$dir = $json_path.$folder.'/';
	if(!file_exists($dir)){
		return 'no folder';
	}
	if(!file_exists($dir.$name.'.json')){
		return 'no json';
	}
	return file_get_contents($dir.$name.'.json');
}

/*======================================
FUNCTION DELETE JSON FILE
========================================*/
function delete_json($json_path, $folder,$name){
	$dir = $json_path.$folder.'/';
	if(!file_exists($dir)){
		return 'no folder';
	}
	if(!file_exists($dir.$name.'.json')){
		return 'no json';
	}
	unlink($dir.$name.'.json');
	$info = json_decode(file_get_contents($dir.'_info.json'));
	for($i = 0; $i< count($info); $i++){
		if($info[$i]->name == $name){
			array_splice($info,$i,1);
		}
	}
	$fp = fopen($dir.'_info.json','w');
	fwrite($fp,json_encode($info));
	fclose($fp);
	return 'json deleted';
}

/*======================================
FUNCTION ADD RECORD TO JSON FILE
========================================*/
function json_push($json_path,$folder,$name,$object){
	$dir = $json_path.$folder.'/';
	if(!file_exists($dir)){
		return 'no folder';
	}
	if(!file_exists($dir.$name.'.json')){
		return 'no json';
	}
	if($object == ''){
		return 'no object';
	}
	$json = json_decode(file_get_contents($dir.$name.'.json'));
	if($json != '' && $json != []){
		$newObject = new stdClass;
		foreach($json[0] as $key => $value){
			$newObject->$key = null;
		}
		foreach($newObject as $key => $value){
			if(property_exists($object,$key)){
				$newObject->$key = $object->$key;
			}
		}
		array_push($json,$newObject);
	} else {
		array_push($json,$object);
	}
	$fp = fopen($dir.$name.'.json','w');
	fwrite($fp,json_encode($json));
	fclose($fp);
	add_last_changes($json_path.'/',$folder);
	add_last_changes($dir.'/',$name, true);
	return 'object is added';
}

/*======================================
FUNCTION DELETE RECORD FROM JSON FILE
========================================*/
function delete_from_json($json_path, $folder, $name, $item){
	$dir = $json_path.$folder.'/';
	if(!file_exists($dir)){
		return 'no folder';
	}
	if(!file_exists($dir.$name.'.json')){
		return 'no json';
	}
	$json = json_decode(file_get_contents($dir.$name.'.json'));
	if($json == '' || $json == []){
		return 'json is empty';
	}
	if(is_object($item)){
		$total = (count((array)$item));
		$deleted_items = 0;
		if($total == 0){
			return 'item is empty';
		}
		for($i = 0; $i < count($json); $i++){
			$find = 0;
			foreach($json[$i] as $key => $value){
				if($value == $item->$key){
					$find++;
				}
			}
			if($find == $total){
				array_splice($json,$i,1);
				$deleted_items++;
			}
		}
		if($deleted_items == 0){
			return 'record do not find';
		}
	}
	if(is_numeric($item)){
		array_splice($json,$item,1);
	}
	$fp = fopen($dir.$name.'.json','w');
	fwrite($fp,json_encode($json));
	fclose($fp);
	add_last_changes($dir,$name,true);
	add_last_changes($json_path,$folder);
	return 'record has been deleted';
}

/*======================================
FUNCTION GET ALL INFO OF JSON FILES
========================================*/
function get_all_info($json_path){
	$info = json_decode(get_info($json_path));
	$res = new stdClass;
	for($i = 0; $i < count($info); $i++){
		$json_info = json_decode(get_info($json_path,$info[$i]->name));
		$name = $info[$i]->name;
		$res->$name = $json_info;
	}
	return json_encode($res);
}





/*======================================
FUNCTION WRITE INFO INTO _INFO FILE
========================================*/
function write_info_file($dir,$name){
	$info = json_decode(file_get_contents($dir.'_info.json'));

	date_default_timezone_set('Europe/Minsk');

	$newObject = new stdClass;
	$newObject->name = $name;
	$newObject->created = date("d.m.Y / H:i:s");

	array_push($info,$newObject);
	$file = json_encode($info);

	$fp = fopen($dir.'_info.json', 'w');
	fwrite($fp,$file);
	fclose($fp);
}

/*======================================
FUNCTION WRITE LAST CHANGES AND COUNT ITEMS
========================================*/
function add_last_changes($dir,$name,$count = false){

	$info = json_decode(file_get_contents($dir.'_info.json'));

	date_default_timezone_set('Europe/Minsk');

	if($count){
		if(!is_dir($dir.$name)){
			$json = json_decode(file_get_contents($dir.$name.'.json'));
			$records = count($json);
		} else {
			$json = json_decode(file_get_contents($dir.$name.'/_info.json'));
			$records = count($json);
		}
	}

	for($i = 0; $i < count($info); $i++){
		if($info[$i]->name == $name){
			$info[$i]->last_changes = date("d.m.Y / H:i:s");
			if($count){
				$info[$i]->total = $records;
			}
		}
	}

	$fp = fopen($dir.'_info.json','w');
	fwrite($fp,json_encode($info));
	fclose($fp);
}

?>
