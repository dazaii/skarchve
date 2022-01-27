<?php
	$opt = "";

	//icons
	$patch = "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-patch-check-fill' viewBox='0 0 19 19'>
		  <path d='M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z'/>
		</svg>";
	$heartfill = "
			<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-heart-fill' viewBox='0 0 16 10'>
			  <path fill-rule='evenodd' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z'/>
			</svg>
			";
	$heart = "
			<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-heart' viewBox='0 0 16 16'>
			  <path d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z'/>
			</svg>
			";
	$chat = "
			<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-chat' viewBox='0 0 16 16'>
			  <path d='M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z'/>
			</svg>
			";
	$pen = "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 28' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 editposticon'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>";

	$trash = "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 28' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>";

	foreach ($data as $row) {
		$content = $row['s_content'];
		$title = $row['s_title'];
		$id = $row['s_id'];
		$d = $row['created'];
		$d = strtotime($d);
		$stringdate = strftime("%I:%M %p &nbsp;&nbsp; %b %e, %Y",$d);
		$catname = $row['c_category'];
		$catid = $row['c_id'];
		$catname = strtolower($catname);
		$opt .= "
		<div class='col-12 nfContent'>
			<div class='nfFade'>
			</div>
			<button onclick='seeMore(this);this.parentElement.style.maxHeight = \"unset\"' class='nfContentSeeMore rounded'>
				<u>SEE MORE</u> <svg width='16' height='16' fill='currentColor' class='bi bi-chevron-down' viewBox='0 0 16 16'>
					  <path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/>
					</svg>
			</button>
			<div class='row mb-2 p-2 '>
				<div class='col-12'>
					<div class='row justify-content-between'>
						<span class='fs-5 col-auto'>春人</span>
						<div class='col-auto dropstart'>
							<svg data-bs-toggle='dropdown' class='col-auto' style='margin-top: 8px;' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-three-dots' viewBox='0 0 16 16'>
							  <path d='M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z'/>
							</svg>
							<ul class='dropdown-menu fs-13px'>
								<li><a onclick='deleteFromArchive($id)' href='#' class='dropdown-item'>$trash Delete</a></li>
							</ul>

						</div>
						<div class='col-auto'>
							<a href='#' onclick='getContents($id)' class='dropdown-item edit-post'>$pen</a>
						</div>
					</div>
				</div>
				<div class='text-secondary fs-14px pb-2' style='margin-top: -6px;'><a href='#' style='cursor: pointer;' onclick='viewByCategory($catid)'>@$catname</a>
					<span class='themeColor'>$patch</span>
				</div>

				<div class='col-12' style='overflow-x: auto'>$content</div>
				<div class='fs-10px pt-3 roboto-light fw-bold' style='color: #888;'>$stringdate</div>
				<div class='row justify-content-start g-0 align-items-center py-2 px-3'>
					<div class='col-auto'>$id $heart</div>
					<div class='col-auto ms-2' style='margin-top: -2px;'>$chat</div>
				</div>
			</div>
		</div>
		";
	}
	if(isset($plainnotjson)){
		echo $opt;
	}else{
		echo json_encode($opt);
	}
?>