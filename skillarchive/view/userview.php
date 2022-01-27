<?php
	$opt = "";
	foreach($data as $row){
		$opt .= "<div class='px-4'>".$row['category_name']."</div>";		
	}
	echo json_encode($opt);
?>
