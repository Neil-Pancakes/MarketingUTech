<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `ojt_researcher_id`, `niche`, `num_companies`, `entry_time`
            FROM `ojt_researcher_tracker` 
            WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id";

$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"OJTResearcherId":"'  . $rs["ojt_researcher_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"Niche":"'   . $rs["niche"]        . '",';
    $outp .= '"NumOfCompanies":"'   . $rs["num_companies"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>