<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>Move Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            display: flex;
            justify-content: space-between;
            width: 80%;
            max-width: 1000px;
        }
        .box {
            width: 45%;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }
        .box img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .box button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .box button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <img src="../pic/vehicle.png" alt="Vehicle">
            <button>帮你搬</button>
        </div>
        <div class="box">
            <img src="../pic/boxes.png" alt="Boxes">
            <button>幫我搬</button>
        </div>
    </div>
</body>
</html>
