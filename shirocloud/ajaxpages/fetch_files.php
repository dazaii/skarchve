<?php
	require '../../includes/auth.php';
	if(isset($_POST['tree'])){
		$treeee = $_POST['tree'];
		$opt="";
		$sql = "select * from files where parent_folder = $treeee and ownerid = $darega and !(filetype = 'jpg' or filetype = 'png' or filetype = 'gif' or filetype = 'webp' or filetype = 'jpeg') order by file_id";
		$res = $dc->conn->query($sql);
		$stripe = 0;

		$imgcount = 0;
		if($res->num_rows > 0){
			$makeit = 0;
			while($row = $res->fetch_assoc()){
				$filename = $row['filename'];


				$link = $row['link'];
				$fid = $row['file_id'];
				$private = $row['private'];
				$ftype = $row['filetype'];
				$showhide = "drop"."$makeit";
				$fileicon = "";
				
				$filename = strtok(wordwrap($filename, 50, "..."), "...");
				
				//file icons
				if($ftype == 'wav' or $ftype == 'mp3'){
					$fileicon = "<svg class='fileicon' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='#02d9c9' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-music'><path d='M9 18V5l12-2v13'></path><circle cx='6' cy='18' r='3'></circle><circle cx='18' cy='16' r='3'></circle></svg>";
				}else if($ftype == 'png' || $ftype == 'webp' || $ftype == 'jpg' || $ftype == 'jpeg'){
					$fileicon = "<svg class='fileicon' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='#4775d1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg>";
					//continue;
					//images are hidden in file list because we can access it through preview gallery
				}
				else if($ftype == 'mp4'){
					$fileicon = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='#f95289' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-film'><rect x='2' y='2' width='20' height='20' rx='2.18' ry='2.18'></rect><line x1='7' y1='2' x2='7' y2='22'></line><line x1='17' y1='2' x2='17' y2='22'></line><line x1='2' y1='12' x2='22' y2='12'></line><line x1='2' y1='7' x2='7' y2='7'></line><line x1='2' y1='17' x2='7' y2='17'></line><line x1='17' y1='17' x2='22' y2='17'></line><line x1='17' y1='7' x2='22' y2='7'></line></svg>";
				}
				else{
					$fileicon = "<svg class='fileicon' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file'><path d='M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z'></path><polyline points='13 2 13 9 20 9'></polyline></svg>";
				}

				//sonohoka no icons
				$playbutticon = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-play-circle'><circle cx='12' cy='12' r='10'></circle><polygon points='10 8 16 12 10 16 10 8'></polygon></svg>";
				

				$downloadicon = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-download'><path d='M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4'></path><polyline points='7 10 12 15 17 10'></polyline><line x1='12' y1='15' x2='12' y2='3'></line></svg>";

				$shareicon = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-share-2'><circle cx='18' cy='5' r='3'></circle><circle cx='6' cy='12' r='3'></circle><circle cx='18' cy='19' r='3'></circle><line x1='8.59' y1='13.51' x2='15.42' y2='17.49'></line><line x1='15.41' y1='6.51' x2='8.59' y2='10.49'></line></svg>";

				$deleteicon ="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>";

				$viewicon ="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='#4775d1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg>";

				$readicon ="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-book-open'><path d='M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z'></path><path d='M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z'></path></svg>";

				if($private == 1){
					$shareButtonStyle = "text-info";
					$sharetext = "share";
				}else{
					$shareButtonStyle = "bg-info text-white";
					$sharetext = "shared";
				}

				if($stripe % 2 == 0){ $bg = "bg-light";} else{ $bg="bg-white";}
					$opt.="
						<div class='row align-items-center'>
							<div class='col'>
								<button data-bs-toggle='collapse' style='font-size: 14px; font-family: arial' data-bs-target='.$showhide' class='btn btn-white text-dark text-start w-100 btn-sm rounded-0 p-1'>
								$fileicon
								$filename<span style='color:skyblue' class='float-end ms-1'>$ftype</span></button>
							</div>
						</div>
						<div class='row'>
							<div class='col mt-2 collapse $showhide'>
								&nbsp;&nbsp;&nbsp;&nbsp;";

								if($ftype == 'mp4' || $ftype == 'wav' or $ftype == 'mp3'){
							    	$opt.="<a target='_blank' href='../file/".base64_encode($fid)."' class='btn btn-white fs-11px text-info fw-bold btn-sm me-1'>$playbutticon</a>";
							    }else if($ftype == 'png' ||$ftype == 'webp' || $ftype == 'jpg' || $ftype == 'jpeg'){
							    	$opt.="
							    	<input type='hidden' class='imageindex' value='$fid'>
							    	<button onclick='galleryImageBuffer($imgcount, 1, \"imageindex\")' data-bs-toggle='modal' data-bs-target='#gallery' class='btn btn-white fs-11px text-info fw-bold btn-sm me-1'>$viewicon</button>";
							    	$imgcount++;
							    }else if($ftype == 'pdf'){
							    	$opt.="<a target='_blank' href='../file/".base64_encode($fid)."' class='btn btn-white fs-11px border border-info text-info fw-bold btn-sm me-1'>$readicon</a>";
							    }

								$opt.="
								<a href='../download/?file=".base64_encode($fid)."' class='btn btn-white fs-11px text-info fw-bold btn-sm me-1'>$downloadicon</a>
								<a href='#sharemodal' data-bs-toggle='modal' onclick='sharefile($fid)' class='btn btn-white fs-11px $shareButtonStyle fw-bold btn-sm me-1'>$shareicon</a>
								<button onclick='remfile($fid)' class='btn btn-white fs-11px text-danger fw-bold btn-sm me-1'>$deleteicon</button>
							</div>
						</div>
						";
				$stripe++;
				$makeit++;
			}
		}
		echo json_encode($opt);
	}
?>