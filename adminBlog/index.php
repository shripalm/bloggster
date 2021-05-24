<?php
    // error_reporting(0);
    session_start();
    if(! isset($_POST['name']) ) header('Location: add.html');
    require 'functions.php';
    $name = takeValue('name', $_POST['name'], true);
    $tags = takeValue('tags', $_POST['tags'], true);
    $discription = takeValue('discription', $_POST['discription'], true);
    if(! $_FILES['fileToUpload']['error'] == 0 ) retResponse(199, 'File is required..!');
    if(file_exists("../blog/$name")) retResponse(199, 'Name is takken..!');
    if(! mkdir("../blog/$name")) retResponse(199, 'Error while creating folder..!');
    $_SESSION['folderName'] = $name;
    fileUploadInBlog($name, $_FILES);
    createBlog($name, $tags, $discription);
    recordBlog($name);
    unset($_SESSION['folderName']);
    retResponse(200, 'Congrats! Your blog is created..!');
?>