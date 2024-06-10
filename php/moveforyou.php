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
            justify-content: center;
            gap: 20px;
            width: 100%;
            max-width: 1000px;
            height: 100%;
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
            background-color: #ADC2A9;
        }
        .box p {
            margin-top: 20px;
            font-size: 25px;
            color: #576F72;
        }
        .question {
            display: none;
        }
        .question.active {
            display: block;
        }
        table {
            border-collapse: collapse;
            width: 140%;
            height: 40%;
            font-size: 25px;
            margin-left: -20%;
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
        .note {
            margin-top: 10px;
            font-size: 14px;
            color: #6c757d;
            text-align: center;
        }
        .textarea-container {
            margin-top: 20px;
            width: 100%;
            text-align: center;
        }
        .textarea-container textarea {
            width: 80%;
            height: 100px;
            padding: 10px;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            font-size: 16px;
            resize: none;
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>
</head>
<body>
    <form id="questionForm" action="offer.php" method="POST">
        <div class="question active" id="question1">
            <label for="time" class="move">你有空的時間：</label>
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
            <label for="services" class="move">搬家資訊 (可複選)：</label>
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
            <label for="transport" class="move">交通工具：</label>
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
            <button type="button" class="button" onclick="nextQuestion(3)">下一題</button>
        </div>
        <div class="question" id="question4">
            <label for="location">開始的地點：</label>
            <div class="location-options">
                <div class="box location-option" data-location="8舍">
                    <img src="../pic/8.jpg" alt="8舍">
                    <p>8舍</p>
                </div>
                <div class="box location-option" data-location="9舍">
                    <img src="../pic/9.jpg" alt="9舍">
                    <p>9舍</p>
                </div>
                <div class="box location-option" data-location="10舍">
                    <img src="../pic/10.jpg" alt="10舍">
                    <p>10舍</p>
                </div>
                <div class="box location-option" data-location="11舍">
                    <img src="../pic/11.jpg" alt="11舍">
                    <p>11舍</p>
                </div>
                <div class="box location-option" data-location="12舍">
                    <img src="../pic/12.jpg" alt="12舍">
                    <p>12舍</p>
                </div>
                <div class="box location-option" data-location="13舍">
                    <img src="../pic/13.jpg" alt="13舍">
                    <p>13舍</p>
                </div>
                <div class="box location-option" data-location="7舍">
                    <img src="../pic/7.jpg" alt="7舍">
                    <p>7舍</p>
                </div>
                <div class="box location-option" data-location="女二舍">
                    <img src="../pic/girl2.jpg" alt="女二舍">
                    <p>女二舍</p>
                </div>
                <div class="box location-option" data-location="竹軒">
                    <img src="../pic/xuan.jpg" alt="竹軒">
                    <p>竹軒</p>
                </div>
                <div class="box location-option" data-location="研一舍">
                    <img src="../pic/1+.jpg" alt="研一舍">
                    <p>研一舍</p>
                </div>
                <div class="box location-option" data-location="研二舍">
                    <img src="../pic/2+.jpg" alt="研二舍">
                    <p>研二舍</p>
                </div>
                <div class="box location-option" data-location="研三舍">
                    <img src="../pic/3+.png" alt="研三舍">
                    <p>研三舍</p>
                </div>
            </div>
            <input type="hidden" id="location" name="location" value="">
            <button type="button" class="button" onclick="nextQuestion(4)">下一題</button>
        </div>
        <div class="question" id="question5">
            <label for="notes">其他特殊需求：</label>
            <div class="textarea-container">
                <textarea id="notes" name="notes" placeholder="請在此輸入其他特殊需求..."></textarea>
            </div>
            <button type="submit" class="button">提交</button>
        </div>
    </form>
    <script>
        // Your existing JavaScript code

        // Function to handle form submission
        document.getElementById('questionForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('offer.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: '申請完成',
                        text: '您的申請已完成，請靜待通知',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'move.php';
                    });
                } else {
                    Swal.fire({
                        title: '錯誤',
                        text: data.message,
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: '錯誤',
                    text: '提交過程中發生錯誤，請稍後再試',
                    icon: 'error'
                });
            });
        });
    </script>
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

        function nextQuestion(currentQuestion) {
            document.getElementById('question' + currentQuestion).classList.remove('active');
            document.getElementById('question' + (currentQuestion + 1)).classList.add('active');
        }
    </script>
</body>
</html>
