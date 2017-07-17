<?php
	require('sql_connect.php');
	require_once '../../vendor/autoload.php';

	// Get $id_token via HTTPS POST.
	$id_token = $_POST['idtoken'];
	$CLIENT_ID = '746015490934-gl3bvgacv9oq9b3kg1gpj4s2m76pa62j.apps.googleusercontent.com';

	$client = new Google_Client(['client_id' => $CLIENT_ID]);
	$payload = $client->verifyIdToken($id_token);
	if ($payload) {
	  $userid = $payload['sub'];
	  $name = $payload['name'];
	  $given_name = $payload['given_name'];
	  $family_name = $payload['family_name'];
	  $email = $payload['email'];

	  // If request specified a G Suite domain:
	  //$domain = $payload['hd'];

	  //echo json_encode($userid);

	  $qryUser =
	  	'SELECT oauth_uid, firstName, lastName, email 
	  	 FROM users 
	  	 WHERE oauth_uid = ' .$userid;
	  $result = mysqli_query($mysqli, $qryUser);

	  if(mysqli_num_rows($result) == 0) {
	  	$insertUser = mysqli_query($mysqli, 
	  		'INSERT INTO users (oauth_uid, firstName, lastName, email)
			 VALUES ("'.$userid.'", "'.$given_name.'", "'.$family_name.'", "'.$email.'")
	  	');
	  	if($insertUser) {
	  		//$result = mysqli_query($mysqli, $qryUser);
	  		if(mysqli_num_rows($result) > 0){
	  			session_start();

	  			$row = mysqli_fetch_assoc($result);
	  			$_SESSION['userid'] = $row['oauth_uid'];
		  		$_SESSION['given_name'] = $row['firstName'];
		  		$_SESSION['family_name'] = $row['lastName'];
		  		$_SESSION['email'] = $row['email'];
	  		}
	  	}else{ 
	  		echo 'Insertion Error!';
	  	}
	  }else{
	  	session_start();

			$row = mysqli_fetch_assoc($result);
			$_SESSION['userid'] = $row['oauth_uid'];
  		$_SESSION['given_name'] = $row['firstName'];
  		$_SESSION['family_name'] = $row['lastName'];
  		$_SESSION['email'] = $row['email'];
	  }
	} else {
	  // Invalid ID token
	}
?>