<?php

if(isset($_GET['action'])){

	include 'functions.php';
	include 'user_functions.php';

	if($_GET['action'] == 'connect'){
		$user = $_POST['user'];
		$password = $_POST['password'];
		$connect =  createConnection($user,$password);
		echo $connect;
	}

	if($_GET['action'] == 'disconnect'){
		$user = $_POST['user'];
		$disconnect =  removeConnection($user);
		echo $disconnect;
	}

	if($_GET['action'] == 'createbd'){
		$postUser = $_POST['user'];
		$user = checkUser($postUser);
		if($user == 'all' || $user == 'write'){
			$newbd = $_GET['name'];
			$create =  createbd('../JSON/',$newbd);
			echo $create;
		} else {
			echo 'no permiss';
		}
	}

	if($_GET['action'] == 'openbd'){
		$postUser = $_POST['user'];
		$user = checkUser($postUser);
		if($user != 'no connect'){
			$bd = $_GET['bd'];
			$open = openbd('../JSON/',$bd);
			echo $open;
		} else {
			echo 'no permiss';
		}
	}

	if($_GET['action'] == 'removebd'){
		$postUser = $_POST['user'];
		$user = checkUser($postUser);
		if($user == 'all' || $user == 'write'){
			$bd = $_GET['bd'];
			$remove = removebd('../JSON/',$bd);
			echo $remove;
		} else {
			echo 'no permiss';
		}
	}

	if($_GET['action'] == 'createtable'){
		$postUser = $_POST['user'];
		$user = checkUser($postUser);
		if($user == 'all' || $user == 'write'){
			$bd = $_GET['bd'];
			$table = $_GET['table'];
			$create = createtable('../JSON/',$bd,$table);
			echo $create;
		} else {
			echo 'no permiss';
		}
	}

	if($_GET['action'] == 'removetable'){
		$postUser = $_POST['user'];
		$user = checkUser($postUser);
		if($user == 'all' || $user == 'write'){
			$bd = $_GET['bd'];
			$table = $_GET['table'];
			$remove = removetable('../JSON/',$bd,$table);
			echo $remove;
		} else {
			echo 'no permiss';
		}
	}

	if($_GET['action'] == 'opentable'){
		$postUser = $_POST['user'];
		$user = checkUser($postUser);
		if($user != 'no connect'){
			$bd = $_GET['bd'];
			$table = $_GET['table'];
			$open = opentable('../JSON/',$bd,$table);
			echo $open;
		} else {
			echo 'no permiss';
		}
	}

	if($_GET['action'] == 'printbd'){
		// $postUser = $_POST['user'];
		// $user = checkUser($postUser);
		// if($user != 'no connect'){
			$print = printbd('../JSON/');
			echo $print;
		// } else {
			// echo 'no permiss';
		// }
	}

	if($_GET['action'] == 'write'){
		$postUser = $_POST['user'];
		$user = checkUser($postUser);
		if($user == 'all' || $user == 'write'){
			$bd = $_GET['bd'];
			$table = $_GET['table'];
			$object = $_POST['object'];
			$write = writetable('../JSON/',$bd,$table,$object);
			echo $write;
		}else {
			echo 'no permiss';
		}
	}


	if($_GET['action'] == 'scandir'){
		$postUser = $_POST['user'];
		$user = checkUser($postUser);
		if($user == 'all' || $user == 'write'){
			$dir = $_GET['dir'];
			$res = scandir('../../'.$dir);
			array_splice($res, 0, 2);
			$json_res = json_encode($res);
			echo $json_res;
		} else {
			echo 'no permiss';
		}
	}


	if($_GET['action']=='connection'){
		echo $_SERVER['REMOTE_ADDR'];
	}



}


?>
