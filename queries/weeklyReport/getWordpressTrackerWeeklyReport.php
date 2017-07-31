<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
    SELECT CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`jobTitle`,
    SUM(CASE WHEN u.id = w.user_id THEN w.fix_bug_cnt ELSE 0 END) AS `fbCnt`,
    SUM(CASE WHEN u.id = w.user_id THEN w.create_pages_cnt ELSE 0 END) AS `cpCnt`,
    SUM(CASE WHEN u.id = w.user_id THEN w.responsive_design_cnt ELSE 0 END) AS `rdCnt`,
    SUM(CASE WHEN u.id = w.user_id THEN w.modify_pages_cnt ELSE 0 END) AS `mpCnt`,
    SUM(CASE WHEN u.id = w.user_id THEN w.misc_cnt ELSE 0 END) AS `miscCnt`
    FROM `wordpress_developer_tracker` `w`
    INNER JOIN `users` `u`
    ON `w`.`track_date` >= subdate(CURRENT_DATE, 7) AND `w`.`track_date` <= (CURRENT_DATE) 
    AND `w`.`user_id` = `u`.`id`
    GROUP BY `u`.`id`
");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Name":"'  . $rs["name"] . '",';
    $outp .= '"JobTitle":"'   . $rs["jobTitle"]        . '",';
    $outp .= '"FBCnt":"'   . $rs["fbCnt"]        . '",';
    $outp .= '"CPCnt":"'   . $rs["cpCnt"]        . '",';
    $outp .= '"RDCnt":"'   . $rs["rdCnt"]        . '",';
    $outp .= '"MPCnt":"'   . $rs["mpCnt"]        . '",';
    $outp .= '"MiscCnt":"'   . $rs["miscCnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>


