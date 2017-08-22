<?php 
	session_start();
	include 'generalDBFunctions.php';

	if(!isAdmin($_SESSION['user_id'])) {
		header("Location:../home/home.php");
		die();
	}
?>