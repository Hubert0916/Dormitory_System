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

// 獲取所有已提交的室友數據
$sql = "SELECT * FROM Dorm.roomate";
$result = $conn->query($sql);

$roommates = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $roommates[] = $row;
    }
} else {
    echo "No roomate data found";
    exit();
}

// 這裡我們假設匹配條件是：睡眠習慣、宿舍音量和住宿地點必須相同，並且不能匹配到自己
$matched_pairs = [];

for ($i = 0; $i < count($roommates); $i++) {
    for ($j = $i + 1; $j < count($roommates); $j++) {
        if ($roommates[$i]['user_id'] != $roommates[$j]['user_id'] && // 確保不是自己
            $roommates[$i]['sleep_habit'] == $roommates[$j]['sleep_habit'] &&
            $roommates[$i]['dorm_volume'] == $roommates[$j]['dorm_volume'] &&
            $roommates[$i]['location'] == $roommates[$j]['location']) {
            $matched_pairs[] = [
                'roommate1' => $roommates[$i],
                'roommate2' => $roommates[$j]
            ];
        }
    }
}

// 顯示匹配結果
if (count($matched_pairs) > 0) {
    echo "<h2>匹配到的室友：</h2>";
    echo "<ul>";
    foreach ($matched_pairs as $pair) {
        echo "<li>";
        echo "Roommate 1 ID: " . $pair['roommate1']['user_id'] . " - Sleep Habit: " . $pair['roommate1']['sleep_habit'] . " - Dorm Volume: " . $pair['roommate1']['dorm_volume'] . " - Location: " . $pair['roommate1']['location'] . "<br>";
        echo "Roommate 2 ID: " . $pair['roommate2']['user_id'] . " - Sleep Habit: " . $pair['roommate2']['sleep_habit'] . " - Dorm Volume: " . $pair['roommate2']['dorm_volume'] . " - Location: " . $pair['roommate2']['location'];
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "No matching roommates found.";
}

$conn->close();
?>
