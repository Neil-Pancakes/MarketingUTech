<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

$val = 'OJT'; /*$_SESSION['jobTitle'];*/
$result = $mysqli->query("SELECT `u`.`id`, CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`
FROM `users` `u`
WHERE `u`.`jobTitle`= '$val'");  

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Id":"'  . $rs["id"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>