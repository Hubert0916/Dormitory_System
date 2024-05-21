<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問答表單</title>
    <style>
        .question {
            display: none;
        }
        .question.active {
            display: block;
        }
    </style>
</head>
<body>
    <form id="questionForm" action="submit.php" method="POST">
        <div class="question active" id="question1">
            <label for="time">你有空的時間：</label>
            <input type="text" id="time" name="time" required>
            <button type="button" onclick="nextQuestion(1)">下一題</button>
        </div>
        <div class="question" id="question2">
            <label for="location">提供的地點：</label>
            <input type="text" id="location" name="location" required>
            <button type="button" onclick="nextQuestion(2)">下一題</button>
        </div>
        <div class="question" id="question3">
            <label for="transport">交通工具：</label>
            <input type="text" id="transport" name="transport" required>
            <button type="button" onclick="nextQuestion(3)">下一題</button>
        </div>
        <div class="question" id="question4">
            <label for="salary">薪水：</label>
            <input type="text" id="salary" name="salary" required>
            <button type="submit">提交</button>
        </div>
    </form>

    <script>
        function nextQuestion(currentQuestion) {
            document.getElementById('question' + currentQuestion).classList.remove('active');
            document.getElementById('question' + (currentQuestion + 1)).classList.add('active');
        }
    </script>
</body>
</html>
