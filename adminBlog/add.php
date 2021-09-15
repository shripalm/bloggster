<?php
    require_once 'config.php';
    session_start();
    if (!isset($_SESSION['pass'])) {
        if (!isset($_GET['pass'])) {
            echo "
                    <script>
                        var pass = prompt('Enter Password..!');
                        location.replace('?pass='+pass)
                    </script>
                ";
            exit;
        } else {
            if ($_GET['pass'] === PASS) {
                $_SESSION['pass'] = true;
            }
            header('Location: add.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</head>

<body>
    <form id="dataForm" enctype="multipart/form-data">
        <input type="text" placeholder="___NAME HERE___" name="name" />
        <textarea name="tags">___TAGS HERE___</textarea>
        <textarea name="discription">___DISCRIPTION HERE___</textarea>
        <input type="file" name="fileToUpload">
        <input type="button" onclick="addBlog()" value="Submit">
    </form>
    <br>
    <div>
        <table border>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="listAtHere">
                
            </tbody>
        </table>
    </div>
    <a href="logout.php"><i class="fa fa-eye"></i></a>
</body>
<script>
    const apiCallUrl = '/adminBlog/';

    $("#listAtHere").load(apiCallUrl + "listIt.php");

    function addBlog() {
        var formId = 'dataForm';
        var formData = new FormData(document.getElementById(formId));
        $.ajax({
            url: apiCallUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                result = JSON.parse(result);
                alert(result.message);
                if (result.status != 200) {
                    console.error(result.message);
                } else {
                    console.log(result.message);
                    document.getElementById(formId).reset();
                    $("#listAtHere").load(apiCallUrl + "listIt.php");
                }
            }
        });
    }

    function blogDel(id){
        $.ajax({
            url: apiCallUrl + 'delete.php?id=' + id,
            type: 'GET',
            success: function(result) {
                result = JSON.parse(result);
                alert(result.message);
                if (result.status != 200) {
                    console.error(result.message);
                } else {
                    console.log(result.message);
                    $("#listAtHere").load(apiCallUrl + "listIt.php");
                }
            }
        })
    }
</script>

</html>