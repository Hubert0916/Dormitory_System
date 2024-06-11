<?php
header('Content-Type: text/html; charset=UTF-8');
require_once dirname(__FILE__) . '/connection.php';
require_once dirname(__FILE__) . '/head.php';
require_once dirname(__FILE__)."/overlay_nav.php";


// 檢查是否提供了使用者ID
if (!isset($_GET['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];

// 查詢使用者的詳細資料
$stmt = $conn->prepare("SELECT ID, Name, Sex, Department, Grade, Dorm, Room, Phone, Email, FB, IG, Intro FROM Dorm.Profile WHERE ID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    echo "未找到該使用者的資料。";
    exit;
}
$stmt->close();

// 查詢使用者的照片
$stmt_photo = $conn->prepare("SELECT photo_name, photo_type, photo_size, photo_content FROM photo WHERE ID = ?");
$stmt_photo->bind_param("i", $id);
$stmt_photo->execute();
$result_photo = $stmt_photo->get_result();
$photo = null;

if ($result_photo->num_rows > 0) {
    $row_photo = $result_photo->fetch_assoc();
    $photo = $row_photo['photo_content'];
}
$stmt_photo->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make Friend</title>
    <style>
        body {
            font-family: "Noto Serif TC", serif;
            background-color: #F0EBE3;
            color: #000;
        }
        .upper-section {
            background-color: #576F72;
            color: #F0EBE3;
            padding: 20px;
            text-align: center;
            height: 150px;
        } 
        .upper-section h2 {
            align-items: center;
            justify-content: center;
            margin-top: 30px;
        }
        .user-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }
        .user-profile img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .user-profile h3, .user-profile p {
            margin: 5px 0;
        }
        .info-container {
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
            margin-top: 18px;
        }
        .icon {
            display: flex;
            gap: 15px;
            flex-direction: column;   
            justify-content: center;
        }
        .icon a {
            color: #000;
            text-decoration: none;
        }
        .icon svg {
            width: 17px;
            height: 17px;
            color: #576F72;

        }
        .up {
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }
        .down {
            display: flex;
            gap: 20px;;
        }
        .left, .right {
            flex: 1;
            margin: 18px;
        }
        .left p, .right p {
            margin: 8px 0;
        }
        h2 {
            font-size: 40px;
            font-weight: bold;
            margin-left: 0px;
        }
    </style>
</head>
<body>
<section class="upper-section">
    <h2>More about me</h2>
</section>

<section class="user-profile">
    <div class="info-container">
        <div class="up">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>" alt="Profile Photo">
            <div class="icon">
                <a href="mailto:<?php echo htmlspecialchars($user_data['Email']); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"></path>
                    </svg>
                </a>
                <a href="tel:<?php echo htmlspecialchars($user_data['Phone']); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"></path>
                    </svg>
                </a>
                <a href="<?php echo htmlspecialchars($user_data['FB']); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                    </svg>
                </a>
                <a href="<?php echo htmlspecialchars($user_data['IG']); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="down">
            <div class="left">
                <p>名字 : <?php echo htmlspecialchars($user_data['Name']); ?></p>
                <p>性別 : <?php echo htmlspecialchars($user_data['Sex']); ?></p>
                <p>系別 : <?php echo htmlspecialchars($user_data['Department']); ?></p>
                <p>年級 : <?php echo htmlspecialchars($user_data['Grade']); ?></p>
                <p>宿舍 : <?php echo htmlspecialchars($user_data['Dorm']) . " " . htmlspecialchars($user_data['Room']); ?></p>
            </div>
            <div class="right">
                <p>小簡介＆近期的我 : </p>
                <p><?php echo nl2br(htmlspecialchars($user_data['Intro'])); ?></p>
            </div>
        </div>
    </div>
</section>
</body>
</html>
