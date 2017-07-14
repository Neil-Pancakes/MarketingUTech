<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../sql_connect.php");

$result = $mysqli->query("SELECT `writer`.`writer_id`, `writer`.`article_title`,
CONCAT(`acc`.`fname`,' ', `acc`.`lname`) AS `name`, `acc`.`account_id`
FROM `writer_tracker` `writer`
INNER JOIN `account` `acc`
ON `acc`.`account_id` = `writer`.`account_id`
ORDER BY `writer`.`article_title` "); /*$_SESSION['account_id']*/

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Article":"'  . $rs["article_title"] . '",';
    $outp .= '"Writer":"'  . $rs["name"] . '",';
    $outp .= '"AccountId":"'  . $rs["account_id"] . '",';
    $outp .= '"WriterId":"'   . $rs["writer_id"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>