<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../sql_connect.php");

$result = $mysqli->query("SELECT `social_media_id`, `fb_balay_cnt`, `pinterest_balay_cnt`, `mb_cnt`, `taft_cnt`, `wa_cnt` 
						FROM `social_media_tracker`  
						WHERE `track_date` = CURDATE() AND `account_id`=1"); /*$_SESSION['account_id']*/

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Social Media ID":"'  . $rs["social_media_id"] . '",';
    $outp .= '"Facebook Count":"'   . $rs["fb_balay_cnt"]        . '",';
    $outp .= '"Pinterest Count":"'   . $rs["pinterest_balay_cnt"]        . '",';
    $outp .= '"MB count":"'   . $rs["mb_cnt"]        . '",';
    $outp .= '"Taft Count":"'   . $rs["taft_cnt"]        . '",';
    $outp .= '"WA count":"'   . $rs["wa_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>