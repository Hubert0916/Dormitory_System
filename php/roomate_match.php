<?php
require_once dirname(__FILE__) . "/overlay_nav.php";

if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

$full_matches = isset($_SESSION['full_matches']) ? $_SESSION['full_matches'] : [];
$partial_matches = isset($_SESSION['partial_matches']) ? $_SESSION['partial_matches'] : [];

// Include connection.php
include 'connection.php';

function fetchProfile($conn, $user_id) {
    $sql_profile = "SELECT Name, FB, IG, Email FROM Profile WHERE ID = ?";
    $stmt = $conn->prepare($sql_profile);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result_profile = $stmt->get_result();
    $profile_data = $result_profile->fetch_assoc();
    $stmt->close();
    return $profile_data;
}

function fetchPhoto($conn, $user_id) {
    $sql_photo = "SELECT photo_content FROM photo WHERE ID = ?";
    $stmt = $conn->prepare($sql_photo);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result_photo = $stmt->get_result();
    $photo_data = $result_photo->fetch_assoc();
    $stmt->close();
    return $photo_data;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 獲取每個篩選結果的詳細信息
foreach ($full_matches as &$match) {
    $profile_data = fetchProfile($conn, $match['user_id']);
    $photo_data = fetchPhoto($conn, $match['user_id']);
    $match['profile'] = $profile_data;
    $match['photo'] = $photo_data ? ['photo_content' => base64_encode($photo_data['photo_content'])] : ['photo_content' => ''];
}
unset($match);

foreach ($partial_matches as &$match) {
    $profile_data = fetchProfile($conn, $match['user_id']);
    $photo_data = fetchPhoto($conn, $match['user_id']);
    $match['profile'] = $profile_data;
    $match['photo'] = $photo_data ? ['photo_content' => base64_encode($photo_data['photo_content'])] : ['photo_content' => ''];
}
unset($match);

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>篩選結果</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: "Noto Serif TC", serif !important;
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
        .section-title {
            font-size: 1.5em;
            margin-top: 20px;
            color: #495057;
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
            object-fit: cover;
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
            object-fit: cover;
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
        <h2>篩選到的室友：</h2>

        <div class="section-title">完全符合條件：</div>
        <?php if (!empty($full_matches)): ?>
            <?php foreach ($full_matches as $index => $match): ?>
                <div class="profile" onclick='openModal(<?php echo json_encode($match); ?>)'>
                    <?php if ($match['photo']['photo_content']): ?>
                        <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($match['photo']['photo_content']); ?>" alt="Avatar">
                    <?php else: ?>
                        <img src="path/to/default/avatar.png" alt="Avatar"> <!-- 替換為預設的頭像圖片路徑 -->
                    <?php endif; ?>
                    <div class="profile-info">
                        <p>名字: <?php echo htmlspecialchars($match['profile']['Name']); ?></p>
                        <p>學號: <?php echo htmlspecialchars($match['user_id']); ?></p>
                        <p>睡眠習慣: <?php echo htmlspecialchars($match['sleep_habit']); ?></p>
                        <p>宿舍音量: <?php echo htmlspecialchars($match['dorm_volume']); ?></p>
                        <p>住宿地點: <?php echo htmlspecialchars($match['location']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No exact matches found.</p>
        <?php endif; ?>

        <div class="section-title">宿舍相同但其他條件不同：</div>
        <?php if (!empty($partial_matches)): ?>
            <?php foreach ($partial_matches as $index => $match): ?>
                <div class="profile" onclick='openModal(<?php echo json_encode($match); ?>)'>
                    <?php if ($match['photo']['photo_content']): ?>
                        <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($match['photo']['photo_content']); ?>" alt="Avatar">
                    <?php else: ?>
                        <img src="path/to/default/avatar.png" alt="Avatar"> <!-- 替換為預設的頭像圖片路徑 -->
                    <?php endif; ?>
                    <div class="profile-info">
                        <p>名字: <?php echo htmlspecialchars($match['profile']['Name']); ?></p>
                        <p>學號: <?php echo htmlspecialchars($match['user_id']); ?></p>
                        <p>睡眠習慣: <?php echo htmlspecialchars($match['sleep_habit']); ?></p>
                        <p>宿舍音量: <?php echo htmlspecialchars($match['dorm_volume']); ?></p>
                        <p>住宿地點: <?php echo htmlspecialchars($match['location']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No partial matches found.</p>
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
