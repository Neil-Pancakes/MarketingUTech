<?php /*Unused*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

$val = $_GET['id'];
$result = $mysqli->query("SELECT `trackimo_cs_id`, `daily_task` 
            FROM `trackimo_cs_tracker` 
            WHERE `track_date` = CURDATE() AND `user_id`=$val");

$outp = "";
$rs = $result->fetch_array(MYSQLI_ASSOC);
    $outp .= '{"CustomerSupportId":"'  . $rs["trackimo_cs_id"] . '",';
    $outp .= '"DailyTask":"'   . $rs["daily_task"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>