<?php
	require_once ('sql_connect.php');
	require_once ('../vendor/autoload.php');
	session_start();

	// Get $id_token via HTTPS POST.
	$id_token = $_POST['idtoken'];
	$CLIENT_ID = '746015490934-gl3bvgacv9oq9b3kg1gpj4s2m76pa62j.apps.googleusercontent.com';

	$client = new Google_Client(['client_id' => $CLIENT_ID]);
	$payload = $client->verifyIdToken($id_token);

	if ($payload) {
	  $oauth_uid = $payload['sub'];
	  $name = $payload['name'];
	  $given_name = $payload['given_name'];
	  $family_name = $payload['family_name'];
	  $email = $payload['email'];

	  $qryUser = 'SELECT `id`, `oauth_uid`, `firstName`, `lastName`, `email` FROM `users` WHERE `oauth_uid` = '.$oauth_uid;
	  $result = mysqli_query($mysqli, $qryUser);

	  if(mysqli_num_rows($result) == 0) {

	  	$query = 'INSERT INTO `users` (`oauth_uid`, `firstName`, `lastName`, `email`) VALUES ("'.$oauth_uid.'", "'.$given_name.'", "'.$family_name.'", "'.$email.'")';
	  	$insertUser = mysqli_query($mysqli,$query);

	  	if($insertUser) {
	  		if(mysqli_num_rows($result) > 0){

	  			$row = mysqli_fetch_assoc($result);	
	  			
	  			$_SESSION['loggedin'] = true;
	  			$_SESSION['user_id'] = $row['id'];
	  			$_SESSION['oauth_uid'] = $row['oauth_uid'];
		  		$_SESSION['firstName'] = $row['firstName'];
		  		$_SESSION['lastName'] = $row['lastName'];
		  		$_SESSION['email'] = $row['email'];
	  		}
	  	} else{
	  		echo 'Insertion Error!';
	  	}
	  } else {

		$row = mysqli_fetch_assoc($result);

		$_SESSION['loggedin'] = true;
		$_SESSION['user_id'] = $row['id'];
		$_SESSION['oauth_uid'] = $row['oauth_uid'];
		$_SESSION['firstName'] = $row['firstName'];
		$_SESSION['lastName'] = $row['lastName'];
		$_SESSION['email'] = $row['email'];
	  }
	} else {
	  $_SESSION['error'] = "invalid ID token";
	}
?>