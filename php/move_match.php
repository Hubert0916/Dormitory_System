<?php
require_once 'connection.php';
require_once dirname(__FILE__) . "/overlay_nav.php";

// Fetch data from the "幫我搬" table
echo "111";
$sql1 = "SELECT student_id, available_time, move_services, transport_mode FROM Dorm.move_requests";

$result1 = mysqli_query($conn, $sql1);
$data1 = [];
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $data1[] = $row;
    }
}

// Fetch data from the "幫你搬" table
$sql2 = "SELECT student_id, available_time, move_services, transport_mode, start_location, note FROM Dorm.move_service";
$result2 = mysqli_query($conn, $sq2);
$data2 = [];
if ($result2->num_rows > 0) {
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
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>Matching Entries</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Matching Entries</h1>
    <?php if (!empty($matches)): ?>
        <table>
            <tr>
                <th>幫我搬 Student ID</th>
                <th>幫我搬 Available Time</th>
                <th>幫我搬 Move Services</th>
                <th>幫我搬 Transport Mode</th>
                <th>幫你搬 Student ID</th>
                <th>幫你搬 Available Time</th>
                <th>幫你搬 Move Services</th>
                <th>幫你搬 Transport Mode</th>
                <th>幫你搬 Start Location</th>
                <th>幫你搬 Note</th>
            </tr>
            <?php foreach ($matches as $match): ?>
                <tr>
                    <td><?php echo $match['幫我搬']['student_id']; ?></td>
                    <td><?php echo $match['幫我搬']['available_time']; ?></td>
                    <td><?php echo $match['幫我搬']['move_services']; ?></td>
                    <td><?php echo $match['幫我搬']['transport_mode']; ?></td>
                    <td><?php echo $match['幫你搬']['student_id']; ?></td>
                    <td><?php echo $match['幫你搬']['available_time']; ?></td>
                    <td><?php echo $match['幫你搬']['move_services']; ?></td>
                    <td><?php echo $match['幫你搬']['transport_mode']; ?></td>
                    <td><?php echo $match['幫你搬']['start_location']; ?></td>
                    <td><?php echo $match['幫你搬']['note']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No matches found.</p>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
