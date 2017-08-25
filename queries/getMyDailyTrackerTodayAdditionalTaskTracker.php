<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$val = $_SESSION['user_id'];

$result = $mysqli->query("SELECT `t`.`name`, `a`.`additional_task_tracker_id`, `a`.`task`, `a`.`entry_time`
FROM `additional_task_tracker` `a`
INNER JOIN `additional_task` `t`
ON `t`.`additional_task_id` = `a`.`additional_task_id` AND `a`.`track_date` = CURDATE() AND `t`.`user_id`=$val");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"AdditionalTaskTrackerId":"'  . $rs["additional_task_tracker_id"] . '",';
    $outp .= '"Name":"'   . $rs["name"]        . '",';
    $outp .= '"Time":"'   . $rs["entry_time"]        . '",';
    $outp .= '"Task":"'   . $rs["task"]        . '"}';
}
$outp ='{"records":['.$outp.']}';

$mysqli->close();

echo($outp);
?>