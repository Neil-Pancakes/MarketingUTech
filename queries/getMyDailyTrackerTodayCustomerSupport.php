<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../sql_connect.php");

$result = $mysqli->query("SELECT `trackimo_cs_id`, `daily_task` 
            FROM `trackimo_cs_tracker` 
            WHERE `track_date` = CURDATE() AND `account_id`=1"); /*$_SESSION['account_id']*/

$outp = "";
$rs = $result->fetch_array(MYSQLI_ASSOC);
    $outp .= '{"CustomerSupportId":"'  . $rs["trackimo_cs_id"] . '",';
    $outp .= '"DailyTask":"'   . $rs["daily_task"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>