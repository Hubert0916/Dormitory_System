<?php
require_once dirname(__FILE__)."/connection.php";

$query = [
'ID' => htmlspecialchars($_POST["ID"]),
'Password' => htmlspecialchars($_POST["Password"]),
'Password2' => htmlspecialchars($_POST["Password2"])
];

checkPwd($query['ID'],md5($query['Password'], false), md5($query['Password2'], false), $conn);

function checkPwd($ID,$Password, $Password2, $conn) {

  $sql = "SELECT ID, Password FROM Dorm.Profile WHERE ID = '$ID'";  

  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) == 0) {
    header("Location: changepwd.php?wrong_pwd=true");   
  }

  else {
    $row = mysqli_fetch_assoc($result);
    if($row['Password'] == $Password)         
    {
      $sql = "UPDATE Dorm.Profile
            SET Password='$Password2'
            WHERE ID='$ID'";

      if (mysqli_query($conn, $sql)) {
        header("Location: home.php?changepwd_success=true"); 
  
      } 
      else {
        header("Location: changepwd.php?changepwd_success=false"); 
      }
    }
  }
}

$conn->close();
?>