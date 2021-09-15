<?php
    // error_reporting(0);
    session_start();
    if(! isset($_POST['name']) ) header('Location: add.php');
    if(! isset($_SESSION['pass'])) die('Not Authorized');
    require 'functions.php';
    $title = takeValue('name', $_POST['name'], true);
    $fName = str_replace(' ','-',strtolower($title));
    $tags = takeValue('tags', $_POST['tags'], true);
    $discription = takeValue('discription', $_POST['discription'], true);
    if(! $_FILES['fileToUpload']['error'] == 0 ) retResponse(199, 'File is required..!');
    if(file_exists("../blog/$fName")) retResponse(199, 'Name is takken..!');
    if(! mkdir("../blog/$fName")) retResponse(199, 'Error while creating folder..!');
    $_SESSION['folderName'] = $fName;
    fileUploadInBlog($fName, $_FILES);
    createBlog($title, $fName, $tags, $discription);
    recordBlog($title, substr($discription, 0, 100));
    recordXML($fName);
    unset($_SESSION['folderName']);
    retResponse(200, 'Congrats! Your blog is created..!');
?>