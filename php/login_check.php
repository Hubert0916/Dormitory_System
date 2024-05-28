<?php
session_start();
require_once dirname(__FILE__)."/connection.php";


$query = [
  'ID' => htmlspecialchars($_POST["ID"]),
  'Password' => htmlspecialchars($_POST["Password"])
];

checkData($query['ID'], md5($query['Password'], false), $conn);
function checkData($ID, $Password, $conn) {
  $sql = "SELECT ID FROM Dorm.Profile WHERE ID = '$ID' AND Password = '$Password'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) == 0) {
    header("Location: login.php?wrong_login=true");   
    exit;
  } 
  else {
    mysqli_fetch_assoc($result);
    echo "登入成功";
    $_SESSION['login'] = true;
    $_SESSION['ID'] = $ID;
    $_SESSION['LAST_ACTIVITY'] = time();
    $result = mysqli_query($conn, $sql);

    header("Location: home.php?login_successful=true");   

  }
}
$conn->close();

?>
