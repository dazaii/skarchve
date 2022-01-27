<?php
	$pen = "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 28' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>";

	$trash = "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 28' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>";

	$view = "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-view-list' viewBox='0 0 16 18'>
		  <path d='M3 4.5h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1H3zM1 2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 2zm0 12a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 14z'/>
		</svg>";


		

	$opt = "<div class='col-12'>
							<div class='fs-14px g-0 row pb-1 justify-content-between align-items-center fw-light'>
								<div id='timeview' class='col-auto fw-light'>春人天川</div>
								
								<a data-bs-toggle='modal' onclick='autofocusAddCatName()' href='#addCatModal' class='col-auto'>
									<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus-lg' viewBox='0 0 16 16'>
									  <path d='M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z'/>
									</svg>
								</a>
							</div>
						</div>";

	foreach($data as $row){
		$catid = $row['c_id'];
		$opt .= "
		<div class='col-12'>
			<div class='row rounded g-0 justify-content-between'>
				<div onclick='viewByCategory($catid)' style='cursor: pointer' class='px-4 py-1 fs-13px col-auto'>

				<svg width='20' height='20' fill='currentColor' class='themeColor bi bi-patch-check-fill' viewBox='0 0 16 19'>
				  <path d='M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z'/>
				</svg>
				<a href='#' class='catHover'>".$row['c_category']."</a></div>
				<div class='col-auto fs-13px dropdown py-1'>
					<a href='#' class='fs-12px me-2 text-dark' data-bs-toggle='dropdown'>
						<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-three-dots' viewBox='0 0 16 16'>
						  <path d='M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z'/>
						</svg></a>
					<ul class='dropdown-menu fs-13px'>
						<li><a href='#renameCatModal' data-bs-toggle='modal' onclick='getCatContents($catid)' class='dropdown-item'>$pen Rename</a></li>
						<li><a href='#deleteCatModal' data-bs-toggle='modal' onclick='getCatContentsForRemoval($catid)' class='dropdown-item'>$trash Delete</a></li>
						<li><a href='#' onclick='viewByCategory($catid)' class='dropdown-item'>$view View archive</a></li>
					</ul>
				</div>

			</div>
		</div>
		";		
	}
	echo json_encode($opt);
?>
