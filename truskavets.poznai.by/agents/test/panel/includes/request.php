<?php

if(isset($_GET['action'])){

	include 'functions.php';

	// ===========================================================================
	//                          GET JSON FILE
	// ===========================================================================
	if($_GET['action'] === 'get_json'){
		$path = urldecode($_GET['path']);
		if(file_exists('../../'.$path)){
			echo file_get_contents('../../'.$path);
		} else {
			echo $path.' does not exist!';
		}
	}

	// ===========================================================================
	//                          WRITE JSON FILE
	// ===========================================================================
	if($_GET['action'] === 'write_json'){
		$file = $_POST['file'];
		$path_file = urldecode($_GET['path']);
		$ex_file = explode('/',$path_file);
		array_pop($ex_file);
		$path = implode('/',$ex_file);
		cleare_path_str($path);
		create_path('../../'.$path);
		write_json($file,'../../'.$path_file);
		echo true;
	}


	// ===========================================================================
	//                           DELETE FROM ARRAY
	// ===========================================================================
	if($_GET['action'] === 'delete_record'){
		$path = urldecode($_GET['path']);
		$url = urldecode($_GET['url']);
		delete_record($path,$array = urldecode($_GET['array']),$id = (int)$_GET['id']);
		header('Location: '.$url);
	}

	// ===========================================================================
	//                           CHANGE SINGLE IMAGE
	// ===========================================================================
	if($_GET['action'] === 'set_single_img'){
		$path = urldecode($_GET['path']);
		$object = json_decode(file_get_contents('../../'.$path));
		$id = (int)$_GET['id'];
		$get_arr = $_GET['array'];
		$get_key = $_GET['key'];
		$get_img_path = $_GET['imgPath'];
		$array = $object->$get_arr;
		$imgName = str_replace('/','',$array[$id]->$get_key);
		$imgFolder = '../../'.cleare_path_str($array[$id]->$get_img_path);
		$img_full_path = $imgFolder.$imgName;
		$_ex_imgName = explode('.',$imgName);
		if(file_exists($img_full_path)){
			unlink($img_full_path);
		}
		create_path($imgFolder);
		$extension = explode('.',$_FILES['imgFile']['name']);
		if($_ex_imgName[0] !== 'favicon'){
			do{
				// $imgRandom = randomName(10);
				$newImgName = randomName(10).'.'.$extension[1];
			} while(file_exists($imgFolder.$newImgName));
		} else {
			$newImgName = 'favicon'.'.'.$extension[1];
		}
		$NewImg = $imgFolder.$newImgName;

		move_uploaded_file($_FILES['imgFile']['tmp_name'], $NewImg);
		$array[$id]->$get_key = $newImgName;
		write_json(json_encode($object),'../../'.$path);
		echo $newImgName;
		// $url =	 urldecode($_GET['url']);
		// header('Location: '.$url);
	}


	// ===========================================================================
	//                           CHANGE SLIDER IMAGE
	// ===========================================================================
	if($_GET['action'] === 'upload_slider_img'){
		$path = urldecode($_GET['path']);
		$object = json_decode(file_get_contents('../../'.$path));
		$id = (int)$_GET['id'];
		$get_arr = $_GET['array'];
		$get_key = $_GET['key'];
		$get_imgIndex = $_GET['imgIndex'];
		$url = urldecode($_GET['url']);
		$array = $object->$get_arr;
		$images = $array[$id]->$get_key;
		$pathImg = cleare_path_str($array[$id]->imgPath);
		$old_img = $images[(int)$get_imgIndex];
		$old_file = $pathImg.$old_img;
		if(file_exists('../../'.$old_file)){
			unlink('../../'.$old_file);
		}
		create_path('../../'.$pathImg);
		do{
			$img = randomName(10);
			$extension = explode('.',$_FILES['setModalImgForm']['name']);
			$imgName = $img.'.'.$extension[1];
		} while(file_exists('../../'.$pathImg.$imgName));
		// echo json_encode($_FILES['setModalImgForm']);
		move_uploaded_file($_FILES['setModalImgForm']['tmp_name'], '../../'.$pathImg.$imgName);
		$images[(int)$get_imgIndex] = $imgName;
		$old_img = $images[(int)$get_imgIndex];
		$array[$id]->$get_key = $images;
		write_json(json_encode($object),'../../'.$path);
		echo $imgName;
		// header('Location: '.$url);
	}


	// ===========================================================================
	//                           UPLOAD MULTI IMG SLIDER
	// ===========================================================================
	if($_GET['action'] === 'upload_multi_slider_img') {
		$path = urldecode($_GET['path']);
		$object = json_decode(file_get_contents('../../'.$path));
		$id = (int)$_GET['id'];
		$get_arr = $_GET['array'];
		$get_key = $_GET['key'];
		$get_imgIndex = $_GET['imgIndex'];
		$get_pathImg = $_GET['imgPath'];
		$pathImg = &$object->$get_arr[(int)$id]->$get_pathImg;
		$pathImg = cleare_path_str($pathImg);

		create_path('../../'.$pathImg);
		do{
			$img = randomName(10);
			$extension = explode('.',$_FILES['setModalImgForm']['name']);
			$imgName = $img.'.'.$extension[1];
		} while(file_exists('../../'.$pathImg.$imgName));
		$img_array = &$object->$get_arr[(int)$id]->$get_key;
		array_push($img_array,$imgName);
		move_uploaded_file($_FILES['setModalImgForm']['tmp_name'], '../../'.$pathImg.$imgName);
		write_json(json_encode($object),'../../'.$path);
		echo $imgName;

	}


	// ===========================================================================
	//                           DELETE FILES
	// ===========================================================================
	if($_GET['action'] === 'del_files'){
		$files = json_decode($_POST['file']);
		for($i = 0; $i < count($files); $i++){
			$path = $files[$i];
			if(file_exists('../../'.$path)){
				unlink('../../'.$path);
			}
		}
		// $all_folders = explode('/',$files);
		// array_pop($all_folders);
		// $folder = implode('/',$all_folders);
		// if(is_dir_empty('../../'.$folder)){
		// 	rmdir('../../'.$folder);
		// }
		echo true;
	}

}


?>
