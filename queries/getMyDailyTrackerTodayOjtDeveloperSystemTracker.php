<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `ojt_developer_system_id`, `create_website`, `organize`, `misc` 
						FROM `ojt_developer_system_tracker` 
						WHERE `track_date` = CURDATE() AND `user_id`=$val");
$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"OJTDeveloperSystemId":"'  . $rs["ojt_developer_system_id"] . '",';
$outp .= '"CreateWebsite":"'   . $rs["create_website"]        . '",';
$outp .= '"Organize":"'   . $rs["organize"]        . '",';
$outp .= '"Misc":"'   . $rs["misc"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();
echo($outp);
?>
