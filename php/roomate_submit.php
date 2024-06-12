<?php
session_start();

if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

// Include connection.php
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['ID'];
    $sleep_habit = $_POST['sleep_habit'];
    $dorm_volume = $_POST['dorm_volume'];
    $location = $_POST['location'];
    $notes = $_POST['notes'];

    // 清除該用戶之前的匹配條件
    $sql_delete_old = "DELETE FROM Dorm.roomate WHERE user_id = ?";
    $stmt_delete_old = $conn->prepare($sql_delete_old);
    if ($stmt_delete_old === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt_delete_old->bind_param("s", $userID);
    $stmt_delete_old->execute();
    $stmt_delete_old->close();

    // 插入新的匹配條件
    $sql_insert_new = "INSERT INTO Dorm.roomate (user_id, sleep_habit, dorm_volume, location, notes) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert_new = $conn->prepare($sql_insert_new);
    if ($stmt_insert_new === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt_insert_new->bind_param("sssss", $userID, $sleep_habit, $dorm_volume, $location, $notes);
    $stmt_insert_new->execute();
    $stmt_insert_new->close();

    // 清空以前的匹配結果
    $_SESSION['full_matches'] = [];
    $_SESSION['partial_matches'] = [];

    // 篩選完全符合條件的記錄
    $sql_full_match = "SELECT * FROM Dorm.roomate WHERE sleep_habit = ? AND dorm_volume = ? AND location = ? AND user_id != ?";
    $stmt_full_match = $conn->prepare($sql_full_match);
    if ($stmt_full_match === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt_full_match->bind_param("ssss", $sleep_habit, $dorm_volume, $location, $userID);
    $stmt_full_match->execute();
    $result_full_match = $stmt_full_match->get_result();
    
    $full_matches = [];
    while ($row = $result_full_match->fetch_assoc()) {
        $full_matches[] = $row;
    }
    $stmt_full_match->close();

    // 篩選宿舍相同但其他條件不同的記錄
    $sql_partial_match = "SELECT * FROM Dorm.roomate WHERE location = ? AND (sleep_habit != ? OR dorm_volume != ?) AND user_id != ?";
    $stmt_partial_match = $conn->prepare($sql_partial_match);
    if ($stmt_partial_match === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt_partial_match->bind_param("ssss", $location, $sleep_habit, $dorm_volume, $userID);
    $stmt_partial_match->execute();
    $result_partial_match = $stmt_partial_match->get_result();
    
    $partial_matches = [];
    while ($row = $result_partial_match->fetch_assoc()) {
        $partial_matches[] = $row;
    }
    $stmt_partial_match->close();
    
    // 將篩選結果存儲到 session
    $_SESSION['full_matches'] = $full_matches;
    $_SESSION['partial_matches'] = $partial_matches;
    
    header("Location: roomate_match.php");
    exit();
}

$conn->close();
?>
