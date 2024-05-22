<?php
    include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/report.css">
    <title>Report System</title>
</head>
<body>
    <?php include "overlay_nav.php"; ?>
    <div id="form">
        <form name="form" method="POST">
            <input type="text" id="dorm" name="dorm" required autofocus>
            <label for="dorm">
                <span class="label-text">Dorm</span>
                <span class="nav-dot"></span>
                <div class="submit-button-trigger">Submit</div>
            </label>

            <input type="text" id="room" name="room" required>
            <label for="room">
                <span class="label-text">room</span>
                <span class="nav-dot"></span>
                <div class="submit-button-trigger">Submit</div>
            </label>

            <input type="text" id="reason" name="reason" required>
            <label for="reason">
                <span class="label-text">reason</span>
                <span class="nav-dot"></span>
                <div class="submit-button-trigger">Submit</div>
            </label>

            <button type="submit">Submit</button>
            <p class="tip">Press Tab</p>
            <div class="submit-button">Report System</div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>

</html>