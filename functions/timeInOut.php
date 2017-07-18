<?php
	include("ifNotLoggedIn.php");
	require("sql_connect.php");

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
			header("Location: ../home.php");
		} else {
			header("Location: ../home.php?err");
		}
	}

	if(isset($_GET['timeIn']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$query = 'UPDATE `timetable` 
				SET `timeIn`= CURRENT_TIMESTAMP
				WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
		if(mysqli_query($mysqli, $query)){
			header("Location: ../home.php");
		} else {
			header("Location: ../home.php?err");
		}
	}

	if(isset($_GET['timeOut']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$query = 'UPDATE `timetable` 
				SET `timeOut`= CURRENT_TIMESTAMP
				WHERE `user_id` = "'.$user_id.'" AND DATE(`date`) = DATE(CURRENT_TIMESTAMP);';
		if(mysqli_query($mysqli, $query)){
			header("Location: ../home.php");
		} else {
			header("Location: ../home.php?err");
		}
	}

?>