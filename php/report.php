<?php
    include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form
        {
            background-color: rgb(255, 255, 255);
            width:30%;
            border: 6px solid #f6efef;
            border-radius: 10px;
            margin:120px auto;
            padding:40px;
            box-shadow: 10px 10px 5px rgb(0, 0, 0);
        }
    </style>
</head>
<body>
    <?php include "overlay_nav.php"; ?>
        <div id="form">
            <form name="form" action="login.php" method="POST">
                <h2 class=text-center>Report System</h2>
                <hr><br>
                <label>Dorm</label><br>
                <input type="text" id="dorm" name="dorm" required>
                <br><br>
                <label>Room Number</label><br>
                <input type="text" id="room" name="room" required>
                <br><br>
                <label>Reason</label><br>
                <input type="text" id="reason" name="reason" required>
                <br><br>
                <?php
                    if(isset($_POST['submit']))
                    {
                        if($error)
                            echo '<p class="error"><i class="bi bi-exclamation-triangle"></i> ' . $error . '</p>';
                    }
                ?>
                <br>
                <input type="submit" id="btn" value="Submit" name="submit">
            </form>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>

</html>