<?php 
	session_start();
	require_once "sql_connect.php";

	$email = $_POST['inputEmail'];
	$pass = $_POST['inputPassword'];
	$pass_db = null;

	$query = 'SELECT * FROM `users` WHERE `email` = "'.$email.'"';
	$result = mysqli_query($mysqli, $query);

	if($result) {
		$row = mysqli_fetch_assoc($result);

		$pass_db = $row['password'];
	} else {
		$_SESSION['error'] = "Username or Password is invalid.";
		header("Location: ../index?err");
		die();
	}

	if( password_verify($pass, $pass_db) ) {

		$_SESSION['loggedin'] = true;
		$_SESSION['user_id'] = $row['id'];
		$_SESSION['oauth_uid'] = $row['oauth_uid'];
		$_SESSION['firstName'] = $row['firstName'];
		$_SESSION['lastName'] = $row['lastName'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['jobTitle'] = $row['jobTitle'];

		if($row['picture'] == null) {
			$_SESSION['picture'] = "../../includes/img/fancy2.png";
		}

		header("Location: ../views/home/home.php");
	} else {
		$_SESSION['error'] = "Username or Password is invalid.";
		header("Location: ../index?err");
		die();
	}
?>