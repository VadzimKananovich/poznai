<?php


function createConnection($user,$password){
	$acess = getAcess();
	for($i = 0; $i < count($acess); $i++){
		if($acess[$i]->name == $user && $acess[$i]->password == $password){
			$json = createConnectJson($acess[$i]);
			return $json;
		}
	}
	return 'no user';
}

function createConnectJson($object){
	if(!file_exists('connect.json')){
		$result = array();
	} else {
		$file = file_get_contents('connect.json');
		if($file != ''){
			$result = json_decode($file);
			for($i = 0; $i < count($result); $i++){
				if($result[$i]->name == $object->name){
					return 'user connected';
				}
			}
		} else {
			$result = array();
		}
	}
	array_push($result,$object);
	$fp = fopen('connect.json','w');
	fwrite($fp,json_encode($result));
	fclose($fp);
	return 'user connected';
}

function getAcess(){
	$file = file_get_contents('acess.easyjs');
	$users = explode('.',$file);
	$res = array();
	for($i = 0; $i < count($users); $i++){
		$user = new stdClass();
		$dates = explode(';',$users[$i]);
		$name = explode('\'',$dates[0]);
		$user->name = $name[1];
		$password = explode('\'',$dates[1]);
		$user->password = $password[1];
		$permiss = explode('\'',$dates[2]);
		$user->permiss = $permiss[1];
		array_push($res,$user);
	}
	return $res;
}


function checkUser($user){
	if(!file_exists('connect.json')){
		return 'no connect';
	} else {
		$file = file_get_contents('connect.json');
		$array = json_decode($file);
		for($i = 0; $i < count($array); $i++){
			if($array[$i]->name == $user){
				return $array[$i]->permiss;
			}
		}
		return 'no connect';
	}
}

function removeConnection($user){
	$existUser = checkUser($user);
	if($existUser != 'no connect'){
		$file = file_get_contents('connect.json');
		$res = json_decode($file);
		for($i = 0; $i < count($res); $i++){
			if($res[$i]->name == $user){
				array_splice($res,$i,1);
			}
		}
		$result = json_encode($res);
		$fp = fopen('connect.json','w');
		fwrite($fp,$result);
		fclose($fp);
		return 'user disconnected';
	} else {
		return $checkUser;
	}
}



 ?>
