<?php
	class Controller{

		function __construct(){
			$this->invoke();
		}
		function invoke(){
			//echo json_encode("haha ");
		}
		function displayUserInfo(){
			include_once '../model/mainModel.php';
			$m = new Model();
			$data = $m->getUserInfo();
			include_once "../view/userview.php";
		}
		function viewCat(){
			include_once '../model/mainModel.php';
			$m = new Model();
			$data = $m->getCat();
			include_once "../view/catView.php";
		}
		function viewCatOptions(){
			include_once '../model/mainModel.php';
			$m = new Model();
			$data = $m->getCat();
			include_once "../view/catSelectView.php";
		}
	}

	$c = new Controller();
	if(isset($_POST['action']) && $_POST['action'] == "reloadCategories"){
		$c->viewCat();
	}
	if(isset($_POST['action']) && $_POST['action'] == "reloadCategoryOptions"){
		$c->viewCatOptions();
	}
	if(isset($_POST['action']) && $_POST['action'] == "getcatcontents"){
		$catid = $_POST['id'];
		include_once '../model/mainModel.php';
		$m = new Model();
		$row = $m->getCatRow($catid);
		echo json_encode($row);
	}
?>