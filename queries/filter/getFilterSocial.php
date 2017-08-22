<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query "SELECT `social_media_id`, `fb_balay_cnt`, `pinterest_balay_cnt`, `mb_cnt`, `taft_cnt`, `wa_cnt`, entry_time 
			FROM `social_media_tracker`  
			WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id";

$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"SocialMediaId":"'  . $rs["social_media_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"FacebookCnt":"'   . $rs["fb_balay_cnt"]        . '",';
    $outp .= '"PinterestCnt":"'   . $rs["pinterest_balay_cnt"]        . '",';
    $outp .= '"MBCnt":"'   . $rs["mb_cnt"]        . '",';
    $outp .= '"TaftCnt":"'   . $rs["taft_cnt"]        . '",';
    $outp .= '"WACnt":"'   . $rs["wa_cnt"]        . '"}';
}

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>