<?php
	session_start();
	require '../../functions/php_globals.php';

	$title = mysqli_real_escape_string($mysqli, $_POST['title']);
	$message = mysqli_real_escape_string($mysqli, $_POST['message']);
	$isBroadcast = 'false';
	$error = 'false';

	if (isset($_POST['isBroadcast'])) {
		$isBroadcast = 'true';
	}

	if($isBroadcast == 'false'){
		foreach ($_POST['user'] as $user_id) {
			$query = 'INSERT INTO announcement (`user_id`, `title`, `message`, `createdByUserID`)
				VALUES ("'.$user_id.'", "'.$title.'", "'.$message.'", "'.$_SESSION['user_id'].'")
			';
			if(!mysqli_query($mysqli, $query)){
				$error = 'true';
			}
		}
	}else{
		$query = 'INSERT INTO announcement (`isBroadcast`, `title`, `message`, `createdByUserID`)
				VALUES ("'.$isBroadcast.'", "'.$title.'", "'.$message.'", "'.$_SESSION['user_id'].'")
			';

		if(!mysqli_query($mysqli, $query)){
			$error = 'true';
		}
	}

	if($error != 'true'){
		$result = $mysqli->query("SELECT * FROM `announcement`");
        if ($result) {
          while($row = $result->fetch_array()) {
            //For Recipient Field
            if ($row['isBroadcast'] == "true"){
              $recipient = "Broadcast";
            } else {
              $userResult = $mysqli->query("SELECT CONCAT(firstName, ' ', lastName) AS `name` FROM `users` WHERE id = '".$row['user_id']."'");
              if ($userResult) {
                $userRow = $userResult->fetch_array();
                $recipient = $userRow['name'];
              }
            }
            //For Status field
            if($row['status'] == "true"){
              $status = "Active";
            } else {
              $status = "Inactive";
            }

            echo '<tr id='.$row['id'].'>
              <td>'.$row['title'].'</td>
              <td>'.date("F d, Y", strtotime($row['created'])).'</td>
              <td>'.$recipient.'</td>
              <td>'.$row['message'].'</td>
              <td>'.$status.'</td>
              <td></td>';
            echo '</tr>';
          }
        }
	}else{
		echo '|error|';
	}
?>