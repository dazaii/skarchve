<?php
	include_once '../model/mainModel.php';
	include_once '../../includes/auth.php';
	$m = new Model();

	
	if(isset($_POST['catname'])){
		$catname = $_POST['catname'];
		$m->insertCategory($catname);
	}
	if(isset($_POST['renamecatname'])){
		$catname = $_POST['renamecatname'];
		$catid = $_POST['catid'];
		$m->modifyCategory($catid,$catname);
	}
	if(isset($_POST['deletecatid']) && isset($_POST['confirmpass'])){
		$catid = $_POST['deletecatid'];
		$pass = $_POST['confirmpass'];
		if($u->verifypassword($pass)){
			$m->deleteCategory($catid);
		}
	}
?>