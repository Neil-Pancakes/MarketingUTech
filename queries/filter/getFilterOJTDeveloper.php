<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
session_start();

$var1 =  $_GET['startDate'];
$var2 =  $_GET['endDate'];
$id = $_GET['userId'];
$query = "SELECT `ojt_developer_system_id`, `create_website`, `organize`, `misc`, `entry_time` 
			FROM `ojt_developer_system_tracker` 
			WHERE `track_date` >= $var1
            AND `track_date` <= $var2
            AND `user_id`= $id";

$result = $mysqli->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"OJTDeveloperSystemId":"'  . $rs["ojt_developer_system_id"] . '",';
    $outp .= '"Timestamp":"'   . $rs["entry_time"]        . '",';
    $outp .= '"CreateWebsite":"'   . $rs["create_website"]        . '",';
    $outp .= '"Organize":"'   . $rs["organize"]        . '",';
    $outp .= '"Misc":"'   . $rs["misc"]        . '"}';
    }

$outp ='{"records":['.$outp.']}';
$mysqli->close();
echo($outp);
?>
