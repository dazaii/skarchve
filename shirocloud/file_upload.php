<?php
	require '../includes/auth.php';


	function createThumbnail($source, $dest, $stype){
		$nw = 150;    //New Width
		//$nh = 100;    //new Height

		$size = getimagesize($source);
		$w = $size[0];    //Images width
		$h = $size[1];    //Images height

		//set new height according to original image ratio
		$sizeRatio = $w/$h;
		$nh = $nw / $sizeRatio;

		switch($stype) {
		    case 'gif':
		    $simg = imagecreatefromgif($source);
		    break;
		    case 'jpg':
		    $simg = imagecreatefromjpeg($source);
		    break;
		    case 'png':
		    $simg = imagecreatefrompng($source);
		    break;
		    case 'webp':
		    $simg = imagecreatefromwebp($source);
		    break;
		}

		$dimg = imagecreatetruecolor($nw, $nh);
		
			     imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);

		imagejpeg($dimg,$dest,100); 
	}

$opt = "default";
	if(!empty($_FILES["korefiledane"]["name"])){
		$cf = $_POST['currentdir'];
		$checkdir = "uploads/riyousha$darega/";
		if(!file_exists($checkdir)){
			mkdir($checkdir, 0777);
		}
		$checkdir = "uploads/riyousha$darega/thumbs/";
		if(!file_exists($checkdir)){
			mkdir($checkdir, 0777);
		}

		$dir = "uploads/riyousha$darega/$cf-";
		// I added cf to know who is its parent_folder
		$pathandfile = $dir.$_FILES["korefiledane"]["name"];
		//removes aphostrophes
		$pathandfile = str_replace("'", '', $pathandfile);
		$filetype = pathinfo($pathandfile, PATHINFO_EXTENSION);
		$filetype = strtolower($filetype);
		$fullname = $_FILES["korefiledane"]["name"];
		$file_name = $fullname;
		$filesize = $_FILES['korefiledane']['size'];
		if($filetype == ""){$filetype == "nani";}
		
		if(file_exists($pathandfile)){
			//echo "file exists";
		}else if(1){
			if($filesize < 50000000){
				if(move_uploaded_file($_FILES['korefiledane']['tmp_name'], $pathandfile)){
					//echo "upload success";
					$stmt = $dc->conn->prepare("insert into files (filename, link, parent_folder, filetype, ownerid) values(?, ?, ?, ?, ?)");
					$stmt->bind_param("ssisi",$file_name, $pathandfile, $cf, $filetype, $darega);
					$stmt->execute();
					
					if($filetype == "jpg" ||$filetype == "gif" ||$filetype == "png" || $filetype == "webp"){
						createThumbnail($pathandfile, $checkdir."$cf-".$fullname, $filetype);
					}
				}else{
					//
				}
			}else{
				//
			}
		}
	}
	echo json_encode($opt);
?>