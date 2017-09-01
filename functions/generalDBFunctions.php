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
				$query = 'SELECT * FROM `announcement` WHERE `announcement_id` = "'.$row['id'].'" AND `user_id` = "'.$user_id.'"';
				$result2 = $mysqli->query($query);
				if($result2->num_rows > 0) {
					$row2 = $result2->fetch_assoc();
					if($row2['isRead'] == 'true'){
						$isRead = "Read";
						echo "<tr id='".$row['id']."' data-toggle='modal' data-target='#viewModal'>";
					} else {
						$isRead = "<strong>Unread</strong>";
						$function = 'ajaxRead("'.$row2['id'].'", "'.$row['id'].'")';
						echo "<tr id='".$row['id']."' data-toggle='modal' data-target='#viewModal' onclick='".$function."'>";
					}
					echo "
						<td>".$row['title']."</td>
						<td>".$isRead."</td>
						</tr>
						<p id='msg_".$row['id']."' hidden>".$row['message']."</p>
					";
				}
			}
		}
	}

	function loadBroadcasts() {
		global $mysqli;

		$query = 'SELECT * FROM `announcement_content` WHERE `status` = "true"';
		$result = mysqli_query($mysqli, $query);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$query = 'SELECT * FROM `announcement` WHERE `announcement_id` = "'.$row['id'].'" AND `isBroadcast` = "true"';
				$result2 = $mysqli->query($query);
				if($result2->num_rows > 0) {
					$row2 = $result2->fetch_assoc();
					if($row2['isRead'] == 'true'){
						$isRead = "Read";
						echo "<tr id='".$row['id']."' data-toggle='modal' data-target='#viewModal'>";
					} else {
						$isRead = "<strong>Unread</strong>";
						$function = 'ajaxRead("'.$row2['id'].'", "'.$row['id'].'")';
						echo "<tr id='".$row['id']."' data-toggle='modal' data-target='#viewModal' onclick='".$function."'>";
					}
					echo "
						<td>".$row['title']."</td>
						<td>".$isRead."</td>
						</tr>
						<p id='msg_".$row['id']."' hidden>".$row['message']."</p>
					";
				}
			}
		}
	}

	function isTaskTrackerAnswered($user_id) {
		global $mysqli;

		$q = 'SELECT *
		FROM `timetable` `t`
		INNER JOIN `users` `u`
		ON `t`.`date` = subdate(CURRENT_DATE, 1) 
		AND `t`.`user_id` = `u`.`id` 
		AND `t`.`user_id` ="'.$user_id.'"';

		$result = $mysqli->query($q);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$query = 'SELECT *';
			if($row['jobTitle']=="Editor"){
				$query .= 'FROM `editor_tracker`';
			}else if($row['jobTitle']=="Writer"){
				$query .= 'FROM `writer_tracker`';
			}else if($row['jobTitle']=="Marketing Specialist"){
				$query .= 'FROM `marketing_tracker`';
			}else if($row['jobTitle']=="Trackimo Customer Support"){
				$query .= 'FROM `trackimo_cs_tracker`';
			}else if($row['jobTitle']=="Social Media Specialist"){
				$query .= 'FROM `social_media_tracker`';
			}else if($row['jobTitle']=="Multimedia Specialist"){
				$query .= 'FROM `multimedia_tracker`';
			}else if($row['jobTitle']=="Data Processor"){
				$query .= 'FROM `data_processor_tracker`';
			}else if($row['jobTitle']=="SEO Specialist"){
				$query .= 'FROM `seo_specialist_tracker`';
			}else if($row['jobTitle']=="Wordpress Developer"){
				$query .= 'FROM `wordpress_developer_tracker`';
			}else if($row['jobTitle']=="Content Marketing Assistant"){
				$query .= 'FROM `content_marketing_assistant_tracker`';
			}else if($row['jobTitle']=="OJT Web Development"){
				$query .= 'FROM `ojt_webdev_tracker`';
			}else if($row['jobTitle']=="OJT SEO"){
				$query .= 'FROM `ojt_seo_tracker`';
			}else if($row['jobTitle']=="OJT System Developer"){
				$query .= 'FROM `ojt_developer_system_tracker`';
			}else if($row['jobTitle']=="OJT Researcher"){
				$query .= 'FROM `ojt_researcher_tracker`';
			}
			$query .= 'WHERE `track_date` = subdate(CURRENT_DATE, 1) AND `user_id` = "'.$user_id.'"';

			$result2 = $mysqli->query($query);
			if($result2->num_rows > 0){
				return true;
			}else{
				$query3 = 'SELECT `t`.`name`, `a`.`additional_task_tracker_id`, `a`.`task`, `a`.`entry_time`
				FROM `additional_task_tracker` `a`
				INNER JOIN `additional_task` `t`
				ON `t`.`additional_task_id` = `a`.`additional_task_id` 
				AND `a`.`track_date` = subdate(CURRENT_DATE, 1)
				AND `t`.`user_id` = "'.$user_id.'"';

				$result3 = $mysqli->query($query3);
				if($result3->num_rows > 0){
					return true;
				}else{
					return false;
				}
			}
		}
	}
?>