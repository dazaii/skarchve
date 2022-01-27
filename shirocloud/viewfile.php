<?php
    if(!isset($_GET['fileid'])){
        die("Invalid url");
    }
    $fileid = base64_decode($_GET['fileid']);
    require '../includes/auth.php';
    $stmt = $dc->conn->prepare("select COUNT(*) as res, link, filename, filetype from files where file_id = ? and ownerid = ?");
    $stmt->bind_param("ii", $fileid, $darega);
    $stmt->execute();
    $stmt->bind_result($res, $file, $name, $ftype);
    $stmt->fetch();

    if($res == 0){
        die("File not found");
    }
    if($ftype == 'pdf'){
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="'.basename($file).'"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        header('Accept-Ranges: bytes');
        @readfile($file);
    }else{
        require '../includes/header.php';
        echo "
        <body class='roboto-light bg-light'>
        <div class='container mt-2'>
            <div class='row'>
                <div class='col-md-12'>
                    <div style='min-height: 500px' class='p-4 bg-white rounded-3 shadow-sm'>
                        <div class='row align-items-center justify-content-between'>
                            <div class='col-auto mb-2 mb-md-0'>
                                <span style='cursor: default;' class='fs-3 text-white bg-info px-2 rounded-3 shinybutt roboto-light fw-bold float-start'>Shirocloud</span>
                            </div>
                            <div class='col-auto'>
                                <a href='../download/?file=".base64_encode($fileid)."' class='btn overflow-hidden bg-info border-0 text-white mb-2'><span class='shinybutt'>Download</span></a>
                            </div>
                        </div>
                            <div class='mt-2 row'>
                                <div class='col-12 text-center fs-5'>
                                    $name
                                </div>
                                <div class='col-12 mt-2' style='user-select: none'>

                                ";
                                
                                if($ftype == 'wav' || $ftype == 'mp3'){
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
                                    <button class='d-none btn btn-info btn-sm text-white' onclick='mute()' id='mute'>mute</button>

                                    ";
                                }else if($ftype == 'mp4'){
                                    echo "
                                                <div class='row align-items-center justify-content-center bg-white'>
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
                                }else if($ftype == 'jpg' ||$ftype == 'webp' || $ftype == 'jpeg' || $ftype == 'png'){
                                    echo "
                                    <div class='row align-items-center justify-content-center bg-white'>
                                        <div class='container'>
                                            <div class='row justify-content-center align-items-center'>
                                                <div class='col-12'>
                                                    <img src='../$file' style='width: 100%;' controls>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
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


</script>
                                <?php
    echo"
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    ";
    }
        


    exit;
?>