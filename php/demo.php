<?php
require_once dirname(__FILE__) . "/session.php";

if (isset($_SESSION['ID'])) {
    echo "Session ID is set. Value: " . $_SESSION['id'];
} else {
    echo "Session ID is not set.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>