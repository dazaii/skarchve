<?php
	require '../../includes/auth.php';
	if(isset($_POST['tree'])){
		$treeee = $_POST['tree'];
		$opt="";
		$sql = "select * from filetree where folder_id = $treeee";
		$res = $dc->conn->query($sql);
		$count = 0;
		while($res->num_rows > 0){
			$row = $res->fetch_assoc();
			$up = $row['parent_folder'];
			$self = $row['folder_id'];
			$upname = $row['folder_name'];
			$temp="
				<button onclick='reload($self)' class='btn btn-light btn-sm rounded-0 fst-italic py-1'>$upname /</button>
			";
			$opt = $temp.$opt;

			//we override the res variable that points out to its parent folder
			//this is the reason why we used while loop along with num rows condition
			$sql = "select * from filetree where folder_id = $up";
			$res = $dc->conn->query($sql);
			$count++;
		}
		$opt = "<button onclick='reload(0)' class='text-green btn btn-white btn-sm rounded-0 fst-normal py-1'>$namae /</button>".$opt;
		echo json_encode($opt);
	}
?>