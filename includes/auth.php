<?php
	require 'conn.php';
	$dc = new dbConnect();
	$u = new User();
	$u->sessionCheck();
	$darega = $_SESSION['kotoba'];
			$sql = "select language, name from iamoppa where count = $darega";
			$res = $dc->conn->query($sql);
			$row = $res->fetch_assoc();
			$language = $row['language'];
			$namae = $row['name'];
			if($language == 1){
				$lnote = "手帳";
				$lhome = "家";
				$lnewfolder = "新しい";
				$lupload = "アップロード";
				$ldelete = "削除";
				$lcreate = "保存";
			}else{
				$lnote = "Notes";
				$lupload = "Upload";
				$lnewfolder = "New folder";
				$ldelete = "delete";
				$lhome = "root folder";
				$lcreate = "save";
			}
?>