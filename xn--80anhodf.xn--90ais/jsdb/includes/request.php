<?php

if(isset($_GET['action'])){

	$json_path = '../JSON/';
	include 'functions.php';

	if($_GET['action'] == 'login'){
		$param = json_decode($_POST['param']);
		$log = login($param->name,$param->pass);
		echo $log;
	}

	if($_GET['action'] == 'logout'){
		logout();
	}

	if($_GET['action'] == 'create_folder'){
		$param = json_decode($_POST['param']);
		$create =  create_folder($json_path,$param->folder);
		echo $create;
	}

	if($_GET['action'] == 'get_info'){
		$param = json_decode($_POST['param']);
		$info = get_info($json_path,$param->folder);
		echo $info;
	}

	if($_GET['action'] == 'open_folder'){
		$param = json_decode($_POST['param']);
		$open = open_folder($json_path,$param->folder);
		echo $open;
	}

	if($_GET['action'] == 'delete_folder'){
		$param = json_decode($_POST['param']);
		$delete = delete_folder($json_path,$param->folder);
		echo $delete;
	}

	if($_GET['action'] == 'rename_folder'){
		$param = json_decode($_POST['param']);
		$rename = rename_folder($json_path,$param->folder,$param->newFolder);
		echo $rename;
	}

	if($_GET['action'] == 'create_json'){
		$param = json_decode($_POST['param']);
		$create = create_json($json_path,$param->folder,$param->name,$param->object);
		echo $create;
	}

	if($_GET['action'] == 'open_json'){
		$param = json_decode($_POST['param']);
		$open = open_json($json_path,$param->folder,$param->name);
		echo $open;
	}

	if($_GET['action'] == 'delete_json'){
		$param = json_decode($_POST['param']);
		$delete = delete_json($json_path,$param->folder,$param->name);
		echo $delete;
	}

	if($_GET['action'] == 'json_push'){
		$param = json_decode($_POST['param']);
		$push = json_push($json_path,$param->folder,$param->name,$param->object);
		echo $push;
	}

	if($_GET['action'] == 'delete_from_json'){
		$param = json_decode($_POST['param']);
		$delete = delete_from_json($json_path,$param->folder,$param->name,$param->item);
		echo $delete;
	}

	if($_GET['action'] == 'get_all_info'){
		$info = get_all_info($json_path);
		echo $info;
	}

}


?>
