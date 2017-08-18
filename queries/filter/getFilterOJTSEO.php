<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `ojt_seo_id`, `comment`, `site_audit`, 
            `schema_markup`, `competitor_backlink_analysis`, `relationship_link_research`, `misc`, entry_time 
            FROM `ojt_seo_tracker` 
            WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id";
$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"OJTSeoId":"'  . $rs["ojt_seo_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"Comment":"'   . $rs["comment"]        . '",';
    $outp .= '"SiteAudit":"'   . $rs["site_audit"]        . '",';
    $outp .= '"SchemaMarkup":"'   . $rs["schema_markup"]        . '",';
    $outp .= '"CompetitorBacklinkAnalysis":"'   . $rs["competitor_backlink_analysis"]        . '",';
    $outp .= '"RelationshipLinkResearch":"'   . $rs["relationship_link_research"]        . '",';
    $outp .= '"Misc":"'   . $rs["misc"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>