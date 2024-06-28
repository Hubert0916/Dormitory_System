<?php
	$servername = "localhost";
	$username = "root";
	$password = "0000";
	$db_name = "Dorm";
	$conn = new mysqli($servername, $username, $password, $db_name);
	
	if($conn->connect_error)
	{
		die("Connection failed. $conn->connect_error");
	}
?>
