<?php
    function retResponse($code, $message){
        echo json_encode(['status'=>$code, 'message'=>$message]);
        if (isset($_SESSION['folderName'])) {
            exec(sprintf("rd /s /q %s", escapeshellarg('../blog/'.$_SESSION['folderName'])));
            exec(sprintf("rm -rf %s", escapeshellarg('../blog/'.$_SESSION['folderName'])));
            unset($_SESSION['folderName']);
        }
        exit;
    }
    function takeValue($key, $val, $required){
        if(strlen(trim($val)) == 0) retResponse(199, "$key field is required..!");
        if (strpos($val, '"') !== false) retResponse(199, "$key should not contain \" in itself..!");
        return($val);
    }
    function fileUploadInBlog($name, $fileArray){
        $target_dir = "../blog/$name";
        $target_file = $target_dir . '/' . 'blogImage.jpg';
        $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
        if(! getimagesize($fileArray["fileToUpload"]["tmp_name"])) retResponse(199, "File is not an image.");
        if ($fileArray["fileToUpload"]["size"] > 500000) retResponse(199, "File is too large.");
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) retResponse(199, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        if (! move_uploaded_file($fileArray["fileToUpload"]["tmp_name"], $target_file)) retResponse(199, 'Sorry, there was an error uploading your file.');
    }
    function createBlog($name, $tags, $discription){
        if(! file_exists("template.html")) retResponse(199, "Template not found..!");
        $contents = file_get_contents("template.html");
        $contents = str_replace('[&name]', $name, $contents);
        $contents = str_replace('[&tags]', $tags, $contents);
        $contents = str_replace('[&discription]', $discription, $contents);
        $blogFile = fopen("../blog/$name/index.html", "w");
        fwrite($blogFile, $contents);
        fclose($blogFile);
    }
    function recordBlog($name){
        if(! file_exists("../blog/blogLog.json")){
            $blogFileInit = fopen("../blog/blogLog.json", "w");
            fwrite($blogFileInit, '{}');
            fclose($blogFileInit);
        }
        $blogFileRead = json_decode(file_get_contents("../blog/blogLog.json"), true);
        $date = date('Y-m-d H:i:s');
        $countBlog = count($blogFileRead);
        $blogFileRead[$countBlog]['name'] = $name;
        $blogFileRead[$countBlog]['datetime'] = $date;
        $updatedRecord = json_encode($blogFileRead, true);
        $blogFile = fopen("../blog/blogLog.json", "w");
        fwrite($blogFile, $updatedRecord);
        fclose($blogFile);
    }
?>