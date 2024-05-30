<?php
session_start();

if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

// Get ID from session
$user_data = $_SESSION['ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $user_data;
    $sleep_habit = $_POST['sleep_habit'];
    $dorm_volume = $_POST['dorm_volume'];
    $location = $_POST['location'];
    $notes = $_POST['notes'];
    
    // Include connection.php
    include 'connection.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 刪除現有的用戶數據
    $delete_stmt = $conn->prepare("DELETE FROM Dorm.roomate WHERE user_id = ?");
    $delete_stmt->bind_param("s", $user_id);
    $delete_stmt->execute();
    $delete_stmt->close();

    // 插入新數據
    $insert_stmt = $conn->prepare("INSERT INTO Dorm.roomate (user_id, sleep_habit, dorm_volume, location, notes) VALUES (?, ?, ?, ?, ?)");
    $insert_stmt->bind_param("sssss", $user_id, $sleep_habit, $dorm_volume, $location, $notes);
    
    if ($insert_stmt->execute()) {
        header("Location: roomate_match.php");
        exit();
    } else {
        echo "Error: " . $insert_stmt->error;
    }
    
    $insert_stmt->close();
    $conn->close();
    
} else {
    echo "Error: Please make sure your form is filled correctly";
}
?>
