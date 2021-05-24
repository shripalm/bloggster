<?php
    if(! file_exists("../blog/blogLog.json")){
        echo "No blogs..!";exit;
    }
    $blogFileRead = json_decode(file_get_contents("../blog/blogLog.json"), true);
    foreach ($blogFileRead as $key => $value) {
        echo "<a href='../blog/".$value['name']."'>".$value['name']."</a><br>";
    }
?>