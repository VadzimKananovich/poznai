
<?php
if(isset($_GET['action'])){
	include '../../includes/_main.php';
	include 'functions.php';


	//============================================
	// GET INFO ABOUT TOUR
	//============================================
	if($_GET['action'] == 'get_info'){
		if($_GET['type'] == 'belarus'){
			echo get_tours_info('belarus');
		}
		if($_GET['type'] == 'belarus_pref'){
			echo get_tours_info('belarus_pref');
		}
		if($_GET['type'] == 'foreigners'){
			echo get_tours_info('foreigners');
		}
		if($_GET['type'] == 'foreigners_pref'){
			echo get_tours_info('foreigners_pref');
		}
	}


	if($_GET['action'] == 'edit_info'){
		//============================================
		// EDIT TOUR
		//============================================
		if($_GET['type'] === 'belarus_edit_tour' || $_GET['type'] === 'belarus_pref_edit_tour'
		|| $_GET['type'] === 'foreigners_edit_tour' || $_GET['type'] === 'foreigners_pref_edit_tour'){

			if($_GET['type'] === 'belarus_edit_tour'){
				$edit_type = 'belarus';
				$inputDate = false;
				$edit_loc = '../belarus.php';
			}
			if($_GET['type'] === 'belarus_pref_edit_tour'){
				$edit_type = 'belarus_pref';
				$inputDate = $_POST['inputDate'];
				$edit_loc = '../belarus_pref.php';
			}
			if($_GET['type'] === 'foreigners_edit_tour'){
				$edit_type = 'foreigners';
				$inputDate = false;
				$edit_loc = '../foreigners.php';
			}
			if($_GET['type'] === 'foreigners_pref_edit_tour'){
				$edit_type = 'foreigners_pref';
				$inputDate = $_POST['inputDate'];
				$edit_loc = '../foreigners_pref.php';
			}
			edit_tour(
				$edit_type,
				$_POST['inputItem'],
				$_POST['inputName'],
				$_POST['inputDesc'],
				$_POST['inputPrice'],
				$_POST['inputCurrency'],
				$_POST['inputRoute'],
				$_POST['inputDuration'],
				$_POST['inputProgram'],
				$_POST['inputPlace'],
				$inputDate
			);
			header('Location: '.$edit_loc);
		}


		//============================================
		// ADD TOUR
		//============================================
		if($_GET['type'] === 'belarus_add_tour' || $_GET['type'] === 'belarus_pref_add_tour'
		|| $_GET['type'] === 'foreigners_add_tour' || $_GET['type'] === 'foreigners_pref_add_tour'){

			if($_GET['type'] == 'belarus_add_tour'){
				$add_type = 'belarus';
				$inputDate = false;
				$add_loc = '../belarus.php';
			}
			if($_GET['type'] == 'belarus_pref_add_tour'){
				$add_type = 'belarus_pref';
				$inputDate = $_POST['inputDate'];
				$add_loc = '../belarus_pref.php';
			}
			if($_GET['type'] == 'foreigners_add_tour'){
				$add_type = 'foreigners';
				$inputDate = false;
				$add_loc = '../foreigners.php';
			}
			if($_GET['type'] == 'foreigners_pref_add_tour'){
				$add_type = 'foreigners_pref';
				$inputDate = $_POST['inputDate'];
				$add_loc = '../foreigners_pref.php';
			}
			add_tour(
				$add_type,
				$_POST['inputItem'],
				$_POST['inputName'],
				$_POST['inputDescAdd'],
				$_POST['inputPrice'],
				$_POST['inputCurrency'],
				$_POST['inputRouteAdd'],
				$_POST['inputProgramAdd'],
				$_POST['inputDurationAdd'],
				$_POST['inputPlace'],
				$inputDate
			);
			header('Location: '.$add_loc);
		}


		//============================================
		// ADD IMG IN TOUR
		//============================================
		if($_GET['type'] === 'belarus_add_img' || $_GET['type'] === 'belarus_pref_add_img'
		|| $_GET['type'] === 'foreigners_add_img' || $_GET['type'] === 'foreigners_pref_add_img'){

			if($_GET['type'] == 'belarus_add_img'){
				add_img_tour('belarus',$_POST['inputItem'],$_FILES['image']);
				header('Location: ../belarus.php');
			}
			if($_GET['type'] == 'belarus_pref_add_img'){
				add_img_tour('belarus_pref',$_POST['inputItem'],$_FILES['image']);
				header('Location: ../belarus_pref.php');
			}
			if($_GET['type'] == 'foreigners_add_img'){
				add_img_tour('foreigners',$_POST['inputItem'],$_FILES['image']);
				header('Location: ../foreigners.php');
			}
			if($_GET['type'] == 'foreigners_pref_add_img'){
				add_img_tour('foreigners_pref',$_POST['inputItem'],$_FILES['image']);
				header('Location: ../foreigners_pref.php');
			}
		}
		//============================================
		// DELETE IMG FROM TOUR
		//============================================
		if($_GET['type'] === 'belarus_del_img' || $_GET['type'] === 'belarus_pref_del_img'
		|| $_GET['type'] === 'foreigners_del_img' || $_GET['type'] === 'foreigners_pref_del_img'){

			if($_GET['type'] == 'belarus_del_img'){
				del_img_tour('belarus',$_POST['imgToDel']);
				header('Location: ../belarus.php');
			}
			if($_GET['type'] == 'belarus_pref_del_img'){
				del_img_tour('belarus_pref',$_POST['imgToDel']);
				header('Location: ../belarus_pref.php');
			}
			if($_GET['type'] == 'foreigners_del_img'){
				del_img_tour('foreigners',$_POST['imgToDel']);
				header('Location: ../foreigners.php');
			}
			if($_GET['type'] == 'foreigners_pref_del_img'){
				del_img_tour('foreigners_pref',$_POST['imgToDel']);
				header('Location: ../foreigners_pref.php');
			}
		}
		//============================================
		// DELETE TOUR
		//============================================
		if($_GET['type'] === 'belarus_del_tour' || $_GET['type'] === 'belarus_pref_del_tour'
		|| $_GET['type'] === 'foreigners_del_tour' || $_GET['type'] === 'foreigners_pref_del_tour'){

			if($_GET['type'] == 'belarus_del_tour'){
				del_tour('belarus',$_POST['inputItem']);
				header('Location: ../belarus.php');
			}
			if($_GET['type'] == 'belarus_pref_del_tour'){
				del_tour('belarus_pref',$_POST['inputItem']);
				header('Location: ../belarus_pref.php');
			}
			if($_GET['type'] == 'foreigners_del_tour'){
				del_tour('foreigners',$_POST['inputItem']);
				header('Location: ../foreigners.php');
			}
			if($_GET['type'] == 'foreigners_pref_del_tour'){
				del_tour('foreigners_pref',$_POST['inputItem']);
				header('Location: ../foreigners_pref.php');
			}
		}

		//============================================
		// RENAME SECTION
		//============================================
		if($_GET['type'] === 'belarus_rm_section' || $_GET['type'] === 'belarus_pref_rm_section'
		|| $_GET['type'] === 'foreigners_rm_section' || $_GET['type'] === 'foreigners_pref_rm_section'){

			if($_GET['type'] == 'belarus_rm_section'){
				echo rn_section('belarus',$_POST['inputItem'],$_POST['inputName']);
				header('Location: ../belarus.php');
			}
			if($_GET['type'] == 'belarus_pref_rm_section'){
				echo rn_section('belarus_pref',$_POST['inputItem'],$_POST['inputName']);
				header('Location: ../belarus_pref.php');
			}
			if($_GET['type'] == 'foreigners_rm_section'){
				rn_section('foreigners',$_POST['inputItem'],$_POST['inputName']);
				header('Location: ../foreigners.php');
			}
			if($_GET['type'] == 'foreigners_pref_rm_section'){
				rn_section('foreigners_pref',$_POST['inputItem'],$_POST['inputName']);
				header('Location: ../foreigners_pref.php');
			}
		}
	}

}
?>
