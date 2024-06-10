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
    
    // Include connection.php
    include 'connection.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully.<br>";
    }

    // Delete existing entries with the same student_id
    $delete_stmt = $conn->prepare("DELETE FROM Dorm.move_requests WHERE student_id = ?");
    $delete_stmt->bind_param("s", $student_id);
    if (!$delete_stmt->execute()) {
        echo "Error: " . $delete_stmt->error;
    }
    $delete_stmt->close();

    // Insert new entry
    $insert_stmt = $conn->prepare("INSERT INTO Dorm.move_requests (student_id, available_time, move_services, transport_mode, reg_date) VALUES (?, ?, ?, ?, NOW())");
    $insert_stmt->bind_param("ssss", $student_id, $available_time, $move_services, $transport_mode);
    
    if ($insert_stmt->execute()) {
        echo "Success: Your move request has been submitted successfully";
        header("Location: move_match.php");
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
