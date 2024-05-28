<?php
session_start(); 

$ID = $_SESSION['ID'];

require_once 'connection.php';



$stmt = $conn->prepare("SELECT * FROM Dorm.Profile WHERE ID = ?");
$stmt->bind_param("s", $ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $_SESSION['user_data'] = $row;
    
    $stmt_photo = $conn->prepare("SELECT photo_name, photo_type, photo_size, photo_content FROM photo WHERE ID = ?");
    $stmt_photo->bind_param("i", $ID);
    $stmt_photo->execute();
    $result_photo = $stmt_photo->get_result();

    if ($result_photo->num_rows > 0) {
        $row_photo = $result_photo->fetch_assoc();
        $_SESSION['user_data']['photo'] = $row_photo;
    } else {
    }
    
    $stmt_photo->close();
    
} else {
}

$stmt->close();
$conn->close();
?>
