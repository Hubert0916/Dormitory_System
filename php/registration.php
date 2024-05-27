<?php
    require_once dirname(__FILE__)."/connection.php";
    require_once dirname(__FILE__) . "/overlay_nav.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Pen+Script&family=Noto+Serif+TC:wght@200..900&display=swap" rel="stylesheet">

</head>

<body>
    <div class="box">
        <h1>註冊</h1>
        <form id="registration" method="post" enctype="multipart/form-data" onsubmit="return validateForm(event)">
            <div class="write">
                <div class="first-column">
                    <div class="Name">姓名 :<input type="text" id="Name" name="Name"></div>
                    <div class="ID">學號 :<input type="text" id="ID" name="ID"></div>
                    <div class="Email">信箱 :<input type="text" id="Email" name="Email"></div>
                    <div class="Department">系所 :<input type="text" id="Department" name="Department"></div>
                    <div class="Grade">年級 :<input type="text" id="Grade" name="Grade"></div>
                    <div class="Sex">性別 :<input type="text" id="Sex" name="Sex"></div>
                    <div class="Phone">電話 :<input type="text" id="Phone" name='Phone'></div>
                    <div class="FB">臉書連結 :<input type="text" id="FB" name="FB"></div>
                    <div class="IG">IG連結 :<input type="text" id="IG" name="IG"></div>


                </div>

                <div class="second-column">
                    <div class="Password">密碼 :<input type="password" id="Password" name="Password"></div>
                    <div class="Password1">確認密碼 :<input type="password" id="Password1" name="Password1"></div>
                    <div class="Photo">上傳大頭照 :<input type="file" name="photo" accept="image/*">
                        <span id="fileName"></span>
                    </div>
                    <div class="Intro">關於你的短簡介 :<br><textarea input id="Intro" name="Intro"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit">提交</button>
        </form>
    </div>
</body>
<script src="../js/overlay.js"></script>

</html>


<script>
    function validateForm(event) {
        var x = document.getElementById('Password').value;
        var y = document.getElementById('Password1').value;

        if (x.length < 6) {
            Swal.fire({
                icon: 'warning',
                title: 'Too short',
                text: 'Please enter a password of more than 6 characters',
            })

            event.preventDefault();
        } else if (x != y) {
            Swal.fire({
                icon: 'error',
                title: 'Wrong password',
                text: 'Confirm and Retype your password',
            })
            event.preventDefault();
        } else {
            document.getElementById('registration').submit();
        }
    }
    window.onload = function(){
        if('<?= $_GET['id_repeat'] ?>' === 'true') {
            Swal.fire({
                icon: 'error',
                title: 'ooooops....This Student_ID already registered!',
                confirmButtonColor: 'rgba(11, 29, 64, 0.747)'
            })
        } 
        }
        if ('<?= $_GET['registration_success'] ?>' === 'true') {
            Swal.fire({
                icon : 'success',
                title: 'Already registrastion ',
                text : 'Log in now !!',
                
            });
        }
</script>

<?php

include "connection.php";
include "overlay_nav.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {

    $Name = htmlspecialchars($_POST["Name"]);
    $Sex = htmlspecialchars($_POST["Sex"]);
    $Department = htmlspecialchars($_POST["Department"]);
    $Grade = htmlspecialchars($_POST["Grade"]);
    $Phone = htmlspecialchars($_POST["Phone"]);
    $Email = htmlspecialchars($_POST["Email"]);
    $FB = htmlspecialchars($_POST["FB"]);
    $IG = htmlspecialchars($_POST["IG"]);
    $Intro = htmlspecialchars($_POST["Intro"]);
    $Password = htmlspecialchars($_POST["Password"]);
    $ID = htmlspecialchars($_POST["ID"]);
    $fileTmpPath = $_FILES["photo"]["tmp_name"];
    $fileName = $_FILES["photo"]["name"];
    $fileSize = $_FILES["photo"]["size"];
    $fileType = $_FILES["photo"]["type"];

    $fileContent = file_get_contents($fileTmpPath);

    $id_sql = "SELECT * FROM Dorm.Profile WHERE ID = '$ID'";

    $id_result = mysqli_query($conn, $id_sql);

    if (mysqli_num_rows($id_result) > 0) {
        header("Location: registration.php?id_repeat=true");
    } else if (mysqli_num_rows($Email_result) === 0 && mysqli_num_rows($id_result) === 0) {

        $stmt1 = $conn->prepare("INSERT INTO Dorm.Profile(ID, Name, Sex, Department, Grade, Phone, Email, FB, IG, Intro, Password)
        VALUES (?, ?, ?, ?, ?, ?, ? ,? ,? ,?, ?)");
        $stmt1->bind_param("issssssssss", $ID, $Name, $Sex, $Department, $Grade, $Phone, $Email, $FB, $IG, $Intro, $Password);
        if ($stmt1->execute()) {
            echo "Profile Created successfully.";
        } else {
            echo "Error: " . $stmt1->error;
        }
        $stmt1->close();

        $stmt2 = $conn->prepare("INSERT INTO photo (ID, photo_name, photo_type, photo_size, photo_content) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("issib", $ID, $fileName, $fileType, $fileSize, $null);
        $stmt2->send_long_data(4, $fileContent);
        if ($stmt2->execute()) {
            header("Location: login.php");
            echo "File uploaded successfully.";
        } else {
            echo "Error: " . $stmt2->error;
        }
        $stmt2->close();

        $conn->close();
    }
} 
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Noto Serif TC", serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #576F72 !important;
        justify-content: center;
        align-items: center;
        margin-top: 40px;
    }

    .box {
        padding: 2.5%;
        border: 2px solid #576F72;
        border-radius: 10px;
        margin: 10px;
        margin-top: -35px;
        background-color: #F0EBE3 !important;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .box h1 {
        font-size: 50px;
        text-align: center;
        margin-top: 15px;
        margin-bottom: 30px;
        color: #3d4f51;
    }

    .write {
        font-size: 20px;
        margin-bottom: 10%;
        margin-top: 15px;
        display: flex;
        flex-direction: row;
        text-align: center;
        color: #3d4f51;
        justify-content: space-between;
    }

    .write input {
        font-size: 15px;
        margin-bottom: 20px;
        width: 150px;
        height: 25px;
        border-radius: 5px;
        border: 1px solid #bebbbb73;
        ;
        color: #576F72;
        background-color: #f2f2f2;
    }

    .Name input {
        margin-left: 70px;
    }

    .EngName input {
        margin-left: 32px;
    }

    .Sex input {
        margin-left: 70px;
    }

    .Email input {
        margin-left: 70px;
    }

    .Password input {
        margin-left: 70px;
    }

    .Password1 input {
        margin-left: 32px;
    }

    .Department input {
        margin-left: 70px;
    }

    .Grade input {
        margin-left: 70px;
    }

    .Phone input {
        margin-left: 70px;
    }

    .FB input {
        margin-left: 30px;
    }

    .IG input {
        margin-left: 47px;
    }

    .ID input {
        margin-left: 70px;
    }

    .Photo input {
        margin-left: 13px;
        background-color: #F0EBE3;
    }

    .Intro {
        margin-left: -119px;
    }

    textarea {
        padding: 10px;
        resize: none;
        overflow-y: auto;
        width: 265px;
        height: 225px;
        align-items: center;
        border: #F0EBE3;
        font-size: 15px;
        border-radius: 5px;
        border: 1px solid #bebbbb73;
        color: #576F72;
        background-color: #f2f2f2;
        margin-left: 117px;
        margin-top: 26px;
    }


    button {
        font-size: 24px;
        background-color: #576f72d8;
        color: #F0EBE3;
        padding: 7px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        flex-direction: column;
        text-align: center;
        align-items: center;
        margin: 0 auto;
        display: block;
        margin-top: -45px;
        margin-bottom: 20px;
    }

    .first-column {
        flex: 1;
        width: 360px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-right: -40px
    }

    .second-column {
        flex: 1;
        display: flex;
        flex-direction: column;
        margin-left: 50px;
        margin-right: 10px;
    }

    p {
        font-size: 15px;
    }

    p a {
        font-size: 17px;
    }

    p a:hover {
        color: #576F72;
    }
</style>