<?php
	session_start();
	require '../../functions/php_globals.php';

	$title = mysqli_real_escape_string($mysqli, $_POST['title']);
	$message = mysqli_real_escape_string($mysqli, $_POST['message']);
	$isBroadcast = 'false';
	$error = 'false';
	$error_msg = '';

	if (isset($_POST['isBroadcast'])) {
		$isBroadcast = 'true';
	}

	$query = 'SELECT * FROM announcement_content WHERE title="'.$title.'" AND message="'.$message.'"';
	$result = mysqli_query($mysqli, $query);
	if(mysqli_num_rows($result) < 1){
		$query = 'INSERT INTO announcement_content (`title`, `message`)
			VALUES ("'.$title.'", "'.$message.'")
		';

		if(mysqli_query($mysqli, $query)){
			$query = 'SELECT id FROM announcement_content WHERE title="'.$title.'" AND message="'.$message.'"';
			$result = mysqli_query($mysqli, $query);
			if($result){
				$row = mysqli_fetch_assoc($result);
				if($isBroadcast == 'false'){
					foreach ($_POST['user'] as $user_id) {
						$query = 'INSERT INTO announcement (`announcement_id`, `user_id`, `createdByUserID`) 
							VALUES ("'.$row['id'].'", "'.$user_id.'", "'.$_SESSION['user_id'].'")
						';
						if(!mysqli_query($mysqli, $query)){
							$error = 'true';
						}
					}
				}else{
					$query = 'INSERT INTO announcement (`announcement_id`, `isBroadcast`, `createdByUserID`)
						VALUES ("'.$row['id'].'", "'.$isBroadcast.'", "'.$_SESSION['user_id'].'")
					';
					if(!mysqli_query($mysqli, $query)){
						$error = 'true';
					}
				}
			}else{
				$error = 'true';
			}
		}else{
			$error = 'true';
		}
	}else{
		$error = 'true';
		$error_msg = '|exists|';
	}

	if($error != 'true'){
		$result = $mysqli->query("SELECT * FROM `announcement_content`");
        if ($result) {
        	while($row = $result->fetch_array()) {
          		$result2 = $mysqli->query("SELECT * FROM `announcement` WHERE `announcement_id` = '".$row['id']."'");
          		if($result2){
          			while($row2 = $result2->fetch_array()) {
          				//For Recipient Field
			            if ($row2['isBroadcast'] == "true"){
			              $recipient = "Broadcast";
			            } else {
			              $userResult = $mysqli->query("SELECT CONCAT(firstName, ' ', lastName) AS `name` FROM `users` WHERE id = '".$row2['user_id']."'");
			              if ($userResult) {
			                $userRow = $userResult->fetch_array();
			                $recipient = $userRow['name'];
			              }
			            }
			            //For Status field
			            if($row2['status'] == "true"){
			              $status = "Active";
			            } else {
			              $status = "Inactive";
			            }

			            echo '<tr id='.$row['id'].'>
			              <td>'.$row['title'].'</td>
			              <td>'.date("F d, Y", strtotime($row2['created'])).'</td>
			              <td>'.$recipient.'</td>
			              <td>'.$row['message'].'</td>
			              <td>'.$status.'</td>
			              <td></td>';
			            echo '</tr>';
          			}
          		}
          	}
        }
	}else{
		if($error_msg == ''){
			echo '|error|';
		}else{
			echo $error_msg;
		}
	}
?>