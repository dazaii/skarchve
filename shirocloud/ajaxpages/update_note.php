<?php
	require '../../includes/auth.php';
	$opt = "";
	if(isset($_SESSION['kotoba'])){
		$uid = $_SESSION['kotoba'];
		$cont = $_POST['content'];
		$tit = $_POST['title'];
		$noteid = $_POST['noteid'];

		$stmt = $dc->conn->prepare("update notes set title = ?, content = ? where note_id = ?");
		$stmt->bind_param("ssi", $tit, $cont, $noteid);
		$stmt->execute();
	}
	echo json_encode($opt);
?>