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

		$query = 'SELECT COUNT(`id`) FROM `announcement` WHERE `user_id` = "'.$user_id.'" AND `isRead` = "false" OR `isBroadcast` = "true"';
		$result = $mysqli->query($query);
		if($result) {
			$row = $result->fetch_assoc();
			$numPending = $row['COUNT(`id`)'];
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
?>