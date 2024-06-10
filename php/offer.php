<?php
session_start();

if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

$user_data = $_SESSION['ID'];

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $user_data;
    $available_time = $_POST['time'];
    $move_services = $_POST['services'];
    $transport_mode = $_POST['transport'];
    $start_location = $_POST['location'];
    $note = $_POST['notes'];

    include 'connection.php';

    if ($conn->connect_error) {
        $response = ['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error];
    } else {
        // Delete existing entries with the same student_id
        $delete_stmt = $conn->prepare("DELETE FROM move_service WHERE student_id = ?");
        $delete_stmt->bind_param("i", $student_id);
        if (!$delete_stmt->execute()) {
            $response = ['status' => 'error', 'message' => 'Error deleting existing records: ' . $delete_stmt->error];
            $delete_stmt->close();
            $conn->close();
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        $delete_stmt->close();

        // Insert new entry
        $stmt = $conn->prepare("INSERT INTO move_service (student_id, available_time, move_services, transport_mode, start_location, note, reg_date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("isssss", $student_id, $available_time, $move_services, $transport_mode, $start_location, $note);

        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Your move request has been submitted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error: ' . $stmt->error];
        }

        $stmt->close();
        $conn->close();
    }
} else {
    $response = ['status' => 'error', 'message' => 'Invalid request'];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
