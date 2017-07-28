<?php
	require ("sql_connect.php");	
	include ("ifNotLoggedIn.php");

	//GLOBAL VARIABLES
	$succ = "Location: ../home.php?succ";
	$err = "Location: ../home.php?err";

	//Functions

	//will check DB if $time (timeIn/timeOut) has data (timestamp != 00:00:00)
	//true if timeIn/Out has data, false if not
	function hasTime($time) {
		global $mysqli;
		$query = "SELECT * FROM `timetable` WHERE DATE(`date`) = DATE(CURRENT_TIMESTAMP) AND ".$time." != 0;";
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

	function newDays(){
		global $mysqli;
		$user_id = $_SESSION['user_id'];
		$dateToday = date('d');
		$dateEnd = date('t');
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

	//Conditions
	if(isset($_GET['newDays']) && isset($_SESSION['user_id'])){
		newDays();
		header("location: ../home.php");
	}

	//Time In
	if(isset($_GET['timeIn']) && isset($_SESSION['user_id'])){
		if(!hasTime('timeIn')){
			$user_id = $_SESSION['user_id'];
			$query = 'UPDATE `timetable` 
					SET `timeIn`= CURRENT_TIMESTAMP
					WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
			if(mysqli_query($mysqli, $query)){
				//echo '<div class="alert alert-success" role="alert">Time IN Successful!|</div>';
				timeBtns();
				timeToday();
			} else {
				echo '|fail|';
				//echo '<div class="alert alert-danger" role="alert">Time IN Failed! Contact your administrator.|</div>';
			}
		} else {
			echo '<div class="alert alert-warning" role="alert">WARNING! You are already timed IN|</div>';
		}
	}

	//Time Out
	if(isset($_GET['timeOut']) && isset($_SESSION['user_id'])){
		if(!hasTime("timeOut")){
			$user_id = $_SESSION['user_id'];
			$query = 'UPDATE `timetable` 
					SET `timeOut`= CURRENT_TIMESTAMP
					WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
			if(mysqli_query($mysqli, $query)){
				//echo '<div class="alert alert-success" role="alert">Time OUT Successful!|</div>';
				timeBtns();
				timeToday();
			} else {
				echo '|fail|';
				//echo '<div class="alert alert-danger" role="alert">Time OUT Failed! Contact your administrator.|</div>';
			}
		} else {
			echo '<div class="alert alert-danger" role="alert">WARNING! You are already timed OUT|</div>';
		}
	}

	//LunchIn
	if(isset($_GET['lunchIn']) && isset($_SESSION['user_id'])){
		if(!hasTime("lunchIn")){
			$user_id = $_SESSION['user_id'];
			$query = 'UPDATE `timetable` 
					SET `lunchIn`= CURRENT_TIMESTAMP
					WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
			if(mysqli_query($mysqli, $query)){
				//echo '<div class="alert alert-success" role="alert">Lunch IN Successful!|</div>';
				timeBtns();
				timeToday();
			} else {
				echo '|fail|';
				//echo '<div class="alert alert-danger" role="alert">Lunch IN Failed! Contact your administrator.|</div>';
			}
		} else {
			echo '<div class="alert alert-danger" role="alert">WARNING! You have already clocked IN for lunch.|</div>';
		}
	}

	//LunchOut
	if(isset($_GET['lunchOut']) && isset($_SESSION['user_id'])){
		if(!hasTime("lunchOut")){
			$user_id = $_SESSION['user_id'];
			$query = 'UPDATE `timetable` 
					SET `lunchOut`= CURRENT_TIMESTAMP
					WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
			if(mysqli_query($mysqli, $query)){
				//echo '<div class="alert alert-success" role="alert">Lunch OUT Successful!|</div>';
				timeBtns();
				timeToday();
			} else {
				echo '|fail|';
				//echo '<div class="alert alert-danger" role="alert">Lunch OUT Failed! Contact your administrator.|</div>';
			}
		} else {
			echo '<div class="alert alert-danger" role="alert">WARNING! You have already clocked OUT for lunch.|</div>';
		}
	}
?>