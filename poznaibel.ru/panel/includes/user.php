<?php

if(isset($_GET['action'])){
	if($_GET['action'] == 'login'){
		if($_POST['username'] == 'poznai' && $_POST['password'] == 'Avgust777'){
			session_start();
			$_SESSION['user'] = 'poznai';
			header('location: ../');
		} else {
			header('location: ../index.php?login=error');
		}
	}
	if($_GET['action'] == 'logout'){
		session_start();
		session_unset();
		header('location: ../');
	}
}

 ?>
