<?php
    include "connection.php";

    // 檢查是否有指定的圖片ID
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        // 查詢圖片資料
        $stmt = $conn->prepare("SELECT photo_name, photo_type, photo_size, photo_content FROM photo WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        
        // 檢查是否找到圖片
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($photo_name, $photo_type, $photo_size, $photo_content);
            $stmt->fetch();

            // 設定HTTP標頭
            header("Content-Type: " . $photo_type);
            header("Content-Length: " . $photo_size);
            
            // 輸出圖片內容
            echo $photo_content;
        } else {
            echo "No image found with the specified ID.";
        }
        
        // 關閉語句
        $stmt->close();
    } else {
        echo "No image ID specified.";
    }

    // 關閉資料庫連線
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
    <img src="display.php?id=1" alt="Photo">
</body>
</html>
