<?php
	require ("sql_connect.php");
	session_start();

	echo 'meme';
/*	if(isset($_SESSION['user_id'])){
		$query = "INSERT INTO `timetable` (`user_id`) VALUES ('".$_SESSION['user_id']."');";
		$result = mysqli_query($mysqli, $query);

		if($result){
			header("location:../home");
		}
	}*/
?>