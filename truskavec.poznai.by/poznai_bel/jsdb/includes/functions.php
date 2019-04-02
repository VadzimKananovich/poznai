<?php


function createbd($dir,$name){
	if (!file_exists($dir)){
		mkdir($dir, 0777);
	}
	if(!file_exists($dir.'_bd.json')){
		$fp = fopen($dir.'_bd.json','w');
		fclose($fp);
	}
	if (file_exists($dir.$name)){
		return 'bd exist';
	} else {
		mkdir($dir.$name, 0777);
		$fp = fopen($dir.$name.'/_all.json','w');
		fclose($fp);
		$newbd = new stdClass();
		$newbd->_name = $name;
		$file = file_get_contents($dir.'_bd.json');
		$fp = fopen($dir.'_bd.json', 'w');
		if($file != ''){
			$array = json_decode($file);
		} else {
			$array = array();
		}
		array_push($array,$newbd);
		$file = json_encode($array);
		fwrite($fp,$file);
		fclose($fp);
		return 'created';
	}
}


function openbd($dir,$bd){
	if(!file_exists($dir.$bd.'/_all.json')){
		return 'noexist';
	} else {
		$file = file_get_contents($dir.$bd.'/_all.json');
		if($file == ''){
			return 'empty';
		} else {
			return $file;
		}
	}
}


function removebd($dir,$bd){
	if(!file_exists($dir.$bd)){
		return 'noexist';
	} else {
		$dirPath = $dir.$bd;
		if (! is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				$this->deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
		$file = file_get_contents($dir.'_bd.json');
		$array = json_decode($file);
		for($i = 0; $i < count($array); $i++){
			if($array[$i]->_name == $bd){
				array_splice($array,$i,1);
			}
		}
		$file = json_encode($array);
		$fp = fopen($dir.'_bd.json','w');
		fwrite($fp,$file);
		fclose($fp);
		return 'removed';
	}
}

function createtable($dir,$bd,$table){
	if(!file_exists($dir.$bd)){
		return 'noexist';
	} else {
		if(file_exists($dir.$bd.'/'.$table.'.json')){
			return 'table exist';
		} else {
			$fp = fopen($dir.$bd.'/'.$table.'.json','w');
			fclose($fp);
			$file = file_get_contents($dir.$bd.'/_all.json');
			if($file == ''){
				$array = array();
			} else {
				$array = json_decode($file);
			}
			$fp = fopen($dir.$bd.'/_all.json','w');
			$res = new stdClass();
			$res->_name = $table;
			array_push($array,$res);
			$result = json_encode($array);
			fwrite($fp,$result);
			fclose($fp);
			return 'created';
		}
	}
}

function removetable($dir,$bd,$table){
	if(!file_exists($dir.$bd)){
		return 'bd no exist';
	}
	if(!file_exists($dir.$bd.'/'.$table.'.json')){
		return 'table no exist';
	}
	unlink($dir.$bd.'/'.$table.'.json');
	$file = file_get_contents($dir.$bd.'/_all.json');
	if($file != ''){
		$array = json_decode($file);
		for($i = 0; $i < count($array); $i++){
			if($array[$i]->_name == $table){
				array_splice($array,$i,1);
			}
		}
		$res = json_encode($array);
		$fp = fopen($dir.$bd.'/_all.json','w');
		fwrite($fp,$res);
		fclose($fp);
		return 'removed';
	}
}

function opentable($dir,$bd,$table){
	if(!file_exists($dir.$bd)){
		return 'no bd';
	}
	if(!file_exists($dir.$bd.'/'.$table.'.json')){
		return 'no table';
	}
	$file = file_get_contents($dir.$bd.'/'.$table.'.json');
	echo $file;
}

function printbd($dir){
	if(!file_exists($dir.'_bd.json')){
		return 'no bd';
	}
	$file = file_get_contents($dir.'_bd.json');
	return $file;
}

function writetable($dir,$bd,$table,$object){
	if(!file_exists($dir.$bd)){
		return 'no bd';
	}
	if(!file_exists($dir.$bd.'/'.$table.'.json')){
		return 'no table';
	}
	$fp = fopen($dir.$bd.'/'.$table.'.json','w');
	fwrite($fp,$object);
	fclose($fp);
	return 'data recorded';
}
?>
