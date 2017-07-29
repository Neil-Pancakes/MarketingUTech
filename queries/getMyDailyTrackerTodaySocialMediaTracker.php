<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");

$val = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `social_media_id`, `fb_balay_cnt`, `pinterest_balay_cnt`, `mb_cnt`, `taft_cnt`, `wa_cnt` 
						FROM `social_media_tracker`  
						WHERE `track_date` = CURDATE() AND `user_id`=$val");

$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"SocialMediaId":"'  . $rs["social_media_id"] . '",';
$outp .= '"FacebookCnt":"'   . $rs["fb_balay_cnt"]        . '",';
$outp .= '"PinterestCnt":"'   . $rs["pinterest_balay_cnt"]        . '",';
$outp .= '"MBCnt":"'   . $rs["mb_cnt"]        . '",';
$outp .= '"TaftCnt":"'   . $rs["taft_cnt"]        . '",';
$outp .= '"WACnt":"'   . $rs["wa_cnt"]        . '"}';

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>