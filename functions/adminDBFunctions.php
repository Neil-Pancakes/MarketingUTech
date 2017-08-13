<?php 
	require 'sql_connect.php';

	function resetPassword($user_id) {
		
		$password_hashed = password_hash("password", PASSWORD_DEFAULT);

		$query = 'UPDATE `users` SET `password` = "'.$password_hashed.'" WHERE `id` = "'.$user_id.'";';
		if(mysqli_query($mysqli, $query)) {
			return true;
		} else {
			return false;
		}
	}
?>