<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../sql_connect.php");

$result = $mysqli->query("SELECT `content_marketing_assistant_id`, `curated_cnt`, `drafted_cnt`, `pictures_cnt`, `videos_cnt`, `misc_cnt` 
						FROM `content_marketing_assistant_tracker` 
						WHERE `track_date` = CURDATE() AND `account_id`=1"); /*$_SESSION['account_id']*/

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Content Marketing Assistant ID":"'  . $rs["content_marketing_assistant_id"] . '",';
    $outp .= '"Curated Count":"'   . $rs["curated_cnt"]        . '",';
    $outp .= '"Drafted Count":"'   . $rs["drafted_cnt"]        . '",';
    $outp .= '"Picture Count":"'   . $rs["pictures_cnt"]        . '",';
    $outp .= '"Video Count":"'   . $rs["videos_cnt"]        . '",';
    $outp .= '"Misc":"'   . $rs["misc_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>