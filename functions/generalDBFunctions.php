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

	function announcementPending($user_id) {
		global $mysqli;
		$numPending = 0;

		$query = 'SELECT * FROM `announcement_content` WHERE `status` = "true"';
		$result = mysqli_query($mysqli, $query);
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				$query = 'SELECT COUNT(`id`) FROM `announcement` WHERE `announcement_id` = "'.$row['id'].'" AND `user_id` = "'.$user_id.'" AND `isRead` = "false" OR `isBroadcast` = "true" AND `announcement_id` = "'.$row['id'].'"';
				$result2 = $mysqli->query($query);
				if($result2) {
					$row = $result2->fetch_assoc();
					$numPending += $row['COUNT(`id`)'];
				}
			}
		}	
		return $numPending;
	}

	function displayTimetableToday() {
		global $mysqli;
	    $query = "SELECT `timeIn`, `timeOut`, `lunchIn`, `lunchOut`, `date`
	          FROM `timetable`
	          WHERE DATE(`date`) = DATE(CURRENT_TIMESTAMP) AND user_id = ".$_SESSION["user_id"];
	    $result = mysqli_query($mysqli, $query);
	    if ($result->num_rows == 1){
	      $row = mysqli_fetch_assoc($result);
	      if($row['timeOut'] != 0){
	        echo '<tr>';
	        echo '<td>Timed Out: </td>';
	        echo '<td>'.$row['timeOut'].'</td>';
	        echo '</tr>';
	      }
	      if($row['lunchOut'] != 0){
	        echo '<tr>';
	        echo '<td>Lunch Out: </td>';
	        echo '<td>'.$row['lunchOut'].'</td>';
	        echo '</tr>';
	      }
	      if($row['lunchIn'] != 0){
	        echo '<tr>';
	        echo '<td>Lunch In: </td>';
	        echo '<td>'.$row['lunchIn'].'</td>';
	        echo '</tr>';
	      }
	      if($row['timeIn'] != 0){
	        echo '<tr>';
	        echo '<td>Time In: </td>';
	        echo '<td>'.$row['timeIn'].'</td>';
	        echo '</tr>';
	      }
	    }
	}

	function displayTimeBtns() {
		global $mysqli;
	  $query = "SELECT `timeIn`, `timeOut`, `lunchIn`, `lunchOut`
		FROM `timetable`
		WHERE DATE(`date`) = DATE(CURRENT_TIMESTAMP) AND user_id = ".$_SESSION["user_id"];
          $result = $mysqli->query($query);
      if ($result->num_rows == 1){
        $row = mysqli_fetch_assoc($result);
        if ($row['timeIn'] == 0) {
          echo '<div class="col-md-12 text-center">';
          echo '<button type="button" class="btn btn-success timeBtn" id="btnTimeIn">Time In</button>';
          echo '</div>';
        } else if ($row['timeIn'] != 0 && $row['timeOut'] == 0 && $row['lunchIn'] == 0 && $row['lunchOut'] == 0) {
          echo '<div class="col-md-6 text-center">';
          echo '<button type="button" class="btn btn-danger timeBtn" id="btnTimeOut">Time Out</button>';
          echo '</div>';
          echo '<div class="col-md-6 text-center">';
          echo '<button type="button" class="btn btn-warning timeBtn" id="btnLunchIn">Lunch Time In</button>';
          echo '</div>';
        } else if ($row['timeIn'] != 0 && $row['timeOut'] == 0 && $row['lunchIn'] != 0 && $row['lunchOut'] == 0) {
          echo '<div class="col-md-6 text-center">';
          echo '<button type="button" class="btn btn-danger timeBtn" id="btnTimeOut">Time Out</button>';
          echo '</div>';
          echo '<div class="col-md-6 text-center">';
          echo '<button type="button" class="btn btn-warning timeBtn" id="btnLunchOut">Lunch Time Out</button>';
          echo '</div>';
        } else if ($row['timeIn'] != 0 && $row['timeOut'] == 0 && $row['lunchIn'] != 0 && $row['lunchOut'] != 0) {
          echo '<div class="col-md-12 text-center">';
          echo '<button type="button" class="btn btn-danger timeBtn" id="btnTimeOut">Time Out</button>';
          echo '</div>';
        } else if ($row['timeIn'] != 0 && $row['timeOut'] != 0) {
          echo '<div class="col-md-12 text-center">';
          echo '<button type="button" class="btn btn-success timeBtn disabled">Time In</button>';
          echo '</div>';
        }
      } else {
        header("location:../../functions/timeInOut.php?newDays");
        exit();
      }
	}

	function loadAnnouncements($user_id) {
		global $mysqli;

		$query = 'SELECT * FROM `announcement_content` WHERE `status` = "true"';
		$result = mysqli_query($mysqli, $query);
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				$query = 'SELECT * FROM `announcement` WHERE `announcement_id` = "'.$row['id'].'" AND `user_id` = "'.$user_id.'" AND `isRead` = "false" OR `isBroadcast` = "true" AND `announcement_id` = "'.$row['id'].'"';
				$result2 = $mysqli->query($query);
				if($result2) {
					$row2 = $result2->fetch_assoc();
					if($row2['isRead'] == 'true'){
						$isRead = "Read";
					} else {
						$isRead = "Unread";
					}
					echo "
						<tr id='".$row['id']."' data-toggle='modal' data-target='#viewModal'>
						<td>".$row['id']."</td>
						<td>".$row['title']."</td>
						<td>".$isRead."</td>
						</tr>
						<p id='msg_".$row['id']."' hidden>".$row['message']."</p>
					";
				}
			}
		}

		// $query = "SELECT `a`.`id`, `a`.`isRead`, `ac`.`title`, `ac`.`message`
		// 	FROM `announcement` AS `a`
		// 	LEFT JOIN `announcement_content` AS `ac` 
		// 	ON `ac`.`id` = `a`.`announcement_id` 
		// 	WHERE `a`.`user_id` = '".$user_id."' OR `a`.`isBroadcast` = 'true'
		// 	ORDER BY `a`.`id`";
		// $result = $mysqli->query($query);
		// if($result) {
		// 	while($row = $result->fetch_assoc()){
		// 		if($row['isRead'] == 'true'){
		// 			$isRead = "Read";
		// 		} else {
		// 			$isRead = "Unread";
		// 		}
		// 		echo "
		// 			<tr id='".$row['id']."' data-toggle='modal' data-target='#viewModal'>
		// 			<td>".$row['id']."</td>
		// 			<td>".$row['title']."</td>
		// 			<td>".$isRead."</td>
		// 			</tr>
		// 			<p id='msg_".$row['id']."' hidden>".$row['message']."</p>
		// 		";
		// 	}
		// }
	}
?>