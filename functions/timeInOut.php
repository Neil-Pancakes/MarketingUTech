<?php
	require ("sql_connect.php");	
	include ("ifNotLoggedIn.php");

	//GLOBAL VARIABLES
	$succ = "Location: ../home?succ";
	$err = "Location: ../home?err";

	//Conditions

	if(isset($_GET['newDays']) && isset($_SESSION['user_id'])){
		if(!daysExist()){
			createNewDays();
		}
		header("location: ../views/home/home.php");
	}

	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch($action) {
			case 'timeIn': timeIn(); break;
			case 'timeOut': timeOut(); break;
			case 'lunchTimeIn': lunchTimeIn(); break;
			case 'lunchTimeOut': lunchTimeOut(); break;
		}
	}

	//Time In
	function timeIn() {
		global $mysqli;
		if(isset($_SESSION['user_id'])){
			$user_id = $_SESSION['user_id'];
			if(!hasTime('timeIn', $user_id)){
				$query = 'UPDATE `timetable` 
						SET `timeIn` = CURRENT_TIMESTAMP, `modified` = CURRENT_TIMESTAMP
						WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
				if(mysqli_query($mysqli, $query)){

					timeBtns();
					timeToday();
				} else {
					echo '|fail|';
				}
			} else {
				echo '<div class="alert alert-warning" role="alert">WARNING! You are already timed IN|</div>';
			}
		}
	}

	//Time Out
	function timeOut() {
		global $mysqli;
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			if(!hasTime("timeOut", $user_id)) {
				$today = date('Y-m-d', time());
				$query = 'UPDATE `timetable` 
						SET `timeOut` = CURRENT_TIMESTAMP, `modified` = CURRENT_TIMESTAMP
						WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
				if(mysqli_query($mysqli, $query)) {
					$query = 'SELECT * 
						FROM users
						WHERE id = "'.$user_id.'"';
					$result = mysqli_query($mysqli, $query);				
					if($result) {
						$row = mysqli_fetch_assoc($result);
						if($row['workStatus'] == 'OJT'){
							$OJT_hoursRemaining = $row['OJT_hoursRemaining'];

							$query = 'SELECT * FROM timetable WHERE user_id = '.$user_id.' AND date = "'.$today.'"	
							';
							$result = mysqli_query($mysqli, $query);
							if($result){
								$row = mysqli_fetch_assoc($result);
								if($row["lunchOut"] > 0){
				                  	$datetime3 = strtotime($row["lunchIn"]);
				                  	$datetime4 = strtotime($row["lunchOut"]);
				                  	$renderedLunch = number_format(round(($datetime4 - $datetime3)/3600,1),1);
				                  	$datetime1 = strtotime($row["timeIn"]);
				                  	$datetime2 = strtotime($row["timeOut"]);
				                  	$renderedTime = number_format(round((($datetime2 - $datetime1)/3600) - $renderedLunch, 1),1);  
				                }else{
		             			 	$datetime1 = strtotime($row["timeIn"]);
		              				$datetime2 = strtotime($row["timeOut"]);
		              				$renderedTime = number_format(round(($datetime2 - $datetime1)/3600,1),1);
				                }
				                $OJT_hoursRemaining = number_format($OJT_hoursRemaining - $renderedTime, 1);
				                $query = 'UPDATE users 
				                	SET OJT_hoursRemaining = '.$OJT_hoursRemaining.'
				                	WHERE id = "'.$user_id.'" ';
				                if(!mysqli_query($mysqli, $query)){
				                	echo 'Something went wrong! 003';
				                }
							}else{
								echo 'Something went wrong! 002';
							}
						}

						$query = 'SELECT * FROM timetable WHERE user_id = "'.$user_id.'" AND date = DATE(CURRENT_TIMESTAMP);';
						$result = $mysqli->query($query);
						if($result){
							$row = $result->fetch_assoc();
							if($row["timeOut"] > 0){
			                    $datetime1 = strtotime($row["timeIn"]);
			                    $datetime2 = strtotime($row["timeOut"]);
			                    $renderedTime = abs(number_format(round(($datetime2 - $datetime1)/3600,1),1));
			                    $underTime = number_format(8.0 - $renderedTime, 1);
			                    if($renderedTime > 8){
			                      $overTime = $renderedTime - 8;
			                      $underTime = 0;
			                    }else{
			                      $overTime = 0;
			                    }

				                 if($row["lunchOut"] > 0){
					               $datetime3 = strtotime($row["lunchIn"]);
					               $datetime4 = strtotime($row["lunchOut"]);
					               $renderedLunch = number_format(round(($datetime4 - $datetime3)/3600,1),1);
					               $datetime1 = strtotime($row["timeIn"]);
					               $datetime2 = strtotime($row["timeOut"]);
					               $renderedTime = abs(number_format(round((($datetime2 - $datetime1)/3600) - $renderedLunch, 1),2));
					               $underTime = number_format(8.0 - $renderedTime, 1);
					               if($renderedTime > 8){
				                      $overTime = $renderedTime - 8;
				                      $underTime = 0;
				                    }else{
				                      $overTime = 0;
				                    }
					            }
			                }

			                $query = 'UPDATE timetable
								SET totalHours = "'.$renderedTime.'", undertime = "'.$underTime.'", overtime = "'.$overTime.'"
								WHERE user_id = "'.$user_id.'" AND date = DATE(CURRENT_TIMESTAMP)
			                ';

			                if(!mysqli_query($mysqli, $query)){
			                	echo 'Something went wrong! 004';
			                }
						}
					}else{
						echo 'Something went wrong! 001';
					}
					timeBtns();
					timeToday();
				} else {
					echo '|fail|';
				}
			} else {
				echo '<div class="alert alert-danger" role="alert">WARNING! You are already timed OUT|</div>';
			}
		}
	}

	//LunchIn
	function lunchTimeIn() {
		global $mysqli;
		if(isset($_SESSION['user_id'])){

			$user_id = $_SESSION['user_id'];
			if(!hasTime("lunchIn", $user_id)){
				$query = 'UPDATE `timetable` 
						SET `lunchIn`= CURRENT_TIMESTAMP
						WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
				if(mysqli_query($mysqli, $query)){
					timeBtns();
					timeToday();
				} else {
					echo '|fail|';
				}
			} else {
				echo '<div class="alert alert-danger" role="alert">WARNING! You have already clocked IN for lunch.|</div>';
			}
		}
	}

	//LunchOut
	function lunchTimeOut() {
		global $mysqli;
		if(isset($_SESSION['user_id'])){
			$user_id = $_SESSION['user_id'];
			if(!hasTime("lunchOut", $user_id)){
				$query = 'UPDATE `timetable` 
						SET `lunchOut`= CURRENT_TIMESTAMP
						WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
				if(mysqli_query($mysqli, $query)){
					timeBtns();
					timeToday();
				} else {
					echo '|fail|';
				}
			} else {
				echo '<div class="alert alert-danger" role="alert">WARNING! You have already clocked OUT for lunch.|</div>';
			}
		}
	}

	//will check DB if $time (timeIn/timeOut) has data (timestamp != 00:00:00)
	//true if timeIn/Out has data, false if not
	function hasTime($time, $user_id) {
		global $mysqli;
		$query = "SELECT * FROM `timetable` WHERE DATE(`date`) = DATE(CURRENT_TIMESTAMP) AND ".$time." != 0 AND `user_id` = ".$user_id.";";
        $result = $mysqli->query($query);
        if ($result->num_rows == 1) {
        	return true;
        } else {
        	return false;
        }
	}

	function calcuTimeRender(){
		global $mysqli;
		$user_id = $_SESSION['user_id'];
		$query  = "SELECT TIME_TO_SEC(TIMEDIFF(`timeOut`,`timeIn`)) / 60 FROM `timetable` WHERE `id` = ";
	}


	function createNewDays(){
		global $mysqli;
		$user_id = $_SESSION['user_id'];
		$dateEnd = date('t');
		$dateToday = date('d');
		$yearMonth = date('Y-m-');

		for (; $dateToday <= $dateEnd; $dateToday++) {
			$query = 'INSERT INTO `timetable` (`user_id`, `date`) VALUES ("'.$user_id.'", "'.$yearMonth.$dateToday.'");';
			$result = mysqli_query($mysqli, $query);
		}
		if($result){
			echo '<div class="alert alert-success" role="alert">New days successfully created! User can now Time In!|</div>';
		} else {
			echo '<div class="alert alert-danger" role="alert">New days creation failed! Contact your administrator.|</div>';
		}
	}

	function daysExist(){
		global $mysqli;
		$bool = false;
		$user_id = $_SESSION['user_id'];
		$dateToday = date('Y-m-d');

		$query = 'SELECT * FROM `timetable` WHERE user_id = "'.$user_id.'" AND `date` = "'.$dateToday.'"; ';
		$result = mysqli_query($mysqli, $query);
		
		if($result->num_rows == 1){
			$bool = true;
		}

		return $bool;
	}

	function timeBtns(){
		global $mysqli;
		$query = "SELECT `timeIn`, `timeOut`, `lunchIn`, `lunchOut`
        	FROM `timetable`
        	WHERE DATE(`date`) = DATE(CURRENT_TIMESTAMP) AND user_id = ".$_SESSION["user_id"];
  		$result = mysqli_query($mysqli, $query);
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
    		echo '|';
	  	} else {
	    	newDays();
	  	}
	}

	function timeToday(){
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