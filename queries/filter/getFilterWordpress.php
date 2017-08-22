<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `wordpress_developer_id`, `fix_bug_cnt`, `create_pages_cnt`,
            `responsive_design_cnt`, `modify_pages_cnt`, `misc_cnt`, entry_time
            FROM `wordpress_developer_tracker`
            WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id"; 
            
$result = $mysqli->query($query);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"WordpressId":"'  . $rs["wordpress_developer_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"FixBugCnt":"'   . $rs["fix_bug_cnt"]        . '",';
    $outp .= '"CreatePagesCnt":"'   . $rs["create_pages_cnt"]        . '",';
    $outp .= '"ResponsiveDesignCnt":"'   . $rs["responsive_design_cnt"]        . '",';
    $outp .= '"ModifyPagesCnt":"'   . $rs["modify_pages_cnt"]        . '",';
    $outp .= '"MiscCnt":"'   . $rs["misc_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>