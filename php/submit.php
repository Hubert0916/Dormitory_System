<?php
require_once dirname(__FILE__) . "/session.php";

$user_data = $_SESSION['user_data'];
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

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully.<br>";
    }

    // 檢查 $conn 是否為有效的 mysqli 對象
    if ($conn instanceof mysqli) {
        $sql = "INSERT INTO move_requests (student_id, available_time, move_services, transport_mode)
                VALUES ('$student_id', '$available_time', '$move_services', '$transport_mode')";

        if ($conn->query($sql) === TRUE) {
            echo "數據提交成功！";
        } else {
            echo "錯誤: " . $sql . "<br>" . $conn->error;
        }

        // 關閉連接
        $conn->close();
    } else {
        echo "無效的數據庫連接。";
    }
}
?>