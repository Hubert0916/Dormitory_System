<?php
require_once 'connection.php';
//require_once dirname(__FILE__) . "/overlay_nav.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "move_requests" table
$sql1 = "SELECT student_id, available_time, move_services, transport_mode FROM move_requests";
$result1 = $conn->query($sql1);
$data1 = [];
if ($result1 === false) {
    die("Error fetching data from move_requests: " . $conn->error);
} else {
    while ($row = $result1->fetch_assoc()) {
        $data1[] = $row;
    }
}

// Fetch data from the "move_service" table
$sql2 = "SELECT student_id, available_time, move_services, transport_mode, start_location, note FROM move_service";
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
    return explode(',', $string);
}

// Function to compare and find matches with at least one overlapping available_time and move_services
function findMatches($data1, $data2) {
    $matches = [];
    foreach ($data1 as $entry1) {
        $times1 = splitValues($entry1['available_time']);
        $services1 = splitValues($entry1['move_services']);
        foreach ($data2 as $entry2) {
            $times2 = splitValues($entry2['available_time']);
            $services2 = splitValues($entry2['move_services']);
            if (array_intersect($times1, $times2) && 
                array_intersect($services1, $services2) && 
                $entry1['transport_mode'] == $entry2['transport_mode']) {
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

// Fetch additional profile and photo information for the matched entries
$matched_profiles = [];
foreach ($matches as $match) {
    $student_id = $match['幫你搬']['student_id'];
    $sql_profile = "SELECT Name FROM Profile WHERE ID = '$student_id'";
    $result_profile = $conn->query($sql_profile);
    if ($result_profile === false) {
        die("Error fetching profile data: " . $conn->error);
    } else {
        while ($row = $result_profile->fetch_assoc()) {
            $profile_data = $row;
        }
    }

    $sql_photo = "SELECT photo_content FROM photo WHERE ID = '$student_id'";
    $result_photo = $conn->query($sql_photo);
    if ($result_photo === false) {
        die("Error fetching photo data: " . $conn->error);
    } else {
        while ($row = $result_photo->fetch_assoc()) {
            $photo_data = $row;
        }
    }

    $matched_profiles[] = array_merge($match, ['profile' => $profile_data], ['photo' => $photo_data]);
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>Matching Entries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .profile {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }
        .profile img {
            border-radius: 50%;
            margin-right: 10px;
            width: 50px;
            height: 50px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Matching Entries</h1>
        <?php if (!empty($matched_profiles)): ?>
            <?php foreach ($matched_profiles as $match): ?>
                <div class="profile">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($match['photo']['photo_content']); ?>" alt="Avatar">
                    <div class="profile-info">
                        <strong>學號: <?php echo htmlspecialchars($match['幫你搬']['student_id']); ?></strong>
                        <strong>名字: <?php echo htmlspecialchars($match['profile']['Name']); ?></strong>
                        <p>可用時間: <?php echo htmlspecialchars($match['幫你搬']['available_time']); ?></p>
                        <p>搬家服務: <?php echo htmlspecialchars($match['幫你搬']['move_services']); ?></p>
                        <p>交通工具: <?php echo htmlspecialchars($match['幫你搬']['transport_mode']); ?></p>
                        <p>起始地點: <?php echo htmlspecialchars($match['幫你搬']['start_location']); ?></p>
                        <p>備註: <?php echo htmlspecialchars($match['幫你搬']['note']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No matches found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
