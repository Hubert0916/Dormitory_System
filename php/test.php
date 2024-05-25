<?php
    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        // 取得上傳檔案資訊
        $fileTmpPath = $_FILES["photo"]["tmp_name"];
        $fileName = $_FILES["photo"]["name"];
        $fileSize = $_FILES["photo"]["size"];
        $fileType = $_FILES["photo"]["type"];
        
        // 讀取檔案內容
        $fileContent = file_get_contents($fileTmpPath);
    
        // 準備 SQL 語句
        $stmt = $conn->prepare("INSERT INTO photo (photo_name, photo_type, photo_size, photo_content) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssib", $fileName, $fileType, $fileSize, $null);
    
        // 為 BLOB 資料設定長度
        $stmt->send_long_data(3, $fileContent);
    
        // 執行 SQL 語句
        if ($stmt->execute()) {
            echo "File uploaded successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        // 關閉語句和連線
        $stmt->close();
    } else {
        echo "No file uploaded or there was an upload error.";
    }
    
    // 關閉資料庫連線
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Photo</title>
</head>
<body>
    <h2>Upload Photo</h2>
    <form action="test.php" method="post" enctype="multipart/form-data">
        <input type="file" name="photo" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
