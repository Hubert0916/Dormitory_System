<?php
require_once dirname(__FILE__)."/connection.php";

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
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Pen+Script&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="box">
      <h1>Register</h1>
      <form method="get">
        <div class="write">
            <div class="first-column">
              <div  class="input-group Name">
                  <label for="中文姓名">Name : </label>
                  <input type="text" id="Name" name="Name" >
              </div>
              <div  class="input-group EngName">
                  <label for="英文暱稱">English Name : </label>
                  <input type="text" id="EngName" name="EngName" >
              </div>
              <div  class="input-group Sex">
                  <label for="女/男">Sex : </label>
                  <input type="text" id="Sex" name="Sex" >
              </div>
              <div  class="input-group Email">
                  <label for="Email">Email : </label>
                  <input type="text" id="Email" name="Email" >
              </div>
              <div  class="input-group Password">
                  <label for="Password">Password : </label>
                  <input type="password" id="Password" name="Password" >
              </div>
              <div  class="input-group Department">
                  <label for="系所">Department : </label>
                  <input type="text" id="Department" name="Department" >
              </div>
              <div  class="input-group Grade">
                  <label for="大一">Grade : </label>
                  <input type="text" id="Grade" name="Grade" >
              </div>
              <div class="input-group Phone">
                  <label for="Phone">Phone : </label>
                  <input type="text" id="Phone" name='Phone' >
              </div>  
              <div class="input-group FB">
                  <label for="FB link">FB : </label>
                  <input type="text" id="FB" name="FB">
              </div>
              <div class="input-group IG">
                  <label for="IG link">IG : </label>
                  <input type="text" id="IG" name="IG">
              </div>
            </div>
            <div class="second-column">
              <div class="input-group Intro">
                  <label for="Intro">Brief introduction ...</label>
                  <input type="text" id="Intro" name="Intro">
              </div>
              <div class="input-group Photo">
                  <label for="Photo">Upload your cool Photo</label>
                    <br>
                  <input type="file" id="Photo" name="Photo" >
                  <span id="fileName"></span>
              </div>
            </div>
          </div>
          <button type="submit">Done</button>
      </form>
    </div>
  </body>
</html>

<style>
*
{
    margin:0;
    padding:0;
    box-sizing: border-box;
    font-family: "Nanum Pen Script", "cwTeXYen" ,", Verdana";

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
    background-color: #F0EBE3 !important; 
    flex-direction: row;
    justify-content: center; 
    align-items: center;
}

.box h1
{
    font-size: 80px;
    text-align: center;
    margin-top:0px;
    margin-bottom: 30px;
    color:#3d4f51;
}
.write
{
    font-size: 29px; 
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
    font-family: "cwTeXYen" ,"Verdana";
}

.input-group.Name input {
    margin-left: 80px;
}
.input-group.Sex input {
    margin-left: 94px;
}
.input-group.Email input {
    margin-left: 72px;
}
.input-group.Password input {
    margin-left: 37px;
}
.input-group.Department input {
    margin-left: 12px;
}
.input-group.Grade input {
    margin-left: 73px;
}
.input-group.Phone input {
    margin-left: 69px;
}
.input-group.FB input {
    margin-left: 104px;
}
.input-group.IG input {
    margin-left: 104px;
}

.input-group.Intro input {
    margin-left: 72px;
    width: 200px; 
    height: 300px;
    align-items: center;
    margin-left: -7px;
}
.input-group.Photo input {
    background-color: #F0EBE3;
}

button {
    font-size: 30px;
    background-color: #576f72d8;
    color: #F0EBE3;
    padding: 10px 30px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    flex-direction: column;
    text-align: center;
    align-items: center;
    margin: 0 auto; 
    display: block; 
    margin-top: -30px;
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
require_once dirname(__FILE__)."/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $photoData = file_get_contents("path_to_your_photo.jpg");

$Name = htmlspecialchars($_GET["Name"]);
$Sex = htmlspecialchars($_GET["Sex"]);
$Department = htmlspecialchars($_GET["Department"]);
$Grade = htmlspecialchars($_GET["Grade"]);
$Phone = htmlspecialchars($_GET["Phone"]);
$Email = htmlspecialchars($_GET["Email"]);
$FB = htmlspecialchars($_GET["FB"]);
$IG = htmlspecialchars($_GET["IG"]);
$Intro = htmlspecialchars($_GET["Intro"]);
$Password = htmlspecialchars($_GET["Password"]);

$query = "INSERT INTO Profile (Photo, Name, Sex, Department, Grade, Phone, Email, FB, IG, Intro, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("bssssssssss", $photoData, $Name, $Sex, $Department, $Grade, $Phone, $Email, $FB, $IG, $Intro, $Password);


$Email_sql = "SELECT * FROM Profile WHERE Email = '$Email'";
$Name_sql = "SELECT * FROM Profile WHERE Name = '$Name'";

$Email_result = mysqli_query($conn, $Email_sql);
$Name_result = mysqli_query($conn, $Name_sql);

if(mysqli_num_rows($Email_result) > 0) {
    header("Location: registration.php?Email_repeat=true");
}
else if(mysqli_num_rows($Name_result) > 0) {
    header("Location: registration.php?Name_repeat=true");
}
else {
    if ($stmt->execute()) {
        header("Location: login.php?registration_success=true");
        exit;
    } else {
        echo "Error executing query: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
}
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


