<?php

if(isset($_POST['request'])){
	if($_POST['request'] == 'articles'){
		$articles = file_get_contents('../JSON/articles.json');
		echo $articles;
	}
	if($_POST['request'] == 'products'){
		include '_main.php';
		$query = "SELECT * FROM `touraudioguide_products`";
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


}

if(isset($_GET['request'])){

	if($_GET['request'] == 'sendcomment'){
		include '_main.php';
		$name = $_POST['commentName'];
		$email = $_POST['commentEmail'];
		$company = $_POST['commentCompany'];
		$webSite = $_POST['commentWeb'];
		$comment = $_POST['commentText'];
		$currentDate = $_POST['currentDate'];

		$query = "INSERT INTO `touraudioguide_comments` (`name`, `email`, `comment`, `img`, `company`, `currentDate`, `site`, `state`)
		VALUES ('$name', '$email', '$comment', 'null', '$company', '$currentDate', '$webSite', 'pending')";
		$result = mysqli_query($conn,$query);
		if($result){
			echo true;
		} else {
			echo 'false';
		}
		mysqli_close($conn);
	}



	if($_GET['request'] == 'comments'){
		include '_main.php';
		$query = "SELECT * FROM `touraudioguide_comments` WHERE `state` = 'confirm' ORDER BY `id`";
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
