<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
SELECT CONCAT(`acc`.`fname`,' ', `acc`.`lname`) AS `name`, `acc`.`role`, `acc`.`job_title`,
SUM(CASE WHEN acc.account_id = w.account_id THEN w.fix_bug_cnt ELSE 0 END) AS `fbCnt`,
SUM(CASE WHEN acc.account_id = w.account_id THEN w.create_pages_cnt ELSE 0 END) AS `cpCnt`,
SUM(CASE WHEN acc.account_id = w.account_id THEN w.responsive_design_cnt ELSE 0 END) AS `rdCnt`,
SUM(CASE WHEN acc.account_id = w.account_id THEN w.modify_pages_cnt ELSE 0 END) AS `mpCnt`,
SUM(CASE WHEN acc.account_id = w.account_id THEN w.misc_cnt ELSE 0 END) AS `miscCnt`
FROM `wordpress_developer_tracker` `w`
INNER JOIN `account` `acc`
ON `w`.`track_date` >= subdate(CURRENT_DATE, 7) AND `w`.`track_date` <= (CURRENT_DATE) AND `w`.`account_id` = `acc`.`account_id`
GROUP BY `acc`.`account_id`
");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Article":"'  . $rs["article_title"] . '",';
    $outp .= '"WriterId":"'   . $rs["writer_id"]        . '",';
    $outp .= '"WordCnt":"'   . $rs["word_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>


