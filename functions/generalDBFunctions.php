<?php 
	require ("sql_connect.php");

	function isAdmin($user_id) {
		global $mysqli;
		$query = 'SELECT `isAdmin` FROM `users` WHERE `id` = "'.$user_id.'"';
		$result = $mysqli->query($query);
		if ($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['isAdmin'] == 1) {
				return true;
			} else {
				return false;
			}
		}
	}

	function isOfJobTitle($user_id, $jobTitle) {
		global $mysqli;
		$query = 'SELECT `id`, `jobTitle` FROM `users` WHERE `id` = "'.$user_id.'" AND `jobTitle` = "'.$jobTitle.'"';
		$result = $mysqli->query($query);
		if ($result->num_rows == 1) {
			return true;
		} else {
			return false;
		}
	}
?>