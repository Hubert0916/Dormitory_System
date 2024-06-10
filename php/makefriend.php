<?php
header('Content-Type: text/html; charset=UTF-8');
require_once dirname(__FILE__) . '/connection.php';
require_once dirname(__FILE__) . '/head.php';
require_once dirname(__FILE__)."/overlay_nav.php";

session_start();
if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit;
}

$getAllUsers_sql = $conn->prepare("SELECT ID, Name, Department, Grade FROM Dorm.Profile");
$getAllUsers_sql->execute();
$getAllUsers_sql->store_result();
$getAllUsers_sql->bind_result($id, $name, $department, $grade);

$users = array();
while ($getAllUsers_sql->fetch()) {
    $stmt_photo = $conn->prepare("SELECT photo_name, photo_type, photo_size, photo_content FROM photo WHERE ID = ?");
    $stmt_photo->bind_param("i", $id);
    $stmt_photo->execute();
    $result_photo = $stmt_photo->get_result();
    $photo = null;

    if ($result_photo->num_rows > 0) {
        $row_photo = $result_photo->fetch_assoc();
        $photo = $row_photo['photo_content'];
    }

    $users[] = [
        'ID' => $id,
        'Name' => $name,
        'Department' => $department,
        'Grade' => $grade,
        'Photo' => $photo
    ];
    $stmt_photo->close();
}
$getAllUsers_sql->free_result();
$getAllUsers_sql->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make Friends</title>
    <style>

        body {
            margin: 0;
            background-color: #F0EBE3 !important;
            font-family: "Noto Serif TC", serif;
        }
        .upper-section {
            background-color: #576F72;
            color: #F0EBE3;
            padding: 40px;
            text-align: center;
        }
        .user-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            margin-left: 80px;
            margin-right: 20px;
            margin-top: 20px;
        }
        .user-card {
            background-color: #FFF;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 250px;
            padding: 20px;
            text-align: center;
        }
        .profile-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .user-card h3, .user-card p {
            margin: 5px 0;
            font-size: 15px;
        }
        .user-card h3 {
            font-weight: bold;
            font-size: 23px;
            margin-bottom: 10px;
        }
        .view-profile {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #576F72;
            color: #F0EBE3;
            border-radius: 5px;
            text-decoration: none;
        }
        .view-profile:hover {
            background-color: #3C4A4D;
            color: #F0EBE3;
        }

    </style>
</head>
<body>
<section class="upper-section">
        <h2>Make  Friends</h2>
</section>

<section class="user-list">
    <?php foreach ($users as $user): ?>
        <div class="user-card">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($user['Photo']); ?>" class="profile-photo" alt="Profile Photo">
            <h3><?php echo htmlspecialchars($user['Name']); ?></h3>
            <p>科系 : <?php echo htmlspecialchars($user['Department']); ?></p>
            <p>年級 : <?php echo htmlspecialchars($user['Grade']); ?></p>
            <a href="friendprofile.php?id=<?php echo $user['ID']; ?>" class="view-profile">View Profile</a>
        </div>
    <?php endforeach; ?>
</section>
</body>
</html>
