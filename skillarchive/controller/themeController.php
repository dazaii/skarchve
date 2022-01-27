<?php

	if(isset($_POST['action']) and $_POST['action'] == "getTheme"){
		$opt = 0;
		session_start();
		if(!isset($_SESSION['darkmode'])){
			$_SESSION['darkmode'] = 0;
			$opt = 0;
		}else{
			if($_SESSION['darkmode'] == 1){
				$opt = 1;
			}else{
				$opt = 0;
			}
		}
		echo json_encode($opt);
	}
	if(isset($_POST['action']) and $_POST['action'] == "setTheme"){
		$opt = 0;
		session_start();
		if(!isset($_SESSION['darkmode'])){
			$_SESSION['darkmode'] = 1;
			$opt = 1;
		}else{
			if($_SESSION['darkmode'] == 1){
				$_SESSION['darkmode'] = 0;
				$opt = 0;
			}else{
				$_SESSION['darkmode'] = 1;
				$opt = 1;
			}
		}
		echo json_encode($opt);
	}
?>