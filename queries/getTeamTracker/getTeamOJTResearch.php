<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

$val = $_GET['id'];
$result = $mysqli->query("SELECT `ojt_researcher_id`, `niche`, `num_companies` 
                        FROM `ojt_researcher_tracker` 
                        WHERE `track_date` = CURDATE() AND `user_id`=$val");

$outp = "";
$rs = $result->fetch_array(MYSQLI_ASSOC);
    $outp .= '{"OJTResearcherId":"'  . $rs["ojt_researcher_id"] . '",';
    $outp .= '"Niche":"'   . $rs["niche"]        . '",';
    $outp .= '"NumOfCompanies":"'   . $rs["num_companies"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>