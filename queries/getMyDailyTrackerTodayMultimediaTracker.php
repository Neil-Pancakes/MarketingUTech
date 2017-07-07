<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../sql_connect.php");

$result = $mysqli->query("SELECT `multimedia_id`, `featured_image_cnt`, `graphic_designing_cnt`, `banner_cnt`, `misc_cnt` 
						FROM `multimedia_tracker` 
						WHERE `track_date` = CURDATE() AND `account_id`=1"); /*$_SESSION['account_id']*/

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Multimedia ID":"'  . $rs["multimedia_id"] . '",';
    $outp .= '"Feature Image Count:"'   . $rs["featured_image_cnt"]        . '",';
    $outp .= '"Graphic Designing Count":"'   . $rs["graphic_designing_cnt"]        . '",';
    $outp .= '"Banner Count":"'   . $rs["banner_cnt"]        . '",';
    $outp .= '"Misc":"'   . $rs["misc_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>