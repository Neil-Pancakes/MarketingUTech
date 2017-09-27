<?php /*Unused*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
SELECT CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`jobTitle`, 
`w`.`article_title`, `w`.`word_cnt`, `w`.`entry_time`
FROM `writer_tracker` `w`
INNER JOIN `users` `u`
ON YEAR(`w`.`track_date`) = YEAR(CURRENT_DATE()) AND 
`w`.`user_id` = `u`.`id`
");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Name":"'  . $rs["name"] . '",';
    $outp .= '"JobTitle":"'   . $rs["jobTitle"]        . '",';
    $outp .= '"Article":"'   . $rs["article_title"]        . '",';
    $outp .= '"WordCnt":"'   . $rs["word_cnt"]        . '",';
    $outp .= '"Time":"'   . $rs["entry_time"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>
