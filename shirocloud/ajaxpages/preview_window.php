<?php
	require '../../includes/auth.php';
	if(isset($_POST['tree'])){
		$treeee = $_POST['tree'];
		$opt="";
		$sql = "select * from files where parent_folder = $treeee and (filetype = 'png' or filetype = 'jpg' or filetype = 'jpeg' or filetype = 'webp' or filetype = 'gif') order by file_id";
		$res = $dc->conn->query($sql);
		$opt.="<div class='row g-0 overflow-hidden position-relative'>";
		$imgcount = 0;
		if($res->num_rows > 0){
			while($row = $res->fetch_assoc()){
				$link = $row['link'];
				$link = basename($link);
				$fid = $row['file_id'];
				$fn = $row['filename'];
				$finallink = "../uploads/riyousha$darega/thumbs/$link";
				if(!file_exists($finallink)){
					$finallink = "../uploads/riyousha$darega/$link";
				}
				// Open image as a string
				$data = file_get_contents($finallink);
				   
				// getimagesizefromstring function accepts image data as string
				$info = getimagesizefromstring($data);
				$imgwidth = $info[0];
				$imgheight = $info[1];
				$opt .= "
				<div class='imgpiccontainer'>
			    	<a href='#gallery' onclick='galleryImageBuffer($imgcount, 1, \"imageindexpreview\")' data-bs-toggle='modal'>
						<div class='shashinnoframe'>
							<input type='hidden' class='imageindexpreviewwidth' value='$imgwidth'>
							<input type='hidden' class='imageindexpreviewheight' value='$imgheight'>
							<input type='hidden' class='imageindexpreview' value='$fid'>
					    		<img class='imgpic' style='width: 100%;' src='$finallink' alt='$fn'>
						</div>
			    	</a>
				</div>
				";
				$imgcount++;
			}
		}
		$opt.="</div>";
		echo json_encode($opt);
	}
?>