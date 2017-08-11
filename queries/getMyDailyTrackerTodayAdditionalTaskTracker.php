<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);


$id = $request['additionalTaskId'];

$result = $mysqli->query("SELECT `additional_task_tracker_id`, `task`
FROM `additional_task_tracker`
WHERE `track_date` = CURDATE() AND `additional_task_id` = $id");


$rs = $result->fetch_array(MYSQLI_ASSOC);
    $outp .= '{"AdditionalTaskTrackerId":"'  . $rs["additional_task_id"] . '",';
    $outp .= '"Task":"'   . $rs["task"]        . '"}';
$outp ='{"records":['.$outp.']}';

$mysqli->close();

echo($outp);
?>