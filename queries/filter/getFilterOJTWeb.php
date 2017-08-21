<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `ojt_webdev_id`, `fix_bugs_cnt`, `responsive_cnt`, `backup_cnt`, `optimize_cnt`, `misc_cnt`, entry_time 
			FROM `ojt_webdev_tracker` 
            WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id";
                        
$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"OJTWebDevId":"'  . $rs["ojt_webdev_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"FixBugCnt":"'   . $rs["fix_bugs_cnt"]        . '",';
    $outp .= '"ResponsiveCnt":"'   . $rs["responsive_cnt"]        . '",';
    $outp .= '"BackupCnt":"'   . $rs["backup_cnt"]        . '",';
    $outp .= '"OptimizeCnt":"'   . $rs["optimize_cnt"]        . '",';
    $outp .= '"MiscCnt":"'   . $rs["misc_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();
echo($outp);
?>