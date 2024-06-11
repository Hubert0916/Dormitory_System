<?php
require_once 'connection.php';
require_once dirname(__FILE__)."/session.php";
require_once dirname(__FILE__)."/overlay_nav.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['ID'])) {
    die("Session not found.");
}

$sessionID = $_SESSION['ID'];

$sql1 = "SELECT mr.student_id, mr.available_time, mr.move_services, mr.transport_mode, MAX(mr.reg_date) as latest_date, dp.Dorm
        FROM move_requests mr
        JOIN Profile dp ON mr.student_id = dp.ID
        WHERE dp.ID = ?
        GROUP BY mr.student_id, mr.available_time, mr.move_services, mr.transport_mode, dp.Dorm";

$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("s", $sessionID);
$stmt1->execute();
$result1 = $stmt1->get_result();
$data1 = [];
if ($result1 === false) {
    die("Error fetching data from move_requests: " . $conn->error);
} else {
    while ($row = $result1->fetch_assoc()) {
        $data1[] = $row;
    }
}

// Fetch latest data from the "move_service" table
$sql2 = "SELECT student_id, available_time, move_services, transport_mode, start_location, note, MAX(reg_date) as latest_date
        FROM move_service
        GROUP BY student_id, available_time, move_services, transport_mode, start_location, note";
$result2 = $conn->query($sql2);
$data2 = [];
if ($result2 === false) {
    die("Error fetching data from move_service: " . $conn->error);
} else {
    while ($row = $result2->fetch_assoc()) {
        $data2[] = $row;
    }
}

// Function to split strings into arrays
function splitValues($string) {
    return array_map('trim', explode(',', $string));
}

// Function to compare and find matches with at least one overlapping available_time and move_services
function findMatches($data1, $data2) {
    $matches = [];
    foreach ($data1 as $entry1) {
        $times1 = splitValues($entry1['available_time']);
        $services1 = splitValues($entry1['move_services']);
        $transport_mode1 = $entry1['transport_mode'];
        $start_location1 = $entry1['Dorm'];
        foreach ($data2 as $entry2) {
            $times2 = splitValues($entry2['available_time']);
            $services2 = splitValues($entry2['move_services']);
            $transport_mode2 = $entry2['transport_mode'];
            $start_location2 = splitValues($entry2['start_location']);
            if (array_intersect($times1, $times2) && 
                array_intersect($services1, $services2) && 
                in_array($start_location1, $start_location2) &&
                $transport_mode1 === $transport_mode2) {
                $matches[] = [
                    '幫我搬' => $entry1,
                    '幫你搬' => $entry2
                ];
            }
        }
    }
    return $matches;
}

$matches = findMatches($data1, $data2);

// Remove duplicate student IDs from matches
$unique_matches = [];
$student_ids = [];
foreach ($matches as $match) {
    if (!in_array($match['幫你搬']['student_id'], $student_ids)) {
        $unique_matches[] = $match;
        $student_ids[] = $match['幫你搬']['student_id'];
    }
}

// Fetch additional profile and photo information for the matched entries
$matched_profiles = [];
foreach ($unique_matches as $match) {
    $student_id = $match['幫你搬']['student_id'];
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

    // Ensure the photo data is properly base64-encoded
    if ($photo_data) {
        $photo_data['photo_content'] = base64_encode($photo_data['photo_content']);
        $matched_profiles[] = array_merge($match, ['profile' => $profile_data], ['photo' => $photo_data]);
    } else {
        // Handle cases where photo data is missing
        $matched_profiles[] = array_merge($match, ['profile' => $profile_data], ['photo' => ['photo_content' => '']]);
    }
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>Match</title>
    <style>
        body {
            font-family: "Noto Serif TC", serif;
            background-color: #F0EBE3;
            color: #000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            margin: auto;
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        body {
            font-family: "Noto Serif TC", serif;
            background-color: #F0EBE3;
            color: #000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }
        .container {
            width: 100%;
            margin: auto;
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-top: 250px;
        }
        .profile {
            border: 1px solid #dee2e6;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .profile:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile img {
            border-radius: 50%;
            margin-right: 10px;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .profile-info {
            flex: 1;
        }
        .profile-info p {
            margin: 0;
        }
        .profile-info strong {
            display: block;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            backdrop-filter: blur(5px);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            position: relative;
            word-wrap: break-word;
            overflow-wrap: break-word;
            animation: bounceIn 0.5s; /* Add bounce animation */
            text-align: center; /* Center align content */
        }
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                transform: scale(1);
            }
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>已為您搜尋到以下結果</h1>
        <?php if (!empty($matched_profiles)): ?>
            <?php foreach ($matched_profiles as $index => $match): ?>
                <div class="profile" onclick='openModal(<?php echo json_encode($match); ?>)'>
                    <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($match['photo']['photo_content']); ?>" alt="Avatar">
                    <div class="profile-info">
                        <strong>名字 : <?php echo htmlspecialchars($match['profile']['Name']); ?></strong>
                        <p>搬家服務 : <?php echo htmlspecialchars($match['幫你搬']['move_services']); ?></p>
                        <p>起始地點 : <?php echo htmlspecialchars($match['幫你搬']['start_location']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="fail">目前沒有符合的搬家服務配對。</p>
            <button onclick="window.location.href='move.php'" class="return">返回</button>
        <?php endif; ?>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modalImg" src="" alt="Avatar" style="width:100px; height:100px; border-radius:50%; margin-bottom:20px; object-fit: cover;">
            <p id="modalName"></p>
            <p id="modalServices"></p>
            <p id="modalLocation"></p>
            <p id="modalTime"></p>
            <p id="modalNote"></p>
            <div class="icon">
                <a id="modalFB" href="" target="_blank"><i class="fab fa-facebook"></i></a>
                <a id="modalIG" href="" target="_blank"><i class="fab fa-instagram"></i></a>
                <a id="modalEmail" href="" target="_blank"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </div>

    <script>
        function openModal(match) {
    if (match && match.photo && match.photo.photo_content) {
        document.getElementById('modalImg').src = "data:image/jpeg;base64," + match.photo.photo_content;
    } else {
        document.getElementById('modalImg').src = ""; // Default or placeholder image
    }

    document.getElementById('modalName').textContent = "名字 : " + (match && match.profile ? match.profile.Name : '');
    document.getElementById('modalServices').textContent = "搬家服務 : " + (match && match['幫你搬'] ? match['幫你搬'].move_services : '');
    document.getElementById('modalLocation').textContent = "起始地點 : " + (match && match['幫你搬'] ? match['幫你搬'].start_location : '');
    document.getElementById('modalTime').textContent = "可用時間 : " + translateAvailableTime(match && match['幫你搬'] ? match['幫你搬'].available_time : '');
    document.getElementById('modalNote').textContent = "備註 : " + (match && match['幫你搬'] ? match['幫你搬'].note : '');

    // Assuming these fields are available in your Profile table
    if (match && match.profile) {
        document.getElementById('modalFB').href = match.profile.FB;
        document.getElementById('modalIG').href = match.profile.IG;
        document.getElementById('modalEmail').href = "mailto:" + match.profile.Email;
    }

    document.getElementById('myModal').style.display = "block";
    }

    function closeModal() {
        document.getElementById('myModal').style.display = "none";
    }

    // Function to translate available time to Chinese
    function translateAvailableTime(timeString) {
        const timeMap = {
            "mon_morning": "星期一早上",
            "mon_afternoon": "星期一下午",
            "mon_evening": "星期一晚上",
            "tue_morning": "星期二早上",
            "tue_afternoon": "星期二下午",
            "tue_evening": "星期二晚上",
            "wed_morning": "星期三早上",
            "wed_afternoon": "星期三下午",
            "wed_evening": "星期三晚上",
            "thu_morning": "星期四早上",
            "thu_afternoon": "星期四下午",
            "thu_evening": "星期四晚上",
            "fri_morning": "星期五早上",
            "fri_afternoon": "星期五下午",
            "fri_evening": "星期五晚上",
            "sat_morning": "星期六早上",
            "sat_afternoon": "星期六下午",
            "sat_evening": "星期六晚上",
            "sun_morning": "星期天早上",
            "sun_afternoon": "星期天下午",
            "sun_evening": "星期天晚上"
        };

        if (!timeString) return '';

        const times = timeString.split(',');
        return times.map(time => timeMap[time] || time).join('、');
    }

    </script>
</body>
</html>

<?php
$conn->close();
?>
