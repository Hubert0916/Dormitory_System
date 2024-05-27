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
            flex-direction: column;
            align-items: center;
            width: 80%;
            max-width: 1000px;
        }
        .question {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }
        .box {
            width: 20%;
            background-color: #ffffff;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            margin: 0 10px;
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
    </style>
</head>
<body>
    <form id="questionForm" action="submit.php" method="POST" class="container">
        <div class="question active" id="question1">
            <label for="sleep_habit">睡眠習慣：</label>
            <div class="box sleep-option" data-sleep="10點~12點">
                <p>10點~12點</p>
            </div>
            <div class="box sleep-option" data-sleep="12點~2點">
                <p>12點~2點</p>
            </div>
            <div class="box sleep-option" data-sleep="2點~4點">
                <p>2點~4點</p>
            </div>
            <div class="box sleep-option" data-sleep="4點~6點">
                <p>4點~6點</p>
            </div>
            <input type="hidden" id="sleep_habit" name="sleep_habit" value="">
            <button type="button" class="button" onclick="nextQuestion(1)">下一題</button>
        </div>
        <div class="question" id="question2">
            <label for="dorm_volume">宿舍音量：</label>
            <div class="box volume-option" data-volume="完全無聲音">
                <p>完全無聲音</p>
            </div>
            <div class="box volume-option" data-volume="可接受交談聲">
                <p>可接受交談聲</p>
            </div>
            <div class="box volume-option" data-volume="可接受嘈雜聲">
                <p>可接受嘈雜聲</p>
            </div>
            <input type="hidden" id="dorm_volume" name="dorm_volume" value="">
            <button type="submit" class="button">提交</button>
        </div>
    </form>

    <script>
        let selectedSleepHabit = '';

        document.querySelectorAll('.sleep-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.sleep-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                selectedSleepHabit = this.getAttribute('data-sleep');
                document.getElementById('sleep_habit').value = selectedSleepHabit;
            });
        });

        let selectedVolume = '';

        document.querySelectorAll('.volume-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.volume-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                selectedVolume = this.getAttribute('data-volume');
                document.getElementById('dorm_volume').value = selectedVolume;
            });
        });

        function nextQuestion(currentQuestion) {
            document.getElementById('question' + currentQuestion).classList.remove('active');
            document.getElementById('question' + (currentQuestion + 1)).classList.add('active');
        }
    </script>
</body>
</html>
