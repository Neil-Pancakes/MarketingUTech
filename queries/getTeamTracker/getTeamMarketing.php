<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_GET['id'];
$result = $mysqli->query("SELECT `marketing_id`, `daily_task` 
                        FROM `marketing_tracker` 
                        WHERE `track_date` = CURDATE() AND `user_id`=$val");


$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"MarketingId":"'  . $rs["marketing_id"] . '",';
$outp .= '"DailyTask":"'   . $rs["daily_task"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>