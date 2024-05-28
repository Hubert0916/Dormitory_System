<?php
require_once dirname(__FILE__) . "/session.php";


if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['ID'];
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
