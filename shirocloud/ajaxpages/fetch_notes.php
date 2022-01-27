<?php
	require '../../includes/auth.php';
	require '../../includes/svgs.php';
	if(isset($_SESSION['kotoba'])){
		$uid = $_SESSION['kotoba'];
		$opt = "";
		$sql = "select * from notes where owner = $uid order by note_id DESC";
		$res = $dc->conn->query($sql);
		$count = 0;
		if($res->num_rows > 0){
			while($row = $res->fetch_assoc()){
				$count = rand(1,3);
				$title = $row['title'];
				$content = $row['content'];
				$noteid = $row['note_id'];

				if($count == 1) $style = "bg-emerald text-white";
				else if($count == 2) $style = "bg-white border text-dark";
				else $style = "bg-violet text-white";
				$opt .="
				<div class='col-6 col-md-3 p-1 m-0'>
					<div class='$style shadow-sm roundnotes p-4'>
						<div class=''>
							<button onclick='remNote($noteid)' style='z-index:1; position: absolute; bottom: 10px; right: 55px; color: #9ae' class='btn btn-sm delete float-end bg-white rounded-pill'>

								<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>

							</button>
							<button onclick='viewNote($noteid)' data-bs-toggle='modal' data-bs-target='#viewNote' style='z-index:1; position: absolute; bottom: 10px; right: 10px; color: #9ae' class='btn btn-sm delete float-end bg-white rounded-pill'>
								<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-3'><path d='M12 20h9'></path><path d='M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z'></path></svg>
							</button>
						</div>
						<h4 class='roboto-black'>$title</h4>
						<pre class='roboto-regular' style='max-height: 150px; font-size: 16px; overflow: hidden;'>$content</pre>
					</div>
				</div>
				";
				$count++;
			}
		}else{
			$opt .= "
			<div class='p-5 text-info　text-center'>何もです、新しいにして</div>
			";
		}
	}
	echo json_encode($opt);
?>