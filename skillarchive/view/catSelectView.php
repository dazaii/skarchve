<?php
	$opt = "<option class='op' selected value='0'>-----</option>";
	foreach($data as $row){
		$catname = $row['c_category'];
		$c_id = $row['c_id'];
		$opt .= "<option value='$c_id'>$catname</option>";		
	}
	echo json_encode($opt);
?>
