<?php

//version 2 works better than version 1

if(isset($_GET['file'])){
    $fileid = base64_decode($_GET['file']);
    require '../includes/conn.php';
    $dc = new dbConnect();
    $stmt = $dc->conn->prepare("select link, filename from files where file_id = ?");
    $stmt->bind_param("i", $fileid);
    $stmt->execute();
    $stmt->bind_result($dir_filename, $dbfilename);
    $stmt->fetch();
    //Read the filename
    if(file_exists($dir_filename)) {

        //Define header information
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header("Content-Disposition: attachment; filename=$dbfilename");
        header('Content-Length: ' . filesize($dir_filename));
        header('Pragma: public');

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile($dir_filename);
    }
}



//VERSION 1 -- WORKING
/*
$name= $_GET['file'];

    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($name));
    ob_clean();
    flush();
    readfile($name); //showing the path to the server where the file is to be download
    exit;
    
    */
    
?>