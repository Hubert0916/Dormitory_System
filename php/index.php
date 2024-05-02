<?php
	$servername = "44.216.88.91";
	$username = "guest";
	$password = "1234";
	$db_name = "USER";
	$conn = new mysqli($servername, $username, $password, $db_name);

	if($conn->connect_error)
	{
		die("Connection failed. $conn->connect_error");
	}
	else
		echo "Connect Successfully!!!";

	$sql = "select * from user_profile where name = 'Alice'";
    $row = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);

	echo "Hello, " . $row['name'];
?>
