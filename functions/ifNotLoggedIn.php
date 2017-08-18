<?php
	session_start();
	if(!isset($_SESSION['user_id'])) {
		header("Location:destroy_session.php");
		die();
	}
?>