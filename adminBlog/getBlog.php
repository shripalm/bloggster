<?php
    if(! file_exists("../blog/blogLog.json")){
        echo "No blogs..!";exit;
    }
    $blogFileRead = json_decode(file_get_contents("../blog/blogLog.json"), true);
    $cnt = count($blogFileRead);
    $page = $_GET['page'];
    $pp = 10;
    $start = ($page-1)*$pp;
    $ret['op'] = array_splice($blogFileRead,$start,$pp);
    $ret['indicator'] = (($page==1)?($cnt<=($start+$pp)?'fl':'first'):($cnt<=($start+$pp)?'last':'mid'));
    echo json_encode($ret, true);
?>