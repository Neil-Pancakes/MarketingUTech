<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `e`.`editor_id`, `e`.`writer_id`, `e`.`word_cnt`, 
CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `w`.`article_title`, `e`.`entry_time`
FROM `editor_tracker` `e`
INNER JOIN `writer_tracker` `w`
ON `w`.`writer_id` = `e`.`writer_id` AND `e`.`track_date` >= $var1 AND `e`.`track_date` <= $var2 AND `e`.`user_id`= $id
INNER JOIN `users` `u`
ON `w`.`user_id` = `u`.`id`
GROUP BY `e`.`writer_id`"; 

$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"EditorId":"'  . $rs["editor_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"WriterId":"'   . $rs["writer_id"]        . '",';
    $outp .= '"WriterName":"'   . $rs["name"]        . '",';
    $outp .= '"WordCount":"'   . $rs["word_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>