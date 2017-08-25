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

		$query = 'SELECT COUNT(*)
			FROM announcement
			LEFT JOIN announcement_content ON announcement.announcement_id = announcement_content.id AND announcement.user_id = "'.$user_id.'"
			WHERE announcement.isRead = "false" AND announcement_content.status = "true" OR announcement.isBroadcast = "true"
		';

		$result = $mysqli->query($query);
		if($result) {
			$row = $result->fetch_assoc();
			$numPending = $row['COUNT(*)'];
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

		$query = "SELECT `a`.`id`, `a`.`isRead`, `ac`.`title`, `ac`.`message`
			FROM `announcement` AS `a`
			LEFT JOIN `announcement_content` AS `ac` 
			ON `ac`.`id` = `a`.`announcement_id` 
			WHERE `a`.`user_id` = '".$user_id."' OR `a`.`isBroadcast` = 'true'
			ORDER BY `a`.`id`";
		$result = $mysqli->query($query);
		if($result) {
			while($row = $result->fetch_assoc()){
				if($row['isRead'] == 'true'){
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
?>