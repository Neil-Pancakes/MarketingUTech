<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
SELECT CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`jobTitle`,
    SUM(CASE WHEN u.id = s.user_id THEN s.fb_balay_cnt ELSE 0 END) AS `fbCnt`,
    SUM(CASE WHEN u.id = s.user_id THEN s.pinterest_balay_cnt ELSE 0 END) AS `pinterestCnt`,
    SUM(CASE WHEN u.id = s.user_id THEN s.mb_cnt ELSE 0 END) AS `mbCnt`,
    SUM(CASE WHEN u.id = s.user_id THEN s.taft_cnt ELSE 0 END) AS `taftCnt`,
    SUM(CASE WHEN u.id = s.user_id THEN s.wa_cnt ELSE 0 END) AS `waCnt`
    FROM `social_media_tracker` `s`
    INNER JOIN `users` `u`
    ON `s`.`track_date` >= subdate(CURRENT_DATE, 7) AND `s`.`track_date` <= (CURRENT_DATE) 
    AND `s`.`user_id` = `u`.`id`
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
    $outp .= '"PinterestCnt":"'   . $rs["pinterestCnt"]        . '",';
    $outp .= '"MBCnt":"'   . $rs["mbCnt"]        . '",';
    $outp .= '"TaftCnt":"'   . $rs["taftCnt"]        . '",';
    $outp .= '"WACnt":"'   . $rs["waCnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>
