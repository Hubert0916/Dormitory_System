<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>Move Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            font-family: 'Noto Sans TC', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            justify-content: center; /* 改為 center 以便將方塊向中間靠攏 */
            gap: 20px; /* 增加間距控制 */
            width: 80%;
            max-width: 1000px;
        }
        .box {
            width: 30%; /* 減小寬度 */
            height: 100%; /* 增加高度 */
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
            background-color: #495057;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .box a:hover {
            background-color: #343a40;
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
