<?php


	if(isset($_POST['action']) && $_POST['action'] == 'viewNewsFeed'){
		include_once '../model/homemodel.php';
		$obj = new HomeModel();
		$data = $obj->viewPosts(1);
		include_once '../view/nfView.php';
	}

	
?>