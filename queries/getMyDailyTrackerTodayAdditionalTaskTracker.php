<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");

$result = $mysqli->query("SELECT `t`.`name`, `a`.`additional_task_tracker_id`, `a`.`task`
FROM `additional_task_tracker` `a`
INNER JOIN `additional_task` `t`
ON `t`.`additional_task_id` = `a`.`additional_task_id` AND `a`.`track_date` = CURDATE()");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"AdditionalTaskTrackerId":"'  . $rs["additional_task_tracker_id"] . '",';
    $outp .= '"Name":"'   . $rs["name"]        . '",';
    $outp .= '"Task":"'   . $rs["task"]        . '"}';
}
$outp ='{"records":['.$outp.']}';

$mysqli->close();

echo($outp);
?>