<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
    SELECT CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`jobTitle`,
    SUM(CASE WHEN u.id = c.user_id THEN c.curated_cnt ELSE 0 END) AS `curatedCnt`,
    SUM(CASE WHEN u.id = c.user_id THEN c.drafted_cnt ELSE 0 END) AS `draftedCnt`,
    SUM(CASE WHEN u.id = c.user_id THEN c.pictures_cnt ELSE 0 END) AS `picturesCnt`,
    SUM(CASE WHEN u.id = c.user_id THEN c.videos_cnt ELSE 0 END) AS `videosCnt`,
    SUM(CASE WHEN u.id = c.user_id THEN c.misc_cnt ELSE 0 END) AS `miscCnt`
    FROM `content_marketing_assistant_tracker` `c`
    INNER JOIN `users` `u`
    ON YEAR(`c`.`track_date`) = YEAR(CURRENT_DATE())
    AND `c`.`user_id` = `u`.`id`
    GROUP BY `u`.`id`
");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Name":"'  . $rs["name"] . '",';
    $outp .= '"JobTitle":"'   . $rs["jobTitle"]        . '",';
    $outp .= '"CuratedCnt":"'   . $rs["curatedCnt"]        . '",';
    $outp .= '"DraftedCnt":"'   . $rs["draftedCnt"]        . '",';
    $outp .= '"PicturesCnt":"'   . $rs["picturesCnt"]        . '",';
    $outp .= '"VideosCnt":"'   . $rs["videosCnt"]        . '",';
    $outp .= '"MiscCnt":"'   . $rs["miscCnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>


