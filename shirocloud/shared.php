<?php
?>
<!DOCTYPE html>
<html>
	<?php
		require '../includes/conn.php';
		$dc = new dbConnect();
		if(!isset($_SESSION['currentsharedfolder'])){
			$_SESSION['currentsharedfolder'] = 0;
		}
		if(isset($_GET['attachment'])){
			$token = $_GET['attachment'];
			$token = base64_decode($token);
			$info = strtok($token, "-");
			$type = $info;
			$info = strtok("-");
			$id = $info;


			$sql = "select * from files where file_id = $id";
			if($res = $dc->conn->query($sql)){
				if($res->num_rows > 0){
					$row = $res->fetch_assoc();
					$naame = $row['filename'];
					$ttype = $row['filetype'];
				}
			}
		}else{
			die("<div class='p-5 text-center roboto-light fw-bold fs-5 text-warning'>Invalid url</div>");
		}
	?>
<head>
	<meta name='viewport' content='width-device-width, initial-scale=1'>
	<meta name='description' content='Shared <?php echo$ttype; ?> file'>
	<title>Dropmb｜<?php echo$naame; ?></title>
	<link rel='stylesheet' type='text/css' href='../../lib/css/bootstrap.css'>
	<link rel='stylesheet' type='text/css' href='../../lib/css/iro.css'>
	<link rel='icon' href='../../lib/icons/cloud-link.png'>
	<script type='text/javascript' src='../../lib/js/jquery.js'></script>
</head>
<body class="roboto-light bg-light">
	<div class="container mt-2">
		<div class="row">
			<div class="col-md-12">
				<div style="min-height: 500px" class="p-4 bg-white rounded-3 shadow-sm">
					<div class="row align-items-center justify-content-between">
						<div class="col-auto mb-2 mb-md-0">
							<span style="cursor: default;" class="fs-3 text-white bg-info px-2 rounded-3 shinybutt roboto-light fw-bold float-start">
							<svg style='margin-top: -5px' width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download-cloud"><polyline points="8 17 12 21 16 17"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"></path></svg>
							Shirocloud</span>
						</div>
						<div class="col-auto">
							<div>Guest</div>
						</div>
					</div>
					
					<?php
					if($type == 1){
						//the type is file
						$sql = "select * from files where file_id = $id";
						if($res = $dc->conn->query($sql)){
							if($res->num_rows > 0){
								$row = $res->fetch_assoc();
								$name = $row['filename'];
								$file = $row['link'];
								$ftype = $row['filetype'];
								$private = $row['private'];
								if(!$private){
									echo "
										<div class='mt-2 row'>
											<div class='col-12 text-center fs-5'>
												$name
											</div>
											<div class='col-12 text-center mt-4'>
											<a onclick='startDownload()' href='../download/?file=".base64_encode($id)."' class='btn overflow-hidden bg-info border-0 text-white fw-bold py-3 ps-5 pe-4 fs-12px'>
												<span class='shinybutt pe-4' id='downloadLabel'>Download
												</span>
												<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 25' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-arrow-down'><line x1='12' y1='5' x2='12' y2='19'></line><polyline points='19 12 12 19 5 12'></polyline></svg>
											</a>

											";
											if($ftype == "jpg" ||$ftype == "webp" || $ftype == "png" || $ftype == "jpeg"){
									            echo "
									            <div class='row mt-4 align-items-center justify-content-center bg-light'>
									                <img src='../$file' class='col-12' alt='$name'>
									            </div>";
									        }else if($ftype == "wav" || $ftype == "mp3"){
									            require '../includes/header.php';
									            echo "
                                    <div class='row align-items-center justify-content-center'>
                                        <audio preload='auto' id='mymusic' class='col-10 col-md-6' loop autoplay>
                                            <source src='../$file'>
                                        </audio>
                                    </div>
                                    <div class='row justify-content-center align-items-center'>
                                        <div class='col-12 text-center'>
                                            <button id='playbutt' onclick='play()' src='../lib/icons/pause-circle.svg'>
                                                <svg width='100%' height='100%' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-play-circle'><circle cx='12' cy='12' r='10'></circle><polygon points='10 8 16 12 10 16 10 8'></polygon></svg>
                                            </button>
                                        </div>
                                        <input type='range' step='0.2' class='col-11 col-md-6' id='tracktime' min='0.00' value='0.00'>
                                        <div class='w-100'></div>
                                        <span id='duration' class='text-secondary text-center col-11 col-md-6 mt-2'>0:00</span>
                                    </div>
                                    <br><br>

                                    ";

									        }else if($ftype == "mp4"){
									            require 'includes/header.php';
									            echo "
									            <div class='row align-items-center mt-2 justify-content-center bg-white'>
									                <div class='container'>
									                    <div class='row justify-content-center align-items-center'>
									                        <div class='col-12 col-md-6'>
									                            <video preload='auto' controls style='width: 100%; max-height: 500px'>
									                                <source src='../$file' type='video/mp4'>
									                            </video>
									                        </div>
									                    </div>
									                </div>
									            </div>";
									        }else if($ftype == 'pdf'){
												echo "<a href='../viewfile/?fileid=".base64_encode($id)."' class='btn border-info text-info m-1'>View</a>";
									        }
									        ?>

<script type="text/javascript">

    var playbtn = "<svg width='100%' height='100%' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-play-circle'><circle cx='12' cy='12' r='10'></circle><polygon points='10 8 16 12 10 16 10 8'></polygon></svg>";
    var pausebtn = "<svg width='100%' height='100%' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-pause-circle'><circle cx='12' cy='12' r='10'></circle><line x1='10' y1='15' x2='10' y2='9'></line><line x1='14' y1='15' x2='14' y2='9'></line></svg>";

    var a = document.getElementById("mymusic");
    var currentime = document.getElementById("duration");
    var playbutt = document.getElementById("playbutt");
    var mutebutt = document.getElementById("mute");
    var tracktime = document.getElementById("tracktime");
    a.onpause = function(){
        playbutt.innerHTML = playbtn;
    }
    a.onplaying = function(){
        playbutt.innerHTML = pausebtn;
    }

    var ishovering = 0;
    tracktime.onmouseover = function(){
        ishovering = 1;
    }
    tracktime.onmousemove = function(){
        ishovering = 1;
    }
    tracktime.onmouseup = function(){
        ishovering = 1;
        updatetracktime();
    }
    tracktime.onmouseout = function(){
        ishovering = 0;
    }

    //for touch screen
    tracktime.ontouchmove = function(){
        ishovering = 1;
        updatetracktime();
    }
    tracktime.onclick = function(){
        ishovering = 1;
        updatetracktime();
    }
    tracktime.onchange = function(){
        ishovering = 1;
        updatetracktime();
    }
    tracktime.ontouchstart = function(){
        ishovering = 1;
        updatetracktime();
    }
    tracktime.ontouchend = function(){
        ishovering = 0;
    }
    a.addEventListener("timeupdate", updatetime);
    function updatetracktime(){
        if(a.readyState >= 1){
            var position = tracktime.value;
            var finalpos = a.duration * ((position)/100);
            if(a.paused){
                a.currentTime = finalpos;
                a.pause();
            }else{
                a.currentTime = finalpos;
                a.play();
            }
        }
    }
    function updatetime(){
        if(ishovering){
	        var seconds = (a.currentTime % 59).toFixed(0);
	        if(seconds<10){seconds = "0"+seconds;}
	        currentime.innerHTML = parseInt((a.currentTime)/59) +":"+ seconds;
            ishovering = 0;
        }
        else updateprogress();
    }
    function updateprogress(){
        var seconds = (a.currentTime % 59).toFixed(0);
        if(seconds<10){seconds = "0"+seconds;}
        currentime.innerHTML = parseInt((a.currentTime)/59) +":"+ seconds;
        tracktime.value = (a.currentTime/a.duration)*100;
    }

    function play(){
        if(a.paused){
            a.play()
            playbutt.innerHTML = playbtn;
        }
        else{
            a.pause();
            playbutt.innerHTML = pausebtn;
        }
    }

    function mute(){
        if(a.muted){
            a.muted = false;
            mutebutt.innerHTML = "mute";
        }
        else{
            a.muted = true;
            mutebutt.innerHTML = "unmute";
        }
    }
    function startDownload(e){
    	$("#downloadLabel").html("Downloading");
    }


</script>



                                        <?php

									echo"
											<div>
										</div>
									";
								}else{
									echo "<div class='p-5 text-warning roboto-regular'>Private file<div>";
								}
							}else{
								echo "<div class='p-5 text-danger roboto-regular'>File not found<div>";
							}
						}else{
							echo "<div class='p-5 text-center fw-bold fs-5 text-warning'>Invalid url</div>";
						}
					
					}else{
						echo "<div class='p-5 text-center fw-bold fs-5 text-warning'>Invalid url</div>";
					}
					/*
					else{
						echo "
						<div id='miset' class='mt-2 mt-md-0 fst-italic'>
						<button style='color: red;' class='btn btn-light fs-6 btn-sm rounded-0 fst-normal py-1'>太宰 /</button>
						</div>
						<div id='misete'>
							<div class='text-center'>もう少しだけ。。。</div>
						</div>
						<div id='fileContainer2'>
							<div class='text-center'></div>
						</div>
						";
					}
					*/
					?>
				</div>
			</div>
		</div>
		<input id="csf" type="hidden" value="<?php echo $_SESSION['currentsharedfolder']; ?>">
	</div>
	
	<?php
		require '../includes/footer.php';
	?>

</body>
</html>