<?php
	session_start();
	$_SESSION['login']='Fail';
	header("Location: index.php");
?>