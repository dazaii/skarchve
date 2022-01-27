<?php
	require '../../includes/auth.php';
	$opt = "";

	//icons
	$playbutticon = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-play-circle'><circle cx='12' cy='12' r='10'></circle><polygon points='10 8 16 12 10 16 10 8'></polygon></svg>";
				

	$downloadicon = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-download'><path d='M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4'></path><polyline points='7 10 12 15 17 10'></polyline><line x1='12' y1='15' x2='12' y2='3'></line></svg>";

	$shareicon = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-share-2'><circle cx='18' cy='5' r='3'></circle><circle cx='6' cy='12' r='3'></circle><circle cx='18' cy='19' r='3'></circle><line x1='8.59' y1='13.51' x2='15.42' y2='17.49'></line><line x1='15.41' y1='6.51' x2='8.59' y2='10.49'></line></svg>";

	$deleteicon ="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>";

	$viewicon ="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='#4775d1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg>";

	$readicon ="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-book-open'><path d='M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z'></path><path d='M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z'></path></svg>";


	if(isset($_POST['imgid'])){
		$fid = $_POST['imgid'];
		$res = $dc->conn->query("select * from files where file_id = $fid");
		$row = $res->fetch_assoc();
		$link = $row['link'];
		$fn = $row['filename'];
		$private = $row['private'];
		$ftype = $row['filetype'];
		
		if($private == 1){
			$shareButtonStyle = "text-info";
			$sharetext = "share";
		}else{
			$shareButtonStyle = "bg-info text-white";
			$sharetext = "shared";
		}

		$opt.="
						<div class='row'>
							<div class='pb-2'>$fn</div>
							<div class='col mb-2'>";

								if($ftype == 'mp4' || $ftype == 'wav' or $ftype == 'mp3'){
							    	$opt.="<a target='_blank' href='../viewfile/?fileid=".base64_encode($fid)."' class='btn btn-white fs-11px text-info fw-bold btn-sm me-1'>$playbutticon</a>";
							    }else if($ftype == 'pdf'){
							    	$opt.="<a target='_blank' href='../viewfile/?fileid=".base64_encode($fid)."' class='btn btn-white fs-11px border border-info text-info fw-bold btn-sm me-1'>$readicon</a>";
							    }

								$opt.="
								<a href='../download/?file=".base64_encode($fid)."' class='btn btn-white fs-11px text-info fw-bold btn-sm me-1'>$downloadicon</a>
								<a href='#sharemodal' data-bs-toggle='modal' onclick='sharefilecalledfromgallery($fid)' class='btn btn-white fs-11px $shareButtonStyle fw-bold btn-sm me-1'>$shareicon</a>
								<button onclick='remfilecalledfrommodal($fid)' class='btn btn-white fs-11px text-danger fw-bold btn-sm me-1'>$deleteicon</button>
							</div>
						</div>
						";

		$opt .= "<img src='../$link' class='shashin'>";
	}
	echo json_encode($opt);
?>