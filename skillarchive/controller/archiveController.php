<?php
	class Controller{
		function displayUserInfo(){
			include_once '../model/mainModel.php';
			$m = new Model();
			$data = $m->getUserInfo();
			include_once "../view/userview.php";
		}
		function addToArc($title,$category,$content,$keywords){
			include_once '../model/mainModel.php';
			$m = new Model();
			$opt = $m->insertToArc($title, $category, $content, $keywords);
		}
		function viewNf(){
			include_once '../model/mainModel.php';
			$m = new Model();
			$data = $m->viewNf();
			include_once "../view/nfView.php";
		}
		function viewNfByCat($catid){
			include_once '../model/mainModel.php';
			$m = new Model();
			$data = $m->viewNfByCat($catid);
			include_once "../view/nfView.php";
		}
	}

	$c = new Controller();
	if(isset($_POST['action']) && $_POST['action'] == "add"){

		$title = $_POST['title'];
		$category = $_POST['category'];
		$content = $_POST['content'];
		$keywords = $_POST['keywords'];

		$c->addToArc($title,$category,$content,$keywords);
		echo json_encode(1);
	}
	//modify archive
	if(isset($_POST['action']) && $_POST['action'] == "modifyarchive"){

		$title = $_POST['title'];
		$id = $_POST['id'];
		$category = $_POST['category'];
		$content = $_POST['content'];
		$keywords = $_POST['keywords'];

		include_once '../model/mainModel.php';
		$m = new Model();
		$m->modifyArc($id,$title,$category,$content,$keywords);
		echo json_encode(1);
	}




	if(isset($_POST['action']) && $_POST['action'] == "viewNewsFeed"){
		$c->viewNf();
	}
	if(isset($_POST['action']) && $_POST['action'] == "viewNewsFeedByCategory"){
		$catid = $_POST['catid'];
		$c->viewNfByCat($catid);
	}
	if(isset($_POST['action']) && $_POST['action'] == "searcharchive" && isset($_POST['svalue'])){
		$svalue = $_POST['svalue'];
		include_once '../model/mainModel.php';
		$m = new Model();
		$data = $m->viewSearch($svalue);
		if($data->num_rows > 0) include_once "../view/nfView.php";
		else echo json_encode(0);
	}
	if(isset($_POST['action']) && $_POST['action'] == "searcharchive2" && isset($_POST['svalue'])){
		$svalue = $_POST['svalue'];
		include_once '../model/mainModel.php';
		$m = new Model();
		$data = $m->viewSearchLimit($svalue, 20);
		if($data->num_rows > 0) include_once "../view/titleview.php";
		else echo json_encode(0);
	}
	if(isset($_POST['action']) && $_POST['action'] == "previewpost" && isset($_POST['svalue'])){
		$svalue = $_POST['svalue'];
		include_once '../model/mainModel.php';
		$m = new Model();
		$data = $m->viewsinglepost($svalue);
		if($data->num_rows > 0) include_once "../view/singlepostview.php";
		else echo json_encode(0);
	}
	if(isset($_POST['action']) && $_POST['action'] == "deletefromarchive" && isset($_POST['id'])){
		$id = $_POST['id'];
		include_once '../model/mainModel.php';
		$m = new Model();
		$m->deleteFromArchive($id);
		echo json_encode(1);
	}
	if(isset($_POST['action']) && $_POST['action'] == "getcontents" && isset($_POST['id'])){
		$id = $_POST['id'];
		include_once '../model/mainModel.php';
		$m = new Model();
		$row = $m->getContents($id);
		echo json_encode($row);
	}
?>
