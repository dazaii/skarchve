<?php
	$opt = "";
	session_start();
	if(isset($_SESSION['kotoba'])){
		$opt = "<div class='text-center hide'><a class='btn btn-info text-white' href='shirocloud/cloud.php'>いけ</a></div>";
	}else{
		$opt = "notloggedin";
	}
	echo json_encode($opt);
?>