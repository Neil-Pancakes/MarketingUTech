<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `content_marketing_assistant_id`, `curated_cnt`, `drafted_cnt`, 
            `pictures_cnt`, `videos_cnt`, `misc_cnt`, `entry_time`
			FROM `content_marketing_assistant_tracker` 
			WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id";

$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"ContentMarketingAssistantId":"'  . $rs["content_marketing_assistant_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"CuratedCnt":"'   . $rs["curated_cnt"]        . '",';
    $outp .= '"DraftedCnt":"'   . $rs["drafted_cnt"]        . '",';
    $outp .= '"PictureCnt":"'   . $rs["pictures_cnt"]        . '",';
    $outp .= '"VideoCnt":"'   . $rs["videos_cnt"]        . '",';
    $outp .= '"MiscCnt":"'   . $rs["misc_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>