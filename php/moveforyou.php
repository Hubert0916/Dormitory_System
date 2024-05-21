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
            height: 80%; /* 確保容器有足夠高度 */
        }
        .box {
            width: 30%; /* 保持寬度不變 */
            height: 80%; /* 設置高度為 80% 以使用容器的高度 */
            background-color: #ffffff;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center; /* 添加這一行以致中圖片 */
            cursor: pointer;
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
        .selected {
            background-color: #007bff;
            color: white;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const boxes = document.querySelectorAll('.box');
            boxes.forEach(box => {
                box.addEventListener('click', function () {
                    boxes.forEach(b => b.classList.remove('selected'));
                    box.classList.add('selected'); 
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="box">
            <img src="../pic/grocery.png" alt="Miscellaneous">
            <p>雜物</p>
        </div>
        <div class="box">
            <img src="../pic/clothes.png" alt="Clothes">
            <p>衣服</p>
        </div>
        <div class="box">
            <img src="../pic/largeitems.png" alt="Large Items">
            <p>大</p>
        </div>
    </div>
</body>
</html>
