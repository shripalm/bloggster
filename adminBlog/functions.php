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
        if ($fileArray["fileToUpload"]["size"] > 1000000) retResponse(199, "File is too large.");
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) retResponse(199, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        if (! move_uploaded_file($fileArray["fileToUpload"]["tmp_name"], $target_file)) retResponse(199, 'Sorry, there was an error uploading your file.');
    }
    function createBlog($title, $fName, $tags, $discription){
        if(! file_exists("template.html")) retResponse(199, "Template not found..!");
        $contents = file_get_contents("template.html");
        $contents = str_replace('[&name]', $title, $contents);
        $contents = str_replace('[&tags]', $tags, $contents);
        $contents = str_replace('[&discription]', $discription, $contents);
        
        $blogFile = fopen("../blog/$fName/index.html", "w");
        fwrite($blogFile, $contents);
        fclose($blogFile);
    }
    function recordBlog($title, $discription){
        if(! file_exists("../blog/blogLog.json")){
            $blogFileInit = fopen("../blog/blogLog.json", "w");
            fwrite($blogFileInit, '{}');
            fclose($blogFileInit);
        }
        $blogFileRead = json_decode(file_get_contents("../blog/blogLog.json"), true);
        $date = date('Y-m-d H:i:s');

        $newBlogJson['name'] = str_replace(' ','-',strtolower($title));
        $newBlogJson['title'] = $title;
        $newBlogJson['discription'] = $discription;
        $newBlogJson['datetime'] = $date;
        
        array_unshift($blogFileRead, $newBlogJson);

        $updatedRecord = json_encode($blogFileRead, true);
        $blogFile = fopen("../blog/blogLog.json", "w");
        fwrite($blogFile, $updatedRecord);
        fclose($blogFile);
    }
    function recordXML($fName){
        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->load('../sitemap.xml');

        $urlset = $xml->getElementsByTagName('urlset')->item(0);
        $urlTag = $xml->createElement('url');
            $urlTag->appendChild($xml->createElement('loc', "https://www.tanglecoder.com/blog/$fName/"));
            $urlTag->appendChild($xml->createElement('lastmod', date('Y-m-d').'T'.date('H:i:s+00:00')));
            $urlTag->appendChild($xml->createElement('priority', '0.51'));
        $urlTag->setAttribute('name', $fName);
        $urlset->appendChild($urlTag);
        $xml->formatOutput = true;
        $xml->save('../sitemap.xml');
    }
    function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            return;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    function unRecordBlog($blogFileRead){
        $blogFile = fopen("../blog/blogLog.json", "w");
        fwrite($blogFile, json_encode($blogFileRead));
        fclose($blogFile);
    }
    function unRecordXML($name){
        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->load('../sitemap.xml');
        $xp = new DOMXPath($xml);
        $node = $xp->query("//*[@name='$name']")->item(0);
        $node->parentNode->removeChild($node);
        $xml->save('../sitemap.xml');
    }
?>