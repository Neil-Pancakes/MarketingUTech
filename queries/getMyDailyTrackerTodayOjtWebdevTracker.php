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
$outp .= '{"OJTWebDevId":"'  . $rs["ojt_webdev_id"] . '",';
$outp .= '"FixBugCnt":"'   . $rs["fix_bugs_cnt"]        . '",';
$outp .= '"ResponsiveCnt":"'   . $rs["responsive_cnt"]        . '",';
$outp .= '"BackupCnt":"'   . $rs["backup_cnt"]        . '",';
$outp .= '"OptimizeCnt":"'   . $rs["optimize_cnt"]        . '",';
$outp .= '"MiscCnt":"'   . $rs["misc_cnt"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();
echo($outp);
?>