<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
SELECT CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`jobTitle`, 
`o`.`create_website`, `o`.`organize`, `o`.`misc`,`o`.`entry_time`
FROM `ojt_developer_system_tracker` `o`
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
    $outp .= '"CreateWebsite":"'   . $rs["create_website"]        . '",';
    $outp .= '"Organize":"'   . $rs["organize"]        . '",';
    $outp .= '"Misc":"'   . $rs["misc"]        . '",';
    $outp .= '"Time":"'   . $rs["entry_time"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>
