<?php
	session_start();
	require '../../functions/php_globals.php';

	$succ_url = "announcements.php?succ";
	$err_url = "announcements.php?err";

	$createdByUserID = $_SESSION['user_id'];
	$title = $_POST['title'];
	$message = $_POST['message'];
	$isBroadcast = 'false';

	if (isset($_POST['isBroadcast'])) {
		$isBroadcast = 'true';
	}

	foreach ($_POST['user'] as $user_id) {
		$query = "INSERT INTO `announcement`(`user_id`, `isBroadcast`, `title`, `message`, `createdByUserID`) VALUES ('".$user_id."', '".$isBroadcast."', '".$title."', '".$message."', '".$createdByUserID."');";
		$result = $mysqli->query($query);
	}

	if($result){
		$query = "SELECT * FROM `announcement`; ";
		$result = $mysqli->query($query);
		if ($result) {
			while($row = $result->fetch_array()) {
				echo '<tr id='.$row['id'].'>
				<td>'.$row['title'].'</td>
				<td>'.$row['created'].'</td>
				<td>'.$row['message'].'</td>
				<td>Meme</td>';
				echo '</tr>';
			}
		}
	}
?>