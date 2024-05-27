<?php
require_once dirname(__FILE__)."/connection.php";

$query = [
'ID' => htmlspecialchars($_POST["ID"]),
'Password' => htmlspecialchars($_POST["Password"]),
'newpwd' => htmlspecialchars($_POST["newpwd"])
];

checkPwd($query['ID'],($query['Password']), ($query['newpwd']), $conn);

function checkPwd($ID,$Password, $newpwd, $conn) {
  $sql = "SELECT ID, Password FROM Dorm.Profile WHERE ID = '$ID'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) == 0) {
    header("Location: changepwd.php? wrong_pwd=true");   
  }
  else {
    $row = mysqli_fetch_assoc($result);
    if($row['Password'] == $Password)         
    {
      $sql = "UPDATE Dorm.Profile
            SET Password='$newpwd'
            WHERE ID='ID'";
      if (mysqli_query($conn, $sql)) {
        header("Location: login.php?changepwd_success=true");   
      } 
      else {
        header("Location: changepwd.php?changepwd_success=false"); 
      }
    }
  }
}

$conn->close();
?>
