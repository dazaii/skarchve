<?php
	require '../../includes/conn.php';
	$dc = new dbConnect();
	$opt = "";

	if(isset($_POST['fid'])){
		$fileid = $_POST['fid'];
		$sql = "select * from files where file_id = $fileid";
		$res = $dc->conn->query($sql);
		$hash = base64_encode("1-$fileid");
		$hash = preg_replace("/=/", "", $hash);
		if($res->num_rows > 0){
			$row = $res->fetch_assoc();
			if($row['private'] == 1){
				$dc->conn->query("update files set private = 0 where file_id = $fileid");
				$dc->conn->query("insert into shared(type, itsid, hash) values(1, $fileid, '$hash')");
				$opt = "<span class='fw-bold text-info fs-4'>Link sharing on</span> <br>
					<input type='text' style='font-size: 15px' value='http://dropmb.epizy.com/shirocloud/shared/$hash' class='form-control roboto-regular mt-2'>
					<a target='_blank' class='btn btn-info shinybutt text-decoration-none text-white btn-sm mt-2 float-end' href='../shared/$hash'>Follow</a>";
			}else{
				//already shared - make it private
				$dc->conn->query("update files set private = 1 where file_id = $fileid");
				$dc->conn->query("delete from shared where hash = '$hash'");
				$opt = "<span class='text-secondary'>Link sharing off</span>";
			}
		}else{
			$opt = "No such file";
		}
	}

	echo json_encode($opt,1);
?>