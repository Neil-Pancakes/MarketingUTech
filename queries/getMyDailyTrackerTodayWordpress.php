<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `wordpress_developer_id`, `fix_bug_cnt`, `create_pages_cnt`,
            `responsive_design_cnt`, `modify_pages_cnt`, `misc_cnt`
            FROM `wordpress_developer_tracker`
            WHERE `track_date` = CURDATE() AND `user_id`=$val"); 
            
$rs = $result->fetch_array(MYSQLI_ASSOC);

$outp = "";
$outp .= '{"WordpressId":"'  . $rs["wordpress_developer_id"] . '",';
$outp .= '"FixBugCnt":"'   . $rs["fix_bug_cnt"]        . '",';
$outp .= '"CreatePagesCnt":"'   . $rs["create_pages_cnt"]        . '",';
$outp .= '"ResponsiveDesignCnt":"'   . $rs["responsive_design_cnt"]        . '",';
$outp .= '"ModifyPagesCnt":"'   . $rs["modify_pages_cnt"]        . '",';
$outp .= '"MiscCnt":"'   . $rs["misc_cnt"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>