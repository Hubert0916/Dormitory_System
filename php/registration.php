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
      <form method="post" enctype="multipart/form-data">
        <div class="write">
            <div class="first-column">
              <div  class="input-group Name">
                  <label for="中文姓名">姓名 : </label>
                  <input type="text" id="Name" name="Name" >
              </div>
              <div  class="input-group EngName">
                  <label for="英文暱稱">英文名字 : </label>
                  <input type="text" id="EngName" name="EngName" >
              </div>
              <div  class="input-group Sex">
                  <label for="女/男">性別 : </label>
                  <input type="text" id="Sex" name="Sex" >
              </div>
              <div  class="input-group Email">
                  <label for="Email">信箱 : </label>
                  <input type="text" id="Email" name="Email" >
              </div>
              <div  class="input-group Password">
                  <label for="Password">密碼 : </label>
                  <input type="password" id="Password" name="Password" >
              </div>
              <div  class="input-group Department">
                  <label for="系所">系所 : </label>
                  <input type="text" id="Department" name="Department" >
              </div>
              <div  class="input-group Grade">
                  <label for="大一">年級 : </label>
                  <input type="text" id="Grade" name="Grade" >
              </div>
              <div class="input-group Phone">
                  <label for="Phone">電話 : </label>
                  <input type="text" id="Phone" name='Phone' >
              </div>  
              <div class="input-group FB">
                  <label for="FB link">臉書連結 : </label>
                  <input type="text" id="FB" name="FB">
              </div>
              <div class="input-group IG">
                  <label for="IG link">IG連結 : </label>
                  <input type="text" id="IG" name="IG">
              </div>
            </div>
            <div class="second-column">
              <div class="input-group Intro">
                  <label for="Intro">關於你的短簡介 ...</label>
                  <input type="text" id="Intro" name="Intro">
              </div>
              <div class="input-group Photo">

                <label for="Photo">上傳大頭照</label>
                <br>
                <input type="file" id="Photo" name="Photo">
                <span id="fileName"></span>
            </div>
            </div>
          </div>
          <button type="submit">提交</button>
      </form>
    </div>
    <script src="../js/overlay.js"></script>
  </body>
</html>

<style>
*
{
    margin:0;
    padding:0;
    box-sizing: border-box;
    font-family: "Noto Serif TC", serif;
}
body
{
    display:flex;
    justify-content:center;
    align-items:center;
    background-color: #576F72 !important;
    justify-content: center; 
    align-items: center;
    margin-top: 40px;
}

.box 
{
    padding: 1%;
    border: 2px solid #576F72; 
    border-radius: 10px;
    margin:10px;
    margin-top: -35px;
    background-color: #F0EBE3 !important; 
    flex-direction: row;
    justify-content: center; 
    align-items: center;
}

.box h1
{
    font-size: 70px;
    text-align: center;
    margin-top:0px;
    margin-bottom: 30px;
    color:#3d4f51;
}
.write
{
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
    margin-top: 3%;
    margin-bottom: 10px;
    width: 150px;
    height: 25px;
    border-radius: 5px;
    border: 1px solid #bebbbb73;;
    color: #576F72;
    background-color: #f2f2f2;
}

.input-group.Name input {
    margin-left: 70px;
}
.input-group.EngName input {
    margin-left: 32px;
}
.input-group.Sex input {
    margin-left: 70px;
}
.input-group.Email input {
    margin-left: 70px;
}
.input-group.Password input {
    margin-left: 70px;
}
.input-group.Department input {
    margin-left: 70px;
}
.input-group.Grade input {
    margin-left: 70px;
}
.input-group.Phone input {
    margin-left: 70px;
}
.input-group.FB input {
    margin-left: 33px;
}
.input-group.IG input {
    margin-left: 50px;
}
.input-group.Intro input {
    width: 250px; 
    height: 310px;
    align-items: center;
    margin-left: -10px;
}
.input-group.Photo {
    margin-top: 4px;
}
.input-group.Photo input {
    background-color: #F0EBE3;
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
    margin-left: -10px;
}

p {
    font-size: 15px; 
}
p a
{
    font-size: 17px; 
}
</style>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_FILES["Photo"]) && $_FILES["Photo"]["error"] == UPLOAD_ERR_OK) {

    $targetDir = "upload/";
    $targetFile = $targetDir . basename($_FILES["Photo"]["name"]);


    if (move_uploaded_file($_FILES["Photo"]["tmp_name"], $targetFile)) {

        $photoData = file_get_contents($targetFile);
    } 
    else {
        echo "Error moving file: " . $_FILES["Photo"]["error"];
    }
} 
else {
    echo "Please upload your photo。";
}

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

function insertData($Name, $Sex, $Department, $Grade, $Phone, $Email, $FB, $IG, $Intro, $Password, $photoData, $conn) {

    $Email_sql = "SELECT * FROM Dorm.Profile WHERE Email = '$Email'";
    $Name_sql = "SELECT * FROM Dorm.Profile WHERE Name = '$Name'";

    $Email_result = mysqli_query($conn, $Email_sql);
    $Name_result = mysqli_query($conn, $Name_sql);

    if(mysqli_num_rows($Email_result) > 0) {
        header("Location: registration.php?Email_repeat=true");
    }
    else if(mysqli_num_rows($Name_result) > 0) {
        header("Location: registration.php?Name_repeat=true");
    }
    else if(mysqli_num_rows($Email_result) === 0 && mysqli_num_rows($Name_result) === 0) {

        $sql = "INSERT INTO Dorm.Profile(Name, Sex, Department, Grade, Phone, Email, FB, IG, Intro, Password, Photo )
        VALUES ('$Name', '$Sex', '$Department', '$Grade', '$Phone', '$Email', '$FB', '$IG', '$Intro', '$Password', '$photoData')";

    }
    if (mysqli_query($conn, $sql)) {

        echo "New record created successfully";
        header("Location: login.php?registration_success=true");
        exit;
      } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
insertData($Name, $Sex, $Department, $Grade, $Phone, $Email, $FB, $IG, $Intro, $Password, $photoData, $conn);

}

$conn->close();
?>


<script>

window.onload = function(){
    if('<?= $_GET['Name_repeat'] ?>' === 'true') {
        Swal.fire({
            icon: 'error',
            title:  'ooooops....This username already registered!',
            confirmButtonColor: 'rgba(11, 29, 64, 0.747)'
        })
    } 
    else if('<?= $_GET['Email_repeat'] ?>' === 'true') {
        Swal.fire({
            icon: 'error',
            title: 'ooooops....This email already registered!',
            confirmButtonColor: 'rgba(11, 29, 64, 0.747)'
        })
    }
}
</script>


