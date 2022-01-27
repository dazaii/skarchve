<?php
	require '../../includes/auth.php';
	$opt = "";
	if(isset($_SESSION['kotoba'])){
		$uid = $_SESSION['kotoba'];
		$cont = $_POST['content'];
		$tit = $_POST['title'];
		$stmt = $dc->conn->prepare("insert into notes(content, title, owner) values(?, ?, ?)");
		$stmt->bind_param("ssi", $cont, $tit, $uid);
		$stmt->execute();
	}
	echo json_encode($opt);
?>