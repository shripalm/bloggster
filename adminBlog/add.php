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
    <div id="listAtHere"></div>
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
                console.log(result);
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
</script>

</html>