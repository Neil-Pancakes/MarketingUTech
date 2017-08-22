<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_SESSION['user_id'];
$result = $mysqli->query("SELECT *
FROM `additional_task`
WHERE `user_id` = $val");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"AdditionalTaskId":"'  . $rs["additional_task_id"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"Type":"'  . $rs["type"] . '",';
    $outp .= '"UserId":"'   . $rs["user_id"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>