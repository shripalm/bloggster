<?php
    session_start();
    if((! isset($_SESSION['pass'])) || (! isset($_GET['id']))) die('Not Authorized');
    require_once 'functions.php';
    $id = $_GET['id'];
    $blogFileRead = json_decode(file_get_contents("../blog/blogLog.json"), true);
    $name = $blogFileRead[$id]['name'];
    unset($blogFileRead[$id]);
    unRecordXML($name);
    unRecordBlog($blogFileRead);
    deleteDir('../blog/'.$name);
    retResponse(200, 'Congrats! Your blog is deleted..!');
?>