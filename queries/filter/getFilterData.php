<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `data_processor_id`, `daily_task`, `task_status`, `entry_time`
			FROM `data_processor_tracker` 
			WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id";

$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"DataProcessorId":"'  . $rs["data_processor_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"DailyTask":"'   . $rs["daily_task"]        . '",';
    $outp .= '"TaskStatus":"'   . $rs["task_status"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();
echo($outp);
?>