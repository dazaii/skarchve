<?php
	require '../../includes/auth.php';
	$opt = "";
	if(isset($_SESSION['kotoba'])){
		$uid = $_SESSION['kotoba'];
		$noteid = $_POST['noteid'];
		$sql = "select * from notes where note_id = $noteid";
		$res = $dc->conn->query($sql);
		$row = $res->fetch_assoc();
		$title = $row['title'];
		$content = $row['content'];
		$noteid = $row['note_id'];
		$opt="
		<div class='row justify-content-between align-items-center g-4'>
        	<div class='col-12'>
        		<input placeholder='Title' type='text' id='viewnoteTitle' value='$title' class='form-control border-0 bg-white fs-4' autofocus>
        		<input type='hidden' id='viewnoteId' value='$noteid'>
        	</div>
        </div>
        <div class='row align-items-center'>
        	<div class='col-12'>
        		<textarea id='viewnoteContent' class='bg-white border-0 roboto-regular col-12 form-control' placeholder='何が？'>$content</textarea>
        	</div>
        </div>
		";
	}
	echo json_encode($opt);
?>