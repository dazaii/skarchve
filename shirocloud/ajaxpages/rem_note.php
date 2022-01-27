<?php
	require '../../includes/auth.php';
	$opt = "";
	if(isset($_SESSION['kotoba'])){
		$uid = $_SESSION['kotoba'];
		$noteid = $_POST['noteid'];
		$sql = "delete from notes where note_id = $noteid";
		$dc->conn->query($sql);
	}
	echo json_encode($opt);
?>