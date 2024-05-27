<?php
	$servername = "104.199.139.129";
	$username = "rdu";
	$password = "1234";
	$db_name = "Dorm";
	$conn = new mysqli($servername, $username, $password, $db_name);
	
	if($conn->connect_error)
	{
		die("Connection failed. $conn->connect_error");
	}
?>
