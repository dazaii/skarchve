<?php
	function recursiveDelete($fid){
		$d = new dbConnect();
		$sql = "select * from filetree where parent_folder = $fid";
		$res=$d->conn->query($sql);
		if($res->num_rows > 0){
			while($row = $res->fetch_assoc()){
				$fid2 = $row['folder_id'];
				$fname = $row['folder_name'];
				recursiveDelete($fid2);

				//delete files before folders
				$sqlfilerem = "select * from files where parent_folder = $fid2";
				$resfilerem = $d->conn->query($sqlfilerem);
				while($rowfilerem = $resfilerem->fetch_assoc()){
					$fileid = $rowfilerem['file_id'];
					$filetype = $rowfilerem['filetype'];
					$d->conn->query("delete from files where file_id = $fileid");
					$d->conn->query("delete from shared where itsid = $fileid and type=1");
					$file_link = "../".$rowfilerem['link'];
					unlink($file_link);

					//delete thumbnail if it is an images
					if($filetype == "jpg" ||$filetype == "gif" ||$filetype == "png" || $filetype == "webp"){
						$path = "../uploads/riyousha$darega/thumbs/".basename($file_link);
						unlink($path);
					}

				}
				//deleting folder
				$sqlrem = "delete from filetree where folder_id = $fid2";
				$d->conn->query($sqlrem);
			}
		}
	}
	main();
	function main(){
		require '../../includes/auth.php';
		if(isset($_POST['folderid'])){
			$folderid = $_POST['folderid'];
			$currentfolder = $_SESSION['currentfolderr'];	//retrieves the current folder id
			$GLOBALS['opt'] = $currentfolder;
			recursiveDelete($folderid);

			//delete files before the folder
			$sqlfilerem = "select * from files where parent_folder = $folderid";
			$resfilerem = $dc->conn->query($sqlfilerem);
			while($rowfilerem = $resfilerem->fetch_assoc()){
				$fileid = $rowfilerem['file_id'];
				$filetype = $rowfilerem['filetype'];
				$dc->conn->query("delete from files where file_id = $fileid");
					$dc->conn->query("delete from shared where itsid = $fileid and type=1");
				$file_link = "../".$rowfilerem['link'];
				unlink($file_link);

				//delete thumbnail if it is an images
				if($filetype == "jpg" ||$filetype == "gif" ||$filetype == "png" || $filetype == "webp"){
					$path = "../uploads/riyousha$darega/thumbs/".basename($file_link);
					unlink($path);
				}
			}
			//deleting selected folder
			$sqlrem = "delete from filetree where folder_id = $folderid";
			$dc->conn->query($sqlrem);
		}
	}
	echo json_encode($opt);
?>