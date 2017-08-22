<?php
	session_start();
	if(!isset($_SESSION['user_id'])) {
		header("Location:../../functions/destroy_session.php");
		die();
	}
?>