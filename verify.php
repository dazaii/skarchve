<?php
	require 'includes/conn.php';
	$u = new User();
	if (isset($_POST['mahounokotoba']) and !empty($_POST['mahounokotoba']) and  isset($_POST['riyousha']) and !empty($_POST['riyousha'])) {
		$magicword = $_POST['mahounokotoba'];
		$username = $_POST['riyousha'];
		if($u->login($username, $magicword)){
			echo json_encode(1);
		}else{
			echo json_encode(0);
		}
	}else{
		echo json_encode(0);
	}
?>