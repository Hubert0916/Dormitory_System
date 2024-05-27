<?php
require_once dirname(__FILE__) . "/session.php";

$user_data = $_SESSION['user'];

if (!isset($user_data['ID'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $user_data['ID'];
    $available_time = $_POST['time'];
    $move_services = $_POST['services'];
    $transport_mode = $_POST['transport'];

    // 引用connection.php
    require_once 'connection.php';

    $sql = "INSERT INTO move_requests (student_id, available_time, move_services, transport_mode)
            VALUES ('$student_id', '$available_time', '$move_services', '$transport_mode')";

    if ($conn->query($sql) === TRUE) {
        echo "數據提交成功！";
    } else {
        echo "錯誤: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
