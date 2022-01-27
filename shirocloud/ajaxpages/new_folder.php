<?php
	require '../../includes/auth.php';
	if(isset($_POST['foldername'])){
		$foldername = $_POST['foldername'];
		$currentfolder = $_SESSION['currentfolderr'];	//stores the current folder id

		$sql = "insert into filetree(folder_name, parent_folder, ownerid) values('$foldername',$currentfolder, $darega)";
		$dc->conn->query($sql);
		echo json_encode($currentfolder);
	}else{
		echo json_encode(0);
	}
?>