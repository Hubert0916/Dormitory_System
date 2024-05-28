<?php
session_start();

if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

// Get ID from session
$user_data = $_SESSION['ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $user_data;
    $available_time = $_POST['time'];
    $move_services = $_POST['services'];
    $transport_mode = $_POST['transport'];
    $start_location = $_POST['location'];
    $note = $_POST['notes'];

    // Include connection.php
    include 'connection.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully.<br>";
    }

    $stmt = $conn->prepare("INSERT INTO move_service (student_id, available_time, move_services, transport_mode, start_location, note, reg_date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("isssss", $student_id, $available_time, $move_services, $transport_mode, $start_location, $note);
    
    if ($stmt->execute()) {
        echo "Success: Your move request has been submitted successfully";
        header("Location: home.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
    
} else {
    echo "Error: Please make sure your form is filled correctly";
}
?>
