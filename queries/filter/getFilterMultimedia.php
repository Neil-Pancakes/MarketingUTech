<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `multimedia_id`, `featured_image_cnt`, `graphic_designing_cnt`, `banner_cnt`,
            `misc_cnt`, `entry_time`
			FROM `multimedia_tracker` 
			WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id";


$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"MultimediaId":"'  . $rs["multimedia_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"FeaturedImageCnt":"'   . $rs["featured_image_cnt"]        . '",';
    $outp .= '"GraphicDesigningCnt":"'   . $rs["graphic_designing_cnt"]        . '",';
    $outp .= '"BannerCnt":"'   . $rs["banner_cnt"]        . '",';
    $outp .= '"MiscCnt":"'   . $rs["misc_cnt"]        . '"}';
}

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>