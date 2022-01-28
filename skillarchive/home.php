<?php
	require '../includes/auth.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name='viewport' content='width-device-width, initial-scale=1, maximum-scale=1'>
		<title>Skillarchive</title>
		<link rel='icon' href='../../lib/icons/cloud.png'>
		<link rel='stylesheet' type='text/css' href='../../lib/css/bootstrap.css'>
		<link rel='stylesheet' type='text/css' href='../../lib/css/iro.css'>
		<link rel='stylesheet' type='text/css' id="theme" href=''>
		<script type="text/javascript" src="../../lib/js/jquery.js"></script>
		<style type="text/css">
			*{
				font-family: robotoslabreg;
			}
			a{
				color: #1B9DA7;
				text-decoration: none;
			}
			/*
			strong, b{
				font-family: typewritter;
			}
			*/
			a:hover{
				color: #9F5D54;
			}

		</style>
	</head>
	<?php 
		require '../includes/svgs.php';
		require 'view/modals/homeModals.php';
	?>
<body class="roboto-light" style="background: #FCEFD9;">
	<span class="loader"><span class="loader-inner"></span></span>
  	<div class="loadingContainer rounded-pill">
  		<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
  	</div>
	<div class="container-fluid" style="position: absolute; height: 100%">
		<div class="row position-relative justify-content-center h-100">
			<div class="navigator col-md-1 col-1" style="border-right: solid 1px #f5f5f5; user-select: none;">
				<div class="row py-2 text-center">
					<div class="col-12">Growth as always</div>
				</div>
				<div class="row navigatorContainer gy-1 align-items-center justify-content-center">
					<div class="col-2 col-md-12 py-1 px-2 navitemcontainer text-center">
						<a class="overflow-hidden text-dark navitem" href="../../shirocloud/cloud/"><?php cloudicon(); ?></a>
					</div>
					<div class="col-2 col-md-12 py-1 px-2 navitemcontainer text-center rounded-pill">
						<a class="overflow-hidden themeColor navitem" href="1"><span><?php skilliconfill(); ?></span></a>
					</div>
					<div class="col-2 col-md-12 py-1 px-2 navitemcontainer text-center rounded-pill">
						<a onclick="scrolltop()" class="overflow-hidden text-dark navitem" data-bs-target="#mydContainer" data-bs-toggle="collapse"><?php posticon(); ?></a>
					</div>
					<div class="col-2 col-md-12 py-1 px-2 navitemcontainer text-center rounded-pill">
						<a onclick="catOnFeed()" class="overflow-hidden text-dark navitem"><?php categoryicon(); ?></a>
					</div>
					<div class="col-2 col-md-12 py-1 px-2 navitemcontainer text-center rounded-pill">
						<a onclick="autofocusSIPT()" data-bs-target="#searchModal" data-bs-toggle="modal" class="overflow-hidden text-dark navitem"><span><?php searchicon(); ?></span></a>
					</div>
					<div class="col-2 col-md-12 py-1 px-2 navitemcontainer text-center rounded-pill">
						<a class="overflow-hidden text-dark navitem" href="#" onclick="openPreferences()"><?php logouticon(); ?></a>
					</div>
				</div>
			</div>
			<div class="col-md-10 col-12 h-100 contentBody">
				<div class="row">
					<div class="col-12 col-md-8 border-bottom-0 border-top-0">
						<div class="row collapse p-2" id="mydContainer">
							<div class="col-12">
								<div class="row justify-content-center">
									<input type="text" spellcheck="false" id="createTitle" class="w-100 border-0 fs-5 p-1" placeholder="Title" style="outline: 0; background-color: transparent;">
									
								<div id="myd" spellcheck="false" onfocus="scrolldame()" onfocusout="scrolldouzo()" contenteditable="true" class="contentEdit p-4 mt-1 border-0">
								<font size="5">SHIAWASE</font>
								<div><font size="3">nakisetsu</font></div>
								</div>
								</div>
								<div class="row user-select-none p-0 justify-content-center align-items-center">
									<div class="col-auto text-info">

										<button class="richTextToggles" onclick="insertTab()">
											<?php tabicon(); ?>
										</button>
										<button class="richTextToggles" onclick="clearText()">
											<?php erasericon(); ?>
										</button>
										<button class="richTextToggles" onclick="sizedown()">
											<?php sizedownicon(); ?>
										</button>
										<button class="richTextToggles" onclick="sizeup()">
											<?php sizeupicon(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('outdent')">
											<?php outdenticon(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('indent')">
											<?php indenticon(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('underline')">
											<?php underlineicon(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('strikethrough')">
											<?php strikethroughicon(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('italic')">
											<?php italicicon(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('bold')">
											<?php boldicon(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('insertorderedlist')">
											<?php orderedlist(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('insertunorderedlist')">
											<?php unorderedlist(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('justifyLeft')">
											<?php justifyleft(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('justifyFull')">
											<?php justify(); ?>
										</button>
										<button class="richTextToggles" onclick="addLink()">
											<?php linkicon(); ?>
										</button>
										<button class="richTextToggles" id="likescount" onclick="choosetoembed()">
											<?php linkicon(); ?>
										</button>
										<button class="richTextToggles" onclick="newCode()">
											<?php codeicon(); ?>
										</button>
										<button class="richTextToggles" onclick="newQoute()">
											<?php quoteicon(); ?>
										</button>
										<button class="richTextToggles" onclick="includepost()">
											<?php quoteicon(); ?>
										</button>
										<button class="richTextToggles" onclick="newLine()">
											<?php linebreakicon(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('undo')">
											<?php undoicon(); ?>
										</button>
										<button class="richTextToggles" onclick="toggle('redo')">
											<?php redoicon(); ?>
										</button>
										<button class="richTextToggles" onclick="highLight('yellow')">
											<?php highlighticon(); ?>
										</button>
										<button class="richTextToggles" onclick="highLight('pink')">
											<?php highlighticon(); ?>
										</button>
										<button class="richTextToggles" onclick="highLight('#5ef')">
											<?php highlighticon(); ?>
										</button>
										<button class="richTextToggles" onclick="highLight('turquoise')">
											<?php highlighticon(); ?>
										</button>
										<button class="richTextToggles" onclick="highLight('#C6C1B8')">
											<?php highlighticon(); ?>
										</button>
										<button class="richTextToggles" onclick="newDot('#C6C1B8')">
											・										</button>
										<select class="formselect" style="background-color: transparent; color: #555555;padding: 5px;" onchange="changeFontSize(this.value)">
											<option value="1">--</option>
											<option value="1">1pt</option>
											<option value="2">2pt</option>
											<option value="3">3pt</option>
											<option value="4">4pt</option>
											<option value="5">5pt</option>
											<option value="6">6pt</option>
											<option value="7">7pt</option>
											<option value="8">8pt</option>
										</select>

									</div>
								</div>
								<div class="row px-2 mt-2 align-items-center justify-content-between">
									<select style="background-color: transparent;" id="selectcat" class="formselect2 col-8">
									</select>
									<button onclick="addToArchive()" id="editorSubmitBtn" class="btn btn-sm col-auto roboto-regular fs-13px float-end text-white rounded-sm themeColorBg">
										<?php journalcheck(); ?> <span style="display: inline-block; position: relative; top: 1px;">ARCHIVE</span>
									</button>
								</div>
							</div>
						</div>
						<div class="row p-0 pt-2" style="font-family: roboto;" id="nf">
							<?php
								if(!isset($_GET['page'])){
									$page = 1;
								}else{
									$page = $_GET['page'];
								}
								$level = 0;
								$plainnotjson = 1;
								require_once 'model/homemodel.php';
								$obj = new HomeModel();
								$data = $obj->viewPosts($page);
								include_once 'view/nfView.php';
							?>
						</div>
						<div class="row">
							<div class="pt-4 pb-4 col-12">
								<?php
									$itemperpage = $obj->getItemsPerPage();
									$tot = $obj->getTotal();
									if($tot <= $itemperpage){

									}else{
									    $paginationItems = $obj->getPages();
										$next = $page + 1;
										$prev = $page - 1;
										$nextdisabled = "";
										$prevdisabled = "";
										$pactivecolor = "themeColor";
										$nactivecolor = "themeColor";
										if($page >= $paginationItems){
											$nextdisabled = "disabled";
											$nactivecolor = "";
										}
										if($page <= 1){
											$prevdisabled = "disabled";
											$pactivecolor = "";
										}
										echo "
										<nav aria-label='Page navigation example'>
										    <ul class='pagination pagination-sm m-0 justify-content-center'>
										    <li class='page-item $prevdisabled'>
										      <a class='page-link $pactivecolor' href='$prev' tabindex='-1'>Previous</a>
										    </li>
										    ";
										    $limit = 4;
										    $totalButtons = ($limit*2)+1;
										    $start = ($page <= $limit)?1:$page-$limit;
										    for($i=$start;$i<=$paginationItems && ($i-$start)+($page-$start)<=$totalButtons;$i++){
												if($page == $i){
													echo "<li class='page-item'><a class='themeColorBg text-white page-link' href='$i'>$i</a></li>";
												}else{
													echo "<li class='page-item'><a class='page-link themeColor' href='$i'>$i</a></li>";
												}
											}

										    echo "
										    <li class='page-item $nextdisabled'>
										      <a class='page-link $nactivecolor' href='$next'>Next</a>
										    </li>
										  </ul>
										</nav>
										";
									}
								?>
								
							</div>
						</div>
					</div>
					<div class="col-md-4 p-2 col-12 responsiveborders d-none d-md-block" style="position: fixed; right: 0; top:0">
						<div id="ai"></div>
						<div id="timeline" class="row g-0 p-0"></div>				
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
		require '../includes/footer.php';
	?>
	<script src="../scripts/controllerscript.js"></script>
	<script src="../scripts/richTextController.js"></script>
	<script>
		setInterval(loadtime, 1000);
		function loadtime(){
			//time
			var timeElement = document.getElementById("timeview");
			var dateElement = document.getElementById("dateview");
			const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
			const months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
			const d = new Date();
			var hour = d.getHours();
			var mins = d.getMinutes();
			var seconds = d.getSeconds();
			mins = (mins<10)?"0"+mins:mins;
			seconds = (seconds<10)?"0"+seconds:seconds;
			var am = ((hour>=12)?false:true)?"AM":"PM";

			hour = (hour%12==0)?12:hour%12;
			timeElement.innerHTML = hour+":"+mins+":"+seconds+" "+am+"<div id='dateview' class='col-auto'>"+days[d.getDay()]+" "+months[d.getMonth()]+" "+d.getDate()+"</div>";
		}

	</script>
</body>
</html>