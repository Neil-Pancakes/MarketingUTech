<?php
	require ("../../functions/php_globals.php");

	if(isset($_GET["status"]) && isset($_GET["user_id"]) && isset($_GET["date_id"])){
		$user_id = $_GET["user_id"];
		$date_id = $_GET["date_id"];

		$query = "UPDATE timetable
			SET overtimeStatus='".$_GET["status"]."'
			WHERE user_id='".$_GET["user_id"]."' AND id='".$_GET["date_id"]."'
		";

		$function_true = "ajax('OTStatus".$date_id."', 'overtimeStatus.php?status=true&user_id=".$user_id."&date_id=".$date_id."')";
        $function_false = "ajax('OTStatus".$date_id."', 'overtimeStatus.php?status=false&user_id=".$user_id."&date_id=".$date_id."')";
		if(mysqli_query($mysqli, $query)){
			// if status == true show false button else show true button
			if($_GET["status"] == "true"){
				echo '<button id="btnFalse'.$date_id.'" type="button" class="btn btn-xs btn-danger" onclick="'.$function_false.'"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></button>';
			}else{
				echo '<button id="btnTrue'.$date_id.'" type="button" class="btn btn-xs btn-success" onclick="'.$function_true.'"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></button>';
			}
		}else{
			echo "Something went wrong! 001";
		}
	}
?>