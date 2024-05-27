<?php
    include "connection.php";

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $stmt = $conn->prepare("SELECT photo_name, photo_type, photo_size, photo_content FROM photo WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($photo_name, $photo_type, $photo_size, $photo_content);
            $stmt->fetch();

            header("Content-Type: " . $photo_type);
            header("Content-Length: " . $photo_size);
            
            echo $photo_content;
        } else {
            echo "No image found with the specified ID.";
        }
        
        $stmt->close();
    } 
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Photo</title>
</head>
<body>
    <h2>Display Photo</h2>
    <img src="display.php?id=4535" alt="Photo">
</body>
</html>
