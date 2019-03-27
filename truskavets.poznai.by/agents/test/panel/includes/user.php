<?php

if(isset($_GET['action'])){
	if($_GET['action'] == 'login'){
		$users = json_decode(file_get_contents('../users.json'))->users;
		$check_user = false;
		for($i = 0; $i < count($users); $i++){
			if($_POST['username'] === strip_tags($users[$i]->name) && $_POST['password'] === strip_tags($users[$i]->password)){
				$check_user = $_POST['username'];
				session_start();
				if(empty($_SESSION['user'])){
					$_SESSION['user'] = array();
				}
				if(!in_array($_POST['username'],$_SESSION['user'])){
					array_push($_SESSION['user'],$_POST['username']);
				}
			}
		}
		if($check_user){
			header('location: ../');
		} else {
			header('location: ../index.php?login=error');
		}
	}

	
	if($_GET['action'] == 'logout'){
		session_start();
		$key=array_search($_GET['user'],$_SESSION['user']);
		if($key!==false)
		unset($_SESSION['user'][$key]);
		$_SESSION["user"] = array_values($_SESSION["user"]);
		header('location: ../');
	}
}
?>
