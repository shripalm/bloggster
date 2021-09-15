<?php
    if(! file_exists("../blog/blogLog.json")){
        echo "<tr><td colspan='3'><center>No blogs..!</center></td></tr>";exit;
    }
    $blogFileRead = json_decode(file_get_contents("../blog/blogLog.json"), true);
    if(! count($blogFileRead) > 0){
        echo "<tr><td colspan='3'><center>No blogs..!</center></td></tr>";exit;
    }
    foreach ($blogFileRead as $key => $value) {
        $name = $value['name'];
        $actName = $value['title'];
        echo "
            <tr>
                <th class='border'>$actName</th>
                <td class='border'><a href='../blog/$name/'><i class='fa fa-eye'></i></a></td>
                <td class='border'><i class='fa fa-trash' onclick='blogDel($key)'></i></td>
            </tr>
        ";
    }
?>