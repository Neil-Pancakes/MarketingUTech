<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
SELECT CONCAT(`acc`.`fname`,' ', `acc`.`lname`) AS `name`, `acc`.`role`, `acc`.`job_title`, 
`w`.`article_title`, `w`.`word_cnt`, `w`.`entry_time`
FROM `writer_tracker` `w`
INNER JOIN `account` `acc`
ON `w`.`track_date` >= subdate(CURRENT_DATE, 7) AND `w`.`track_date` <= (CURRENT_DATE) AND `w`.`account_id` = `acc`.`account_id`
");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Name":"'  . $rs["name"] . '",';
    $outp .= '"Role":"'   . $rs["role"]        . '",';
    $outp .= '"JobTitle":"'   . $rs["job_title"]        . '",';
    $outp .= '"Article":"'   . $rs["article_title"]        . '",';
    $outp .= '"WordCnt":"'   . $rs["word_cnt"]        . '",';
    $outp .= '"Time":"'   . $rs["entry_time"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>
