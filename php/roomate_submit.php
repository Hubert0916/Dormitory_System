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
    } else {
        echo "Connected successfully.<br>";
    }

    $stmt = $conn->prepare("INSERT INTO Dorm.roomate (user_id, sleep_habit, dorm_volume, location, notes) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_id, $sleep_habit, $dorm_volume, $location, $notes);
    
    if ($stmt->execute()) {
        echo "Success: Your move request has been submitted successfully";
        header("Location: roomate_match.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
    
} else {
    echo "Error: Please make sure your form is filled correctly";
}
?>
