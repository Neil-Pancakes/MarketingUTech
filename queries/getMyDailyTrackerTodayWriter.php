<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_SESSION['user_id'];
$val2 = 'writer'.'_tracker';
$result = $mysqli->query("SELECT `writer_id`, `article_title`, `word_cnt` 
            FROM `$val2`
            WHERE `track_date` = CURDATE() AND `user_id`= $val");  

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Article":"'  . $rs["article_title"] . '",';
    $outp .= '"WriterId":"'   . $rs["writer_id"]        . '",';
    $outp .= '"WordCnt":"'   . $rs["word_cnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>