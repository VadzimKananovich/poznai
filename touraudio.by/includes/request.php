<?php

if(isset($_POST['request'])){
	if($_POST['request'] == 'articles'){
		$articles = file_get_contents('../JSON/articles.json');
		echo $articles;
	}
	if($_POST['request'] == 'products'){
		include 'main.php';
		$query = "SELECT * FROM `touraudio_products`";
		$result = mysqli_query($conn,$query);
		mysqli_close($conn);
		if($result){
			$array = array();
			while($row = mysqli_fetch_object($result)){
				array_push($array,$row);
			}
			$json_complect = json_encode($array);
		} else {
			$json_complect = file_get_contents('../db.json');
		}
		echo $json_complect;
	}

	if($_POST['request'] == 'comments'){
		include 'main.php';
		$query = "SELECT * FROM `touraudio_comments` WHERE `state` = 'confirm' ORDER BY `id`";
		$result = mysqli_query($conn,$query);
		mysqli_close($conn);
		if($result){
			$array = array();
			while($row = mysqli_fetch_object($result)){
				array_push($array,$row);
			}
			$json_complect = json_encode($array);
		}
		echo $json_complect;
	}


}

?>
