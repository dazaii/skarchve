<?php
	require '../../includes/auth.php';
	if(isset($_POST['fid'])){
		$fid = $_POST['fid'];
		$currentfolder = $_SESSION['currentfolderr'];	//stores the current folder id
		$res = $dc->conn->query("select * from files where file_id = $fid");
		if($res->num_rows > 0){
			$row = $res->fetch_assoc();

			//delete files and if it is an images remove also its thumbnail
			$link = $row['link'];
			$filetype = $row['filetype'];
			$path = "../".$link;
			unlink($path);
			if($filetype == "jpg" ||$filetype == "gif" ||$filetype == "png" || $filetype == "webp"){
				$path = "../uploads/riyousha$darega/thumbs/".basename($link);
				unlink($path);
			}

			$sql = "delete from files where file_id = $fid";
			$dc->conn->query($sql);
			$sql = "delete from shared where itsid = $fid and type=1";
			$dc->conn->query($sql);
		}
		echo json_encode($currentfolder);
	}else{
		echo json_encode(0);
	}
?>