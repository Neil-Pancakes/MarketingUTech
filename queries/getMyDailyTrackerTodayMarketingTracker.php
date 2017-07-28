<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");

$result = $mysqli->query("SELECT `marketing_id`, `daily_task` 
                        FROM `marketing_tracker` 
                        WHERE `track_date` = CURDATE() AND `account_id`=1"); /*$_SESSION['account_id']*/


$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"MarketingId":"'  . $rs["marketing_id"] . '",';
$outp .= '"DailyTask":"'   . $rs["daily_task"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>