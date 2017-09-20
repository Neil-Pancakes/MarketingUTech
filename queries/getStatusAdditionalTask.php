<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$id = $_SESSION['user_id'];
$query = "SELECT *
    FROM `additional_task`
    WHERE `user_id` = $id";

$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $query2 = "SELECT `task`, `entry_time`
        FROM`additional_task_tracker`
        WHERE `additional_task_id` = ".$rs['additional_task_id']."";
    $result2 = $mysqli->query($query2);
    $status = $result2->fetch_array(MYSQLI_ASSOC);
    do {
        if ($outp != "") {
            $outp .= ",";
        }
        $outp .= '{"AdditionalTaskId":"'  . $rs["additional_task_id"] . '",';
        $outp .= '"Time":"'   . $status["entry_time"]        . '",';
        $outp .= '"Status":"'   . $status["task"]        . '",';
        $outp .= '"Task":"'   . $rs["name"]        . '"}';
    }while($status = $result2->fetch_array(MYSQLI_ASSOC));
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>