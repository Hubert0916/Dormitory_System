<?php
    require_once dirname(__FILE__) . "/overlay_nav.php";

    if (isset($_SESSION['ID'])) {

        if ($conn->connect_error) {
            die("Connection failed. $conn->connect_error");
        }
        $id = intval($_SESSION['ID']);
        $getRoommate_sql = $conn->prepare("SELECT pr.ID, pr.Name, ph.photo_type, ph.photo_content FROM Dorm.Profile as pr, Dorm.photo as ph WHERE pr.ID = ph.id and pr.id != ? and pr.Room = (SELECT p.Room from Dorm.Profile as p WHERE p.ID = ?) and pr.Dorm = (SELECT p.Dorm from Dorm.Profile as p WHERE p.ID = ?)");
        $getRoommate_sql->bind_param("iii", $id, $id, $id);
        $getRoommate_sql->execute();
        $getRoommate_sql->store_result();
    
        if ($getRoommate_sql->num_rows() > 0) {
            $getRoommate_sql->bind_result($RID, $Rname, $Rtype, $Rphoto);
    
            $roommates = [];
    
            while ($getRoommate_sql->fetch()) {
                $roommates[] = ['RID' => $RID, 'Rname' => $Rname, 'Rtype' => $Rtype, 'Rphoto' => base64_encode($Rphoto)];
            }
        }
        $getRoommate_sql->close();
    } else {
        echo "<script>alert('請先登入');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>Move Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #F0EBE3;
            font-family: 'Noto Sans TC', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
        .container {
            display: flex;
            justify-content: center; /* 改為 center 以便將方塊向中間靠攏 */
            gap: 20px; /* 增加間距控制 */
            width: 80%;
            max-width: 1000px;
            height: 80%; /* 確保容器有足夠高度 */
        }
        .box {
            width: 30%; /* 保持寬度不變 */
            height: 50%; /* 設置高度為 100% 以使用容器的高度 */
            background-color: #ffffff;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center; /* 添加這一行以致中圖片 */
            margin-top: 150px;
        }
        .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .box img {
            width: 100%;
            max-width: 200px; /* 固定圖片寬度 */
            height: auto;
            border-radius: 10px;
            object-fit: cover; /* 確保圖片被裁剪以適應容器 */
        }
        .box a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            background-color: #576F72;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .box a:hover {
            background-color: #99A799;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <img src="../pic/vehicle.png" alt="Vehicle">
            <a href="moveforyou.php">幫你搬</a>
        </div>
        <div class="box">
            <img src="../pic/boxes.png" alt="Boxes">
            <a href="moveforme.php">幫我搬</a>
        </div>
    </div>
</body>
</html>
