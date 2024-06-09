<?php
require_once dirname(__FILE__) . "/overlay_nav.php";
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
    while ($row = $result->fetch_assoc()) {
        $roommates[] = $row;
    }
} else {
    echo "No roomate data found";
    exit();
}

// 匹配條件：睡眠習慣、宿舍音量和住宿地點必須相同
$matched_profiles = [];
foreach ($roommates as $roommate) {
    foreach ($roommates as $potential_match) {
        if ($roommate['user_id'] != $potential_match['user_id'] &&
            $roommate['sleep_habit'] == $potential_match['sleep_habit'] &&
            $roommate['dorm_volume'] == $potential_match['dorm_volume'] &&
            $roommate['location'] == $potential_match['location']) {
            
            $student_id = $roommate['user_id'];
            $sql_profile = "SELECT Name, FB, IG, Email FROM Profile WHERE ID = '$student_id'";
            $result_profile = $conn->query($sql_profile);
            if ($result_profile === false) {
                die("Error fetching profile data: " . $conn->error);
            } else {
                $profile_data = $result_profile->fetch_assoc();
            }

            $sql_photo = "SELECT photo_content FROM photo WHERE ID = '$student_id'";
            $result_photo = $conn->query($sql_photo);
            if ($result_photo === false) {
                die("Error fetching photo data: " . $conn->error);
            } else {
                $photo_data = $result_photo->fetch_assoc();
            }

            // 確保照片數據被正確地base64編碼
            if ($photo_data) {
                $photo_data['photo_content'] = base64_encode($photo_data['photo_content']);
                $matched_profiles[] = array_merge($roommate, ['profile' => $profile_data], ['photo' => $photo_data]);
            } else {
                // 處理缺少照片數據的情況
                $matched_profiles[] = array_merge($roommate, ['profile' => $profile_data], ['photo' => ['photo_content' => '']]);
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>匹配結果</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Noto Sans TC', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin: 10px 0;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .profile:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-info {
            flex: 1;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .modal p {
            margin: 10px 0;
        }
        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .social-links a {
            font-size: 30px;
        }
        .social-links a.facebook {
            color: #3b5998;
        }
        .social-links a.instagram {
            color: #E1306C;
        }
        .social-links a.email {
            color: #D44638;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>匹配到的室友：</h2>
        <?php if (!empty($matched_profiles)): ?>
            <?php foreach ($matched_profiles as $index => $match): ?>
                <div class="profile" onclick='openModal(<?php echo json_encode($match); ?>)'>
                    <?php if ($match['photo']['photo_content']): ?>
                        <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($match['photo']['photo_content']); ?>" alt="Avatar">
                    <?php else: ?>
                        <img src="path/to/default/avatar.png" alt="Avatar"> <!-- 替換為預設的頭像圖片路徑 -->
                    <?php endif; ?>
                    <div class="profile-info">
                        <strong>名字: <?php echo htmlspecialchars($match['profile']['Name']); ?></strong>
                        <p>學號: <?php echo htmlspecialchars($match['user_id']); ?></p>
                        <p>睡眠習慣: <?php echo htmlspecialchars($match['sleep_habit']); ?></p>
                        <p>宿舍音量: <?php echo htmlspecialchars($match['dorm_volume']); ?></p>
                        <p>住宿地點: <?php echo htmlspecialchars($match['location']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No matches found.</p>
        <?php endif; ?>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modalImg" src="" alt="Avatar">
            <p id="modalName"></p>
            <p id="modalUserId"></p>
            <p id="modalSleepHabit"></p>
            <p id="modalDormVolume"></p>
            <p id="modalLocation"></p>
            <div class="social-links">
                <a id="modalFB" href="#" target="_blank" class="facebook"><i class="fab fa-facebook"></i></a>
                <a id="modalIG" href="#" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                <a id="modalEmail" href="#" target="_blank" class="email"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </div>

    <script>
        function openModal(person) {
            document.getElementById('modalImg').src = person.photo.photo_content ? 'data:image/jpeg;base64,' + person.photo.photo_content : 'path/to/default/avatar.png';
            document.getElementById('modalName').textContent = '名字: ' + person.profile.Name;
            document.getElementById('modalUserId').textContent = '學號: ' + person.user_id;
            document.getElementById('modalSleepHabit').textContent = '睡眠習慣: ' + person.sleep_habit;
            document.getElementById('modalDormVolume').textContent = '宿舍音量: ' + person.dorm_volume;
            document.getElementById('modalLocation').textContent = '住宿地點: ' + person.location;
            document.getElementById('modalFB').href = person.profile.FB ? person.profile.FB : '#';
            document.getElementById('modalIG').href = person.profile.IG ? person.profile.IG : '#';
            document.getElementById('modalEmail').href = person.profile.Email ? 'mailto:' + person.profile.Email : '#';
            document.getElementById('myModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
    </script>
</body>
</html>
