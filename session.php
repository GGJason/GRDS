<?php
	session_start();
	if($_SESSION["login"]!="OK") {
		$_SESSION["login"] = "Fail";
		echo header("Location: ./home.html");
	}
?>
