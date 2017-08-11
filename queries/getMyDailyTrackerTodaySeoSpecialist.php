<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();
$val = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `seospecialist_id`, `daily_task` 
						FROM `seo_specialist_tracker` 
						WHERE `track_date` = CURDATE() AND `user_id`=$val");  	
$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"SEOSpecialistId":"'  . $rs["seospecialist_id"] . '",';
$outp .= '"DailyTask":"'   . $rs["daily_task"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();
echo($outp);
?>