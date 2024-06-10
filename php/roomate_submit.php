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
    $sleep_habit = $_POST['sleep_habit'];
    $dorm_volume = $_POST['dorm_volume'];
    $location = $_POST['location'];

    // 篩選完全符合條件的記錄
    $sql_full_match = "SELECT * FROM Dorm.roomate WHERE sleep_habit = ? AND dorm_volume = ? AND location = ?";
    $stmt_full_match = $conn->prepare($sql_full_match);
    if ($stmt_full_match === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt_full_match->bind_param("sss", $sleep_habit, $dorm_volume, $location);
    $stmt_full_match->execute();
    $result_full_match = $stmt_full_match->get_result();
    
    $full_matches = [];
    while ($row = $result_full_match->fetch_assoc()) {
        $full_matches[] = $row;
    }
    $stmt_full_match->close();

    // 篩選宿舍相同但其他條件不同的記錄
    $sql_partial_match = "SELECT * FROM Dorm.roomate WHERE location = ? AND (sleep_habit != ? OR dorm_volume != ?)";
    $stmt_partial_match = $conn->prepare($sql_partial_match);
    if ($stmt_partial_match === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt_partial_match->bind_param("sss", $location, $sleep_habit, $dorm_volume);
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
