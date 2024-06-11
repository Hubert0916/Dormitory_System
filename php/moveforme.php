<?php
    require_once dirname(__FILE__) . "/overlay_nav.php";
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問答表單</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #F0EBE3;
            font-family: "Noto Serif TC", serif !important;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 1000px;
            height: 100%;
            padding: 20px;
        }
        .box {
            width: 100%;
            height: 100%;
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
            align-items: center;
            cursor: pointer;
        }
        .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .box img {
            width: 100%;
            max-width: 200px;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }
        .box.selected {
            background-color: #99A799;
        }
        .box p {
            margin-top: 20px;
            font-size: 25px;
            color: #576F72;
        }
        .box.selected p {
            color: #F0EBE3;
        }
        .question {
            display: none;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 100%;
            text-align: center;
            margin-top: 250px;
        }
        .question.active {
            display: flex;
        }
        table {
            border-collapse: collapse;
            width: 140%;
            height: 40%;
            font-size: 25px;
            margin-left: -1%;
        }
        table, th, td {
            border: 2px solid #576F72;
        }
        th, td {
            text-align: center;
            padding: 10px;
        }
        .selectable {
            cursor: pointer;
        }
        .selected {
            background-color: #99A799;
        }
        .options-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            background-color: #576F72;
            border: none;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .button:hover {
            background-color: #99A799;
            transform: translateY(-2px);
        }
        .note {
            margin-top: 10px;
            font-size: 14px;
            color: #6c757d;
            text-align: center;
        }
        .move {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
            color: #576F72;
            font-size: 25px;
        }
    </style>
</head>
<body>
    <form id="questionForm" action="submit.php" method="post">
        <div class="question active" id="question1">
            <label for="time" class="move">你 有 空 的 時 間：</label>
            <table>
                <tr>
                    <th>時間</th>
                    <th>一</th>
                    <th>二</th>
                    <th>三</th>
                    <th>四</th>
                    <th>五</th>
                    <th>六</th>
                    <th>日</th>
                </tr>
                <tr>
                    <td>早</td>
                    <td class="selectable" data-time="mon_morning"></td>
                    <td class="selectable" data-time="tue_morning"></td>
                    <td class="selectable" data-time="wed_morning"></td>
                    <td class="selectable" data-time="thu_morning"></td>
                    <td class="selectable" data-time="fri_morning"></td>
                    <td class="selectable" data-time="sat_morning"></td>
                    <td class="selectable" data-time="sun_morning"></td>
                </tr>
                <tr>
                    <td>中</td>
                    <td class="selectable" data-time="mon_afternoon"></td>
                    <td class="selectable" data-time="tue_afternoon"></td>
                    <td class="selectable" data-time="wed_afternoon"></td>
                    <td class="selectable" data-time="thu_afternoon"></td>
                    <td class="selectable" data-time="fri_afternoon"></td>
                    <td class="selectable" data-time="sat_afternoon"></td>
                    <td class="selectable" data-time="sun_afternoon"></td>
                </tr>
                <tr>
                    <td>晚</td>
                    <td class="selectable" data-time="mon_evening"></td>
                    <td class="selectable" data-time="tue_evening"></td>
                    <td class="selectable" data-time="wed_evening"></td>
                    <td class="selectable" data-time="thu_evening"></td>
                    <td class="selectable" data-time="fri_evening"></td>
                    <td class="selectable" data-time="sat_evening"></td>
                    <td class="selectable" data-time="sun_evening"></td>
                </tr>
            </table>
            <input type="hidden" id="time" name="time" value="">
            <button type="button" class="button" onclick="nextQuestion(1)">繼續</button>
        </div>
        <div class="question" id="question2">
            <label for="services" class="move">搬 家 資 訊 (可複選)：</label>
            <div class="options-row">
                <div class="box service-option" data-service="雜物">
                    <img src="../pic/thing.webp" alt="雜物">
                    <p>雜物</p>
                </div>
                <div class="box service-option" data-service="衣服">
                    <img src="../pic/clothes.webp" alt="衣服">
                    <p>衣服</p>
                </div>
                <div class="box service-option" data-service="大型物件">
                    <img src="../pic/furniture.webp" alt="大型物件">
                    <p>大型物件</p>
                </div>
            </div>
            <input type="hidden" id="services" name="services" value="">
            <button type="button" class="button" onclick="nextQuestion(2)">下一題</button>
        </div>
        <div class="question" id="question3">
            <label for="transport" class="move">你 想 用 什 麼 交 通 工 具？</label>
            <div class="options-row">
                <div class="box transport-option" data-transport="汽車">
                    <img src="../pic/car.webp" alt="汽車">
                    <p>汽車</p>
                </div>
                <div class="box transport-option" data-transport="徒手">
                    <img src="../pic/hands.png" alt="徒手">
                    <p>徒手</p>
                </div>
                <div class="box transport-option" data-transport="拖車">
                    <img src="../pic/cart.png" alt="拖車">
                    <p>拖車</p>
                </div>
            </div>
            <div class="note">
                徒手一趟$50，拖車一趟$150，汽車一趟$250
            </div>
            <input type="hidden" id="transport" name="transport" value="">
            <button type="submit" class="button">開始尋找</button>
        </div>
    </form>

    <script>
        let selectedTimes = [];

        document.querySelectorAll('.selectable').forEach(cell => {
            cell.addEventListener('click', function() {
                this.classList.toggle('selected');
                const timeValue = this.getAttribute('data-time');
                if (this.classList.contains('selected')) {
                    selectedTimes.push(timeValue);
                } else {
                    selectedTimes = selectedTimes.filter(time => time !== timeValue);
                }
                document.getElementById('time').value = selectedTimes.join(',');
            });
        });

        let selectedServices = [];

        document.querySelectorAll('.service-option').forEach(option => {
            option.addEventListener('click', function() {
                this.classList.toggle('selected');
                const serviceValue = this.getAttribute('data-service');
                if (this.classList.contains('selected')) {
                    selectedServices.push(serviceValue);
                } else {
                    selectedServices = selectedServices.filter(service => service !== serviceValue);
                }
                document.getElementById('services').value = selectedServices.join(',');
            });
        });

        let selectedTransport = '';

        document.querySelectorAll('.transport-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.transport-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                selectedTransport = this.getAttribute('data-transport');
                document.getElementById('transport').value = selectedTransport;
            });
        });

        function nextQuestion(currentQuestion) {
            document.getElementById('question' + currentQuestion).classList.remove('active');
            document.getElementById('question' + (currentQuestion + 1)).classList.add('active');
        }
    </script>
</body>
</html>
