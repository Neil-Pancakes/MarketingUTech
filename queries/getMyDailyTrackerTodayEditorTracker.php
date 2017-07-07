<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../sql_connect.php");

$result = $mysqli->query("SELECT `editor_id`, `writer_id`, `word_cnt` 
                        FROM `editor_tracker` 
                        WHERE `track_date` = CURDATE() AND `account_id`=1"); /*$_SESSION['account_id']*/

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Editor ID":"'  . $rs["editor_id"] . '",';
    $outp .= '"Writer ID":"'   . $rs["writer_id"]        . '",';
    $outp .= '"Word Count":"'   . $rs["word_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>