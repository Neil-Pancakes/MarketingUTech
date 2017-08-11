<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `ojt_webdev_id`, `fix_bugs_cnt`, `responsive_cnt`, `backup_cnt`, `optimize_cnt`, `misc_cnt` 
						FROM `ojt_webdev_tracker` 
						WHERE `track_date` = CURDATE() AND `user_id`=$val");

$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"OJT WebDev ID":"'  . $rs["ojt_webdev_id"] . '",';
$outp .= '"Bug Fix Count":"'   . $rs["fix_bugs_cnt"]        . '",';
$outp .= '"Response Count":"'   . $rs["responsive_cnt"]        . '",';
$outp .= '"Backup Count":"'   . $rs["backup_cnt"]        . '",';
$outp .= '"Optimize Count":"'   . $rs["optimize_cnt"]        . '",';
$outp .= '"Misc":"'   . $rs["misc_cnt"]        . '"}';

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>