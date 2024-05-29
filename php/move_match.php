<?php
require_once 'connection.php';
//require_once dirname(__FILE__) . "/overlay_nav.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "幫你搬" table
$sql = "SELECT student_id, available_time, move_services, transport_mode, start_location, note FROM move_service";
$result = $conn->query($sql);
$data = [];
if ($result === false) {
    die("Error fetching data from move_service: " . $conn->error);
} else {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Function to split strings into arrays
function splitValues($string) {
    return explode(',', $string);
}

// Function to find matches with at least one overlapping available_time and move_services
function findMatches($data) {
    // This example assumes we're matching against a predefined set of criteria
    $desired_times = splitValues("mon_morning,tue_morning");
    $desired_services = splitValues("雜物,衣服");
    $desired_transport_mode = "汽車"; // Example criteria

    $matches = [];
    foreach ($data as $entry) {
        $times = splitValues($entry['available_time']);
        $services = splitValues($entry['move_services']);
        if (array_intersect($times, $desired_times) && 
            array_intersect($services, $desired_services) && 
            $entry['transport_mode'] == $desired_transport_mode) {
            $matches[] = $entry;
        }
    }
    return $matches;
}

$matches = findMatches($data);
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
        <?php if (!empty($matches)): ?>
            <?php foreach ($matches as $match): ?>
                <div class="profile">
                    <img src="path/to/default-avatar.png" alt="Avatar" width="50" height="50">
                    <div class="profile-info">
                        <strong>學號: <?php echo htmlspecialchars($match['student_id']); ?></strong>
                        <p>可用時間: <?php echo htmlspecialchars($match['available_time']); ?></p>
                        <p>搬家服務: <?php echo htmlspecialchars($match['move_services']); ?></p>
                        <p>交通工具: <?php echo htmlspecialchars($match['transport_mode']); ?></p>
                        <p>起始地點: <?php echo htmlspecialchars($match['start_location']); ?></p>
                        <p>備註: <?php echo htmlspecialchars($match['note']); ?></p>
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
