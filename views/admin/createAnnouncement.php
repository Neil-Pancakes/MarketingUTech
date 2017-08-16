<?php
	session_start();
	require '../../functions/php_globals.php';
	session_start();

	$title = mysqli_real_escape_string($mysqli, $_POST['title']);
	$message = mysqli_real_escape_string($mysqli, $_POST['message']);
	$isBroadcast = 'false';
	$error = 'false';

	if (isset($_POST['isBroadcast'])) {
		$isBroadcast = 'true';
	}

	if($isBroadcast == 'false'){
		foreach ($_POST['user'] as $user_id) {
			$query = 'INSERT INTO announcement (user_id, message, createdByUserID)
				VALUES ("'.$user_id.'", "'.$message.'", "'.$_SESSION['user_id'].'")
			';
			if(!mysqli_query($mysqli, $query)){
				$error = 'true';
			}
		}
	}else{
		$query = 'INSERT INTO announcement (isBroadcast, message, createdByUserID)
				VALUES ("'.$isBroadcast.'", "'.$message.'", "'.$_SESSION['user_id'].'")
			';

		if(!mysqli_query($mysqli, $query)){
			$error = 'true';
		}
	}

	if($error != 'true'){
		$query = "SELECT * FROM `announcement`; ";
        $result = $mysqli->query($query);
        if ($result) {
          while($row = $result->fetch_array()) {
            echo '<tr id='.$row['id'].'>
              <td></td>
              <td>'.date("F d, Y", strtotime($row['created'])).'</td>
              <td>'.$row['message'].'</td>
              <td>Meme</td>';
            echo '</tr>';
          }
        }
	}else{
		echo '|error|';
	}
?>