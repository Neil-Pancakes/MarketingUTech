<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `a`.`additional_task_id`, `t`.`additional_task_tracker_id`, `a`.`name`, `a`.`type`, `t`.`task`, `t`.`entry_time`, `t`.`track_date`, `a`.`user_id`
FROM `additional_task` `a`
INNER JOIN `additional_task_tracker` `t`
ON `a`.`additional_task_id` = `t`.`additional_task_id` AND `a`.`user_id` = $val");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"AdditionalTaskId":"'  . $rs["additional_task_id"] . '",';
    $outp .= '"AdditionalTaskTrackerId":"'  . $rs["additional_task_tracker_id"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"Type":"'  . $rs["type"] . '",';
    $outp .= '"Task":"'  . $rs["task"] . '",';
    $outp .= '"Date":"'  . $rs["track_date"] . '",';
    $outp .= '"Time":"'  . $rs["entry_time"] . '",';
    $outp .= '"UserId":"'   . $rs["user_id"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>