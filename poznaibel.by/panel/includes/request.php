<?php


if(isset($_GET['action'])){
	include '../../includes/_main.php';


	//============================================
	// FUNCTIONS
	//============================================
	function randomName($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function removeFiles($path){
		$folder = $path;
		$files = glob($folder . '/*');
		foreach($files as $file){
			if(is_file($file)){
				unlink($file);
			}
		}
	}




	if($_GET['action'] === 'get_comments'){
		echo file_get_contents('../../jsdb/JSON/about/comments.json');
	}

	if($_GET['action'] === 'get_contacts'){
		$contacts = json_decode(file_get_contents('../../jsdb/JSON/common/contacts.json'));
		echo json_encode($contacts[0]);
	}

	if($_GET['action'] === 'create_site_map'){
		include('site_map_generator.php');
		generate_site_map($url);
		header('Location: ../settings.php');
	}

	if($_GET['action'] === 'change_comments'){
		$file = json_decode(file_get_contents('../../jsdb/JSON/about/comments.json'));
		$changes = json_decode($_POST['settings']);
		for($i = 0; $i < count($changes); $i++){
			if($changes[$i] !== null){
				if(property_exists($changes[$i],'delete')){
					unset($file[$i]);
				} else {
					foreach($changes[$i] as $key => $value){
						$file[$i]->$key = $value;
					}
				}
			}
		}
		$res = array_values($file);
		$result = json_encode($res);
		$fp = fopen('../../jsdb/JSON/about/comments.json','w');
		fwrite($fp,$result);
		fclose($fp);
		echo true;
	}

	if($_GET['action'] === 'write_contacts'){
		$array = array();
		$object = json_decode($_POST['object']);
		$object->phone = array_filter($object->phone);
		$object->social = array_filter($object->social);
		$object->phone = array_values($object->phone);
		$object->social = array_values($object->social);
		array_push($array,$object);
		$result = json_encode($array);
		$fp = fopen('../../jsdb/JSON/common/contacts.json','w');
		fwrite($fp,$result);
		fclose($fp);
		echo true;
	}

	//============================================
	// GET DATES
	//============================================
	if($_GET['action'] == 'get_info'){

		if($_GET['section'] == 'header'){
			$photo = scandir('../../img/header');
			array_splice($photo,0,2);
			$info = json_decode(file_get_contents('../../jsdb/JSON/common/header.json'));
			$res_info = $info[0];
			foreach($res_info as $key => $value) {
				for($i = 0; $i < count($photo); $i++){
					if(strpos($photo[$i], $res_info->$key->img) !== false){
						$res_info->$key->img = '../img/header/'.$photo[$i];
					}
				}
			}
			echo json_encode($res_info);
		}


		if($_GET['section'] == 'about_belarus'){
			$file = json_decode(file_get_contents('../../jsdb/JSON/home/about_belarus.json'));
			$info = $file[0];
			echo json_encode($info);
		}

	}


	//============================================
	// SET DATES
	//============================================
	if($_GET['action'] == 'edit_info'){

		if($_GET['section'] == 'header'){
			$item = $_POST['inputItem'];
			$name = $_POST['inputName'];
			$desc = $_POST['inputDesc'];
			if($_FILES['image']['name'] != ''){
				$img = randomName(10);
				$extension = explode('.',$_FILES['image']['name']);
				$imgName = $img.'.'.$extension[1];
				move_uploaded_file($_FILES['image']['tmp_name'], '../../img/header/'.$imgName);
			} else {
				$imgName = false;
			}
			$object = json_decode(file_get_contents('../../jsdb/JSON/common/header.json'));

			foreach($object[0] as $key => $value){
				if($key == $item){
					$object[0]->$key->name = $name;
					$object[0]->$key->desc = $desc;
					if($imgName){
						unlink('../../img/header/'.$object[0]->$key->img);
						$object[0]->$key->img = $imgName;
					}
				}
			}
			$fp = fopen('../../jsdb/JSON/common/header.json','w');
			fwrite($fp,json_encode($object));
			fclose($fp);
			header('Location: ../');
		}



		if($_GET['section'] == 'del_header'){
			$item = $_POST['inputItem'];
			$object = json_decode(file_get_contents('../../jsdb/JSON/common/header.json'));
			foreach($object[0] as $key => $value){
				if($key == $item){
					unlink('../../img/header/'.$object[0]->$key->img);
					unset($object[0]->$key);
				}
			}
			$fp = fopen('../../jsdb/JSON/common/header.json','w');
			fwrite($fp,json_encode($object));
			fclose($fp);
			header('Location: ../');
		}


		if($_GET['section'] == 'add_header'){
			$item = $_POST['inputItem'];
			$name = $_POST['inputName'];
			$desc = $_POST['inputDesc'];
			$img = randomName(10);
			$extension = explode('.',$_FILES['image']['name']);
			$imgName = $img.'.'.$extension[1];
			move_uploaded_file($_FILES['image']['tmp_name'], '../../img/header/'.$imgName);
			$object = json_decode(file_get_contents('../../jsdb/JSON/common/header.json'));
			$object[0]->$imgName = new stdClass();
			$object[0]->$imgName->name = $name;
			$object[0]->$imgName->desc = $desc;
			$object[0]->$imgName->img = $imgName;
			$object[0]->$imgName->order_key = count((array)$object[0]);
			$fp = fopen('../../jsdb/JSON/common/header.json','w');
			fwrite($fp,json_encode($object));
			fclose($fp);
			header('Location: ../');
		}



		if($_GET['section'] == 'about_belarus'){
			$item = $_POST['inputItem'];
			$exItem = explode('%',$item);
			$folder = $exItem[0];
			$img = (int)$exItem[1];
			$name = $_POST['inputName'];
			$desc = $_POST['inputDesc'];
			if($_FILES['image']['name'] != ''){
				$imgRandom = randomName(10);
				$extension = explode('.',$_FILES['image']['name']);
				$imgName = $imgRandom.'.'.$extension[1];
				move_uploaded_file($_FILES['image']['tmp_name'], '../../img/about_belarus/'.$folder.'/'.$imgName);
			} else {
				$imgName = false;
			}
			$object = json_decode(file_get_contents('../../jsdb/JSON/home/about_belarus.json'));
			foreach($object[0] as $key => $value){
				if($key == $folder){
					$object[0]->$key->img[$img]->title = $name;
					$object[0]->$key->img[$img]->desc = $desc;
					if($imgName){
						unlink('../../img/about_belarus/'.$key.'/'.$object[0]->$key->img[$img]->src);
						$object[0]->$key->img[$img]->src = $imgName;
					}
				}
			}
			$fp = fopen('../../jsdb/JSON/home/about_belarus.json','w');
			fwrite($fp,json_encode($object));
			fclose($fp);
			header('Location: ../');
		}


		if($_GET['section'] == 'add_about_belarus'){
			$item = $_POST['inputItem'];
			$name = $_POST['inputName'];
			$desc = $_POST['inputDesc'];
			$imgRandom = randomName(10);
			$extension = explode('.',$_FILES['image']['name']);
			$imgName = $imgRandom.'.'.$extension[1];
			move_uploaded_file($_FILES['image']['tmp_name'], '../../img/about_belarus/'.$item.'/'.$imgName);
			$object = json_decode(file_get_contents('../../jsdb/JSON/home/about_belarus.json'));
			$result = new stdClass();
			$result->src = $imgName;
			$result->desc = $desc;
			$result->title = $name;
			array_push($object[0]->$item->img,$result);
			$fp = fopen('../../jsdb/JSON/home/about_belarus.json','w');
			fwrite($fp,json_encode($object));
			fclose($fp);
			header('Location: ../');
		}


		if($_GET['section'] == 'del_about_belarus'){
			$item = $_POST['inputItem'];
			$exItem = explode('%',$item);
			$folder = $exItem[0];
			$imgIndex = (int)$exItem[1];
			$object = json_decode(file_get_contents('../../jsdb/JSON/home/about_belarus.json'));
			unlink('../../img/about_belarus/'.$folder.'/'.$object[0]->$folder->img[$imgIndex]->src);
			array_splice($object[0]->$folder->img,$imgIndex,1);
			$fp = fopen('../../jsdb/JSON/home/about_belarus.json','w');
			fwrite($fp,json_encode($object));
			fclose($fp);
			header('Location: ../');
		}
	}



	// if($_GET['action'] == 'imgfromdir'){
	// 	$getImg = $_GET['img'];
	// 	$img = json_decode($getImg);
	// 	for($i = 0; $i < count($img); $i++){
	// 		$scan = scandir('../'.$img[$i][1]);
	// 		array_splice($scan, 0, 2);
	// 		for($count = 0; $count < count($scan); $count++){
	// 			$scan[$count] = $img[$i][1].'/'.$scan[$count];
	// 		}
	// 		$img[$i][1] = $scan;
	// 	}
	// 	$result = json_encode($img);
	// 	echo $result;
	// }
	//
	//
	// if($_GET['action'] == 'about_belarus_info'){
	//
	// 	if($_GET['section'] == 'about'){
	// 		$path = '../img/about_belarus/';
	// 		$dir = scandir($path);
	// 		array_splice($dir,0,2);
	// 		$res = new stdClass();
	// 		for($i = 0; $i < count($dir);$i++){
	// 			$img = scandir($path.$dir[$i]);
	// 			array_splice($img,0,2);
	// 			$result = array();
	// 			for($j = 0; $j < count($img); $j++){
	// 				$img_path = $path.$dir[$i].'/'.$img[$j];
	// 				$img_array = array();
	// 				$img_name = explode('.',$img[$j]);
	// 				array_push($img_array,$img_name[0],$url.'img/about_belarus/'.$dir[$i].'/'.$img[$j]);
	// 				array_push($result,$img_array);
	// 			}
	// 			$res->$dir[$i] = $result;
	// 		}
	// 		$res->_info = file_get_contents('../jsdb/JSON/home/about_belarus.json');
	// 		echo json_encode($res);
	// 	}
	//
	// 	if($_GET['section'] == 'header'){
	// 		$photo = scandir('../img/header');
	// 		array_splice($photo,0,2);
	// 		$info = json_decode(file_get_contents('../jsdb/JSON/common/header.json'));
	// 		$res_info = $info[0];
	// 		foreach($res_info as $key => $value) {
	// 			for($i = 0; $i < count($photo); $i++){
	// 				if(strpos($photo[$i], $res_info->$key->img) !== false){
	// 					$res_info->$key->img = 'img/header/'.$photo[$i];
	// 				}
	// 			}
	// 		}
	// 		echo json_encode($res_info);
	// 	}
	// }

}


?>
