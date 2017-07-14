<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../sql_connect.php");

$result = $mysqli->query("SELECT `e`.`editor_id`, `e`.`writer_id`, `e`.`word_cnt`, CONCAT(`acc`.`fname`,' ', `acc`.`lname`) AS `name`
FROM `editor_tracker` `e`
INNER JOIN `writer_tracker` `w`
ON `w`.`writer_id` = `e`.`writer_id` AND `e`.`track_date` = CURDATE() AND `e`.`account_id`=3
INNER JOIN `account` `acc`
ON `w`.`account_id` = `acc`.`account_id`
GROUP BY `e`.`writer_id`"); /*$_SESSION['account_id']*/

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"EditorId":"'  . $rs["editor_id"] . '",';
    $outp .= '"WriterId":"'   . $rs["writer_id"]        . '",';
    $outp .= '"WriterName":"'   . $rs["name"]        . '",';
    $outp .= '"WordCount":"'   . $rs["word_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>