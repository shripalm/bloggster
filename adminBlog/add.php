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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>

    <style>
        body {
            background-image: linear-gradient(to right, #8febd3, #95c9d7);
            width: 100vw;
            overflow: hidden;
        }


        .form__input {
            font-family: 'Roboto', sans-serif;
            color: #333;
            font-size: 0.9rem;
            margin-top: 10px !important;
            padding: 0.5rem 0.5rem;
            border-radius: 0.2rem;
            background-color: rgb(255, 255, 255);
            border: none;
            width: 90%;
            display: block;
            border-bottom: 0.3rem solid transparent;
            transition: all 0.3s;
            outline: none;
        }

        .form__input:placeholder-shown+.form__label {
            opacity: 0;
            visibility: hidden;
            -webkit-transform: translateY(-4rem);
            transform: translateY(-4rem);
        }

        .form-button {
            width: 50%;
            background-color: purple;
            color: white;
            font-weight: bold;
            padding: 0.5rem 0.5rem;
            border: none;
        }

        thead {
            height: 40px;
            background: #333;
            color: white;
            text-align: center;
        }

        tbody {
            height: 30px;
            background: #EEEEEE;
            color: #0d6efd;
            text-align: center;
        }

        .eye-button {
            line-height: 38px;
            width: 100px;
            background: purple;
            color: white;
            text-align: center;
            border-radius: 10px;
            margin-top: 10px;

        }

        .eye-button a {
            color: white;

            text-decoration: none;

        }

        #output {
            height: 720px;
            background: white;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <div class="row ms-5">
        <div class="col-5 mt-5 border ">
            <form id="dataForm" enctype="multipart/form-data">

                <input type="text" placeholder="___NAME HERE___" name="name" class="form__input" /><br>
                <textarea class="form__input" name="tags">___TAGS HERE___</textarea><br>
                <textarea class="form__input" name="discription" id="testText">___DISCRIPTION HERE___</textarea><br>
                <button type="button" onclick="addTagFunction('br', true)">Break</button>
                <button type="button" onclick="addTagFunction(`img src='' alt=''`, true)">Image</button>
                <button type="button" onclick="addTagFunction('center')">Center</button>
                <button type="button" onclick="addTagFunction('strong')">Bold</button>
                <button type="button" onclick="addTagFunction('em')">Italic</button>
                <button type="button" onclick="addTagFunction('ins')">Underline</button>
                <button type="button" onclick="addTagFunction('del')">Delete</button>
                <button type="button" onclick="addTagFunction('sub')">Subscripted</button>
                <button type="button" onclick="addTagFunction('sup')">Superscripted</button>
                <button type="button" onclick="addTagFunction('ol')">Order List</button>
                <button type="button" onclick="addTagFunction('ul')">Unorder List</button>
                <button type="button" onclick="addTagFunction('li')">List</button>
                <input class="form__input" type="file" name="fileToUpload"><br>
                <input class="form-button" type="button" onclick="addBlog()" value="Submit">
            </form>
            <br>
        </div>
        <div class="col-7 mt-5">
            <div id="output" onmouseover="document.getElementById('output').innerHTML = document.getElementById('testText').value" class="border me-5">
            </div>

        </div>


    </div>
    <br>


    <div class="row">
        <div class="col-8">
            <table border class="w-100 ms-5">
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
        <div class="col-4">
            <div class="ms-5 eye-button">
                <a href="logout.php">Logout</i></a>
            </div>
        </div>

    </div>

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

    function blogDel(id) {
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

    function addTagFunction(tag, single = false) {
        if (single) {
            let end = document.getElementById('testText').selectionEnd;
            let str = document.getElementById('testText').value;
            document.getElementById('testText').value = str.substr(0, end) + `<${tag} />` + str.substr(end);
        } else {
            let start = document.getElementById('testText').selectionStart;
            let end = document.getElementById('testText').selectionEnd;
            let str = document.getElementById('testText').value;
            document.getElementById('testText').value = str.substr(0, end) + `</${tag}>` + str.substr(end);
            str = document.getElementById('testText').value;
            document.getElementById('testText').value = str.substr(0, start) + `<${tag}>` + str.substr(start);
        }
    }
</script>

</html>