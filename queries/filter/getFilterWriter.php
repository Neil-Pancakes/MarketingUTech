<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `writer_id`, `article_title`, `word_cnt`, entry_time 
            FROM `writer_tracker`
            WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id";

$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Article":"'  . $rs["article_title"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"WriterId":"'   . $rs["writer_id"]        . '",';
    $outp .= '"WordCnt":"'   . $rs["word_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>