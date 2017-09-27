<?php /*Unused*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
SELECT CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`jobTitle`, `e`.`word_cnt`, 
CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `w`.`article_title`, `e`.`entry_time`
FROM `editor_tracker` `e`
INNER JOIN `writer_tracker` `w`
ON `w`.`writer_id` = `e`.`writer_id`
INNER JOIN `users` `u`
ON `e`.`track_date` >= subdate(CURRENT_DATE, 7) AND `e`.`track_date` <= (CURRENT_DATE) AND `e`.`user_id` = `u`.`id`
");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"EditorName":"'  . $rs["editorName"] . '",';
    $outp .= '"JobTitle":"'   . $rs["jobTitle"]        . '",';
    $outp .= '"WordCnt":"'   . $rs["word_cnt"]        . '",';
    $outp .= '"WriterName":"'   . $rs["writerName"]        . '",';
    $outp .= '"ArticleTitle":"'   . $rs["article_title"]        . '",';
    $outp .= '"Time":"'   . $rs["entry_time"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>
