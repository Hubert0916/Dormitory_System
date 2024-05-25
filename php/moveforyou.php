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
            background-color: #f8f9fa;
            font-family: 'Noto Sans TC', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
            width: 80%;
            max-width: 1000px;
            height: 80%;
        }
        .box {
            width: 30%;
            height: 80%;
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
            border-color: #007bff;
        }
        .box p {
            margin-top: 20px;
            font-size: 18px;
            color: #495057;
        }
        .question {
            display: none;
        }
        .question.active {
            display: block;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid blue;
        }
        th, td {
            text-align: center;
            padding: 10px;
        }
        .selectable {
            cursor: pointer;
        }
        .selected {
            background-color: lightblue;
        }
        .options-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }
        .location-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
            max-width: 1000px;
        }
        .button {
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
        .button:hover {
            background-color: #343a40;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <form id="questionForm" action="submit.php" method="POST">
        <div class="question active" id="question1">
            <label for="time">你有空的時間：</label>
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
            <label for="services">搬家資訊 (可複選)：</label>
            <div class="options-row">
                <div class="box service-option" data-service="雜物">
                    <img src="../pic/grocery.png" alt="雜物">
                    <p>雜物</p>
                </div>
                <div class="box service-option" data-service="衣服">
                    <img src="../pic/clothes.png" alt="衣服">
                    <p>衣服</p>
                </div>
                <div class="box service-option" data-service="大型物件">
                    <img src="../pic/furniture.png" alt="大型物件">
                    <p>大型物件</p>
                </div>
            </div>
            <input type="hidden" id="services" name="services" value="">
            <button type="button" class="button" onclick="nextQuestion(2)">下一題</button>
        </div>
        <div class="question" id="question3">
            <label for="transport">交通工具：</label>
            <div class="options-row">
                <div class="box transport-option" data-transport="汽車">
                    <img src="../pic/car.png" alt="汽車">
                    <p>汽車</p>
                </div>
                <div class="box transport-option" data-transport="徒手">
                    <img src="../pic/walking.png" alt="徒手">
                    <p>徒手</p>
                </div>
                <div class="box transport-option" data-transport="拖車">
                    <img src="../pic/trailer.png" alt="拖車">
                    <p>拖車</p>
                </div>
            </div>
            <input type="hidden" id="transport" name="transport" value="">
            <button type="button" class="button" onclick="nextQuestion(3)">下一題</button>
        </div>
        <div class="question" id="question4">
            <label for="location">開始的地點：</label>
            <div class="location-options">
                <div class="box location-option" data-location="地點1">
                    <img src="../pic/8.jpg" alt="地點1">
                    <p>8舍</p>
                </div>
                <div class="box location-option" data-location="地點2">
                    <img src="../pic/9.jpg" alt="地點2">
                    <p>9舍</p>
                </div>
                <div class="box location-option" data-location="地點3">
                    <img src="../pic/10.jpg" alt="地點3">
                    <p>10舍</p>
                </div>
                <div class="box location-option" data-location="地點4">
                    <img src="../pic/11.jpg" alt="地點4">
                    <p>11舍</p>
                </div>
                <div class="box location-option" data-location="地點5">
                    <img src="../pic/12.jpg" alt="地點5">
                    <p>12舍</p>
                </div>
                <div class="box location-option" data-location="地點6">
                    <img src="../pic/13.jpg" alt="地點6">
                    <p>13舍</p>
                </div>
                <div class="box location-option" data-location="地點7">
                    <img src="../pic/7.jpg" alt="地點7">
                    <p>7舍</p>
                </div>
                <div class="box location-option" data-location="地點8">
                    <img src="../pic/girl2.jpg" alt="地點8">
                    <p>女二舍</p>
                </div>
                <div class="box location-option" data-location="地點9">
                    <img src="../pic/xuan.jpg" alt="地點9">
                    <p>竹軒</p>
                </div>
                <div class="box location-option" data-location="地點10">
                    <img src="../pic/1+.jpg" alt="地點10">
                    <p>研一舍</p>
                </div>
                <div class="box location-option" data-location="地點11">
                    <img src="../pic/2+.jpg" alt="地點11">
                    <p>研二舍</p>
                </div>
                <div class="box location-option" data-location="地點12">
                    <img src="../pic/3+.png" alt="地點12">
                    <p>研三舍</p>
                </div>
            </div>
            <input type="hidden" id="location" name="location" value="">
            <button type="button" class="button" onclick="nextQuestion(4)">下一題</button>
        </div>
        <div class="question" id="question5">
            <label for="budget">預算：</label>
            <div class="options-row">
                <div class="box budget-option" data-budget="1-200">
                    <img src="../pic/money1.png" alt="$1-200">
                    <p>$1~200</p>
                </div>
                <div class="box budget-option" data-budget="200-500">
                    <img src="../pic/money2.png" alt="$200-500">
                    <p>$200~500</p>
                </div>
                <div class="box budget-option" data-budget="500-1000">
                    <img src="../pic/money3.png"  alt="$500-1000">
                    <p>$500~1000</p>
                </div>
                <div class="box budget-option" data-budget="1000-up">
                    <img src="../pic/money4.png" alt="$1000-up">
                    <p>$1000↑</p>
                </div>
            </div>
            <input type="hidden" id="budget" name="budget" value="">
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

        let selectedLocations = [];

        document.querySelectorAll('.location-option').forEach(option => {
            option.addEventListener('click', function() {
                this.classList.toggle('selected');
                const locationValue = this.getAttribute('data-location');
                if (this.classList.contains('selected')) {
                    selectedLocations.push(locationValue);
                } else {
                    selectedLocations = selectedLocations.filter(location => location !== locationValue);
                }
                document.getElementById('location').value = selectedLocations.join(',');
            });
        });

        let selectedBudget = '';

        document.querySelectorAll('.budget-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.budget-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                selectedBudget = this.getAttribute('data-budget');
                document.getElementById('budget').value = selectedBudget;
            });
        });

        function nextQuestion(currentQuestion) {
            document.getElementById('question' + currentQuestion).classList.remove('active');
            document.getElementById('question' + (currentQuestion + 1)).classList.add('active');
        }
    </script>
</body>
</html>
