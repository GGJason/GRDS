<?php
	require_once("session.php");
	require_once("config.php");
	$conn = new mysqli($db_host, $db_user, $db_passwd);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SHOW TABLES";
	$result = $conn->query($sql);
	
	echo $result;

	$conn->close();
?>
