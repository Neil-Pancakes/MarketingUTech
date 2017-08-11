<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
SELECT CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`jobTitle`, 
`o`.`comment`, `o`.`site_audit`, `o`.`schema_markup`, `o`.`competitor_backlink_analysis`, 
`o`.`relationship_link_research`, `o`.`misc`, `o`.`entry_time`
FROM `ojt_seo_tracker` `o`
INNER JOIN `users` `u`
ON MONTH(`o`.`track_date`) = MONTH(CURRENT_DATE())
AND `o`.`user_id` = `u`.`id`
");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Name":"'  . $rs["name"] . '",';
    $outp .= '"JobTitle":"'   . $rs["jobTitle"]        . '",';
    $outp .= '"Comment":"'   . $rs["comment"]        . '",';
    $outp .= '"SiteAudit":"'   . $rs["site_audit"]        . '",';
    $outp .= '"SchemaMarkup":"'   . $rs["schema_markup"]        . '",';
    $outp .= '"Competitor":"'   . $rs["competitor_backlink_analysis"]        . '",';
    $outp .= '"Relationship":"'   . $rs["relationship_link_research"]        . '",';
    $outp .= '"Misc":"'   . $rs["misc"]        . '",';
    $outp .= '"Time":"'   . $rs["entry_time"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>
