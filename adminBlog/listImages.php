<?php
    $path = "../blog/extra-images/";
    $myfiles = array_diff(scandir($path), array('.', '..'));
    foreach ($myfiles as $key => $value) echo "<img src='/blog/extra-images/$value' onclick='insertImage(\"$value\")' />";
?>