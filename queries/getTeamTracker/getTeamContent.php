<?php /*Unused*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

$val = $_GET['id'];
$result = $mysqli->query("SELECT `content_marketing_assistant_id`, `curated_cnt`, `drafted_cnt`, `pictures_cnt`, `videos_cnt`, `misc_cnt` 
						FROM `content_marketing_assistant_tracker` 
						WHERE `track_date` = CURDATE() AND `user_id`=$val");

$rs = $result->fetch_array(MYSQLI_ASSOC);

$outp = "";
$outp .= '{"ContentMarketingAssistantId":"'  . $rs["content_marketing_assistant_id"] . '",';
$outp .= '"CuratedCnt":"'   . $rs["curated_cnt"]        . '",';
$outp .= '"DraftedCnt":"'   . $rs["drafted_cnt"]        . '",';
$outp .= '"PictureCnt":"'   . $rs["pictures_cnt"]        . '",';
$outp .= '"VideoCnt":"'   . $rs["videos_cnt"]        . '",';
$outp .= '"MiscCnt":"'   . $rs["misc_cnt"]        . '"}';

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>