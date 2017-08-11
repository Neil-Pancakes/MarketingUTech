<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `e`.`editor_id`, `e`.`writer_id`, `e`.`word_cnt`, 
CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `w`.`article_title`

FROM `editor_tracker` `e`
INNER JOIN `writer_tracker` `w`
ON `w`.`writer_id` = `e`.`writer_id` AND `e`.`track_date` = CURDATE() AND `e`.`user_id`=$val
INNER JOIN `users` `u`
ON `w`.`user_id` = `u`.`id`
GROUP BY `e`.`writer_id`"); /

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