<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../sql_connect.php");

$result = $mysqli->query("SELECT `marketing_id`, `daily_task` 
                        FROM `marketing_tracker` 
                        WHERE `track_date` = CURDATE() AND `account_id`=1"); /*$_SESSION['account_id']*/

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Marketing ID":"'  . $rs["marketing_id"] . '",';
    $outp .= '"Daily Task":"'   . $rs["daily_task"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>