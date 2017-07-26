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

	//Conditions
	if(isset($_GET['newDays']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$dateToday = date('d');
		$dateEnd = date('t');
		$yearMonth = date('Y-m-');

		for (; $dateToday <= $dateEnd; $dateToday++) {
			$query = 'INSERT INTO `timetable` (`user_id`, `date`) VALUES ("'.$user_id.'", "'.$yearMonth.$dateToday.'");';
			$result = mysqli_query($mysqli, $query);
		}
		if($result){
			$_SESSION['alertMsg'] = "New days successfully created! User can now Time In!";
			header($succ);
			exit();
		} else {
			$_SESSION['alertMsg'] = "New days creation failed! Contact your administrator.";
			header($err);
			exit();
		}
	}

	if(isset($_GET['timeIn']) && isset($_SESSION['user_id'])){
		if(!hasTime('timeIn')){
			$user_id = $_SESSION['user_id'];
			$query = 'UPDATE `timetable` 
					SET `timeIn`= CURRENT_TIMESTAMP
					WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
			if(mysqli_query($mysqli, $query)){
				$_SESSION['alertMsg'] = "Time IN Successful!";
				header($succ);
				exit();
			} else {
				$_SESSION['alertMsg'] = "Time IN Failed! Contact your administrator.";
				header($err);
				exit();
			}
		} else {
			$_SESSION['alertMsg'] = "WARNING! You are already timed IN";
			header($err);
			exit();
		}
	}

	if(isset($_GET['timeOut']) && isset($_SESSION['user_id'])){
		if(!hasTime("timeOut")){
			$user_id = $_SESSION['user_id'];
			$query = 'UPDATE `timetable` 
					SET `timeOut`= CURRENT_TIMESTAMP
					WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
			if(mysqli_query($mysqli, $query)){
				$_SESSION['alertMsg'] = "Time OUT Successful!";
				header($succ);
				exit();
			} else {
				$_SESSION['alertMsg'] = "Time OUT Failed! Contact your administrator.";
				header($err);
				exit();
			}
		} else {
			$_SESSION['alertMsg'] = "WARNING! You are already timed OUT";
			header($err);
			exit();
		}
	}
?>