<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../sql_connect.php");

$result = $mysqli->query("SELECT `ojt_seo_id`, `comment`, `site_audit`, 
                        `schema_markup`, `competitor_backlink_analysis`, `relationship_link_research`, `misc` 
                        FROM `ojt_seo_tracker` 
                        WHERE `track_date` = CURDATE() AND `account_id`=1"); /*$_SESSION['account_id']*/

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"OJT SEO ID":"'  . $rs["ojt_seo_id"] . '",';
    $outp .= '"Comment":"'   . $rs["comment"]        . '",';
    $outp .= '"Site Audit":"'   . $rs["site_audit"]        . '",';
    $outp .= '"Schema Markup":"'   . $rs["schema_markup"]        . '",';
    $outp .= '"Competitor Backlink Analysis":"'   . $rs["competitor_backlink_analysis"]        . '",';
    $outp .= '"Relationship Link Research":"'   . $rs["relationship_link_research"]        . '",';
    $outp .= '"Misc":"'   . $rs["misc"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>