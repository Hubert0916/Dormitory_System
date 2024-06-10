<?php
require_once dirname(__FILE__) . "/head.php";
require_once dirname(__FILE__) . "/overlay_nav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>

<body>
    <div class="box">
        <h1>註冊</h1>
        <form id="registration" method="post" enctype="multipart/form-data" onsubmit="return validateForm(event)">
            <div class="write">
                <div class="first-column">
                    <div class="Name">姓名 :<input type="text" id="Name" name="Name" required></div>
                    <div class="ID">學號 :<input type="text" id="ID" name="ID" required></div>
                    <div class="Email">信箱 :<input type="email" id="Email" name="Email" required></div>
                    <div class="Department">系所 :<input type="text" id="Department" name="Department" required></div>
                    <div class="Grade">年級 :<input type="text" id="Grade" name="Grade" required></div>
                    <div class="Phone">電話 :<input type="text" id="Phone" name='Phone' required></div>
                    <div class="FB">臉書連結 :<input type="text" id="FB" name="FB"></div>
                    <div class="IG">IG連結 :<input type="text" id="IG" name="IG"></div>
                    <div class="Password">密碼 :<input type="password" id="Password" name="Password" required></div>
                    <div class="Password1">確認密碼 :<input type="password" id="Password1" name="Password1" required></div>
                </div>

                <div class="second-column">
                    <div class="Dorm">宿舍 :
                        <select name="Dorm" required>
                            <option value="">請選擇你居住的宿舍</option>
                            <option value="7舍">7舍</option>
                            <option value="8舍">8舍</option>
                            <option value="9舍">9舍</option>
                            <option value="10舍">10舍</option>
                            <option value="11舍">11舍</option>
                            <option value="12舍">12舍</option>
                            <option value="13舍">13舍</option>
                            <option value="女二舍">女二舍</option>
                            <option value="竹軒">竹軒</option>
                            <option value="研一舍">研一舍</option>
                            <option value="研二舍">研二舍</option>
                            <option value="研三舍">研三舍</option>
                        </select>
                    </div>
                    <div class="Room">房號 :<input type="text" id="Room" name="Room" ></div>
                    <div class="Sex">性別 :<input type="text" id="Sex" name="Sex" required></div>
                    <div class="Photo">上傳大頭照 :<input type="file" name="photo" accept="image/*" required>
                        <span id="fileName"></span>
                    </div>
                    <div class="Intro">關於你的短簡介 :<br><textarea id="Intro" name="Intro" required></textarea>
                    </div>
                </div>
            </div>
            <button type="submit">提交</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function validateForm(event) {
        const password = document.getElementById('Password').value;
        const confirmPassword = document.getElementById('Password1').value;

        if (password.length < 6) {
            Swal.fire({
                icon: 'warning',
                title: 'Too short',
                text: 'Please enter a password of more than 6 characters',
            });
            event.preventDefault();
            return false;
        }

        if (password !== confirmPassword) {
            Swal.fire({
                icon: 'warning',
                title: 'Passwords do not match',
                text: 'Please ensure both passwords are the same',
            });
            event.preventDefault();
            return false;
        }

        return true;
    }
</script>

</html>

<?php

include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
    $Name = htmlspecialchars($_POST["Name"]);
    $Sex = htmlspecialchars($_POST["Sex"]);
    $Department = htmlspecialchars($_POST["Department"]);
    $Grade = htmlspecialchars($_POST["Grade"]);
    $Dorm = htmlspecialchars($_POST["Dorm"]);
    $Room = htmlspecialchars($_POST["Room"]);
    $Phone = htmlspecialchars($_POST["Phone"]);
    $Email = htmlspecialchars($_POST["Email"]);
    $FB = htmlspecialchars($_POST["FB"]);
    $IG = htmlspecialchars($_POST["IG"]);
    $Intro = htmlspecialchars($_POST["Intro"]);
    $Password = md5(htmlspecialchars($_POST["Password"]));
    $ID = htmlspecialchars($_POST["ID"]);
    $fileTmpPath = $_FILES["photo"]["tmp_name"];
    $fileName = $_FILES["photo"]["name"];
    $fileSize = $_FILES["photo"]["size"];
    $fileType = $_FILES["photo"]["type"];

    $fileContent = file_get_contents($fileTmpPath);

    $id_sql = "SELECT * FROM Dorm.Profile WHERE ID = '$ID'";
    $email_sql = "SELECT * FROM Dorm.Profile WHERE Email = '$Email'";
    $id_result = mysqli_query($conn, $id_sql);
    $email_result = mysqli_query($conn, $email_sql);

    if (mysqli_num_rows($id_result) > 0) {
        echo '<script>';
        echo 'Swal.fire({';
        echo 'icon: "error",';
        echo 'title: "ID already exists",';
        echo 'text: "Please use a different ID.",';
        echo '});';
        echo '</script>';
    } else if (mysqli_num_rows($email_result) > 0) {
        echo '<script>';
        echo 'Swal.fire({';
        echo 'icon: "error",';
        echo 'title: "Email already exists",';
        echo 'text: "Please use a different Email.",';
        echo '});';
        echo '</script>';
    } else {
        $stmt1 = $conn->prepare("INSERT INTO Dorm.Profile(ID, Name, Sex, Department, Grade, Dorm, Room, Phone, Email, FB, IG, Intro, Password)
        VALUES (?, ?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?, ?)");
        $stmt1->bind_param("issssssssssss", $ID, $Name, $Sex, $Department, $Grade, $Dorm, $Room, $Phone, $Email, $FB, $IG, $Intro, $Password);
        if (!$stmt1->execute()) {
            echo "Error: " . $stmt1->error;
        }
        $stmt1->close();

        $stmt2 = $conn->prepare("INSERT INTO photo (ID, photo_name, photo_type, photo_size, photo_content) VALUES (?, ?, ?, ?, ?)");
        $null = NULL;
        $stmt2->bind_param("issib", $ID, $fileName, $fileType, $fileSize, $null);
        $stmt2->send_long_data(4, $fileContent);
        if ($stmt2->execute()) {
            echo '<script>';
            echo 'Swal.fire({';
            echo 'icon: "success",';
            echo 'title: "Profile created successfully",';
            echo 'text: "You can now login with your account",';
            echo 'confirmButtonText: "OK",';
            echo 'willClose: () => { window.location.href = "login.php"; },';
            echo '});';
            echo '</script>';
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
        color: #576F72;
        background-color: #f2f2f2;
    }

    .Name input {
        margin-left: 70px;
    }

    .Sex input {
        margin-left: 70px;
    }

    .Room input {
        margin-left: 70px;
    }
    
    .Dorm select {
        font-size: 13px;
        margin-left: 70px;
        width: 150px;
        height: 25px;
        border-radius: 5px;
        border: 1px solid #bebbbb73;
        color: #576F72;
        background-color: #f2f2f2;
        margin-bottom: 20px;
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
        font-size: 13px;
        color: #576F72;
        background-color: #f2f2f2;
    }

    .Intro {
        margin-left: -119px;
    }

    textarea {
        padding: 10px;
        resize: none;
        overflow-y: auto;
        width: 265px;
        height: 215px;
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