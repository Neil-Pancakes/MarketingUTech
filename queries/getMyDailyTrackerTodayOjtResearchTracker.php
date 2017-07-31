<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `ojt_researcher_id`, `niche`, `num_companies` 
                        FROM `ojt_researcher_tracker` 
                        WHERE `track_date` = CURDATE() AND `user_id`=$val");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"OJT Researcher ID":"'  . $rs["ojt_researcher_id"] . '",';
    $outp .= '"Niche":"'   . $rs["niche"]        . '",';
    $outp .= '"Number of Companies":"'   . $rs["num_companies"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>