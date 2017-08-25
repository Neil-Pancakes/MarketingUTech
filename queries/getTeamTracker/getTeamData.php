<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

$val = $_GET['id'];
$result = $mysqli->query("SELECT `data_processor_id`, `daily_task`, `task_status`
						FROM `data_processor_tracker` 
						WHERE `track_date` = CURDATE() AND `user_id`=$val");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"DataProcessorId":"'  . $rs["data_processor_id"] . '",';
    $outp .= '"DailyTask":"'   . $rs["daily_task"]        . '",';
    $outp .= '"TaskStatus":"'   . $rs["task_status"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();
echo($outp);
?>