<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
SELECT CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`jobTitle`,
    SUM(CASE WHEN u.id = m.user_id THEN m.featured_image_cnt ELSE 0 END) AS `featuredCnt`,
    SUM(CASE WHEN u.id = m.user_id THEN m.graphic_designing_cnt ELSE 0 END) AS `graphicCnt`,
    SUM(CASE WHEN u.id = m.user_id THEN m.banner_cnt ELSE 0 END) AS `bannerCnt`,
    SUM(CASE WHEN u.id = m.user_id THEN m.misc_cnt ELSE 0 END) AS `miscCnt`
    FROM `multimedia_tracker` `m`
    INNER JOIN `users` `u`
    ON MONTH(`m`.`track_date`) = MONTH(CURRENT_DATE()) 
    AND `m`.`user_id` = `u`.`id`
    GROUP BY `u`.`id`
");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Name":"'  . $rs["name"] . '",';
    $outp .= '"JobTitle":"'   . $rs["jobTitle"]        . '",';
    $outp .= '"FeaturedCnt":"'   . $rs["featuredCnt"]        . '",';
    $outp .= '"GraphicCnt":"'   . $rs["graphicCnt"]        . '",';
    $outp .= '"BannerCnt":"'   . $rs["bannerCnt"]        . '",';
    $outp .= '"MiscCnt":"'   . $rs["miscCnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>
