<?php

function check_user($json = 'users.json'){
	session_start();
	// echo print_r($_SESSION);
	if(isset($_SESSION['user']) && is_array($_SESSION['user'])){
		$all_usr = json_decode(file_get_contents($json))->users;
		$count_usr = 0;
		$_usr = false;
		for($i = 0; $i < count($all_usr); $i++) {
			$exist_usr = strip_tags($all_usr[$i]->name);
			if(in_array($exist_usr, $_SESSION['user'])){
				$count_usr++;
				$_usr = $exist_usr;
			}
		}
		if($count_usr === 1) {
			return $_usr;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

 ?>
