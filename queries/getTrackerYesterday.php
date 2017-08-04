<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../functions/sql_connect.php");
session_start();

$val = $_SESSION['user_id'];
$val2 = /*$_SESSION['jobTitle']*/"writer"."_tracker";

$result = $mysqli->query("SELECT *
            FROM `$val2`
            WHERE `track_date` = subdate(CURRENT_DATE, 1) AND `user_id` = $val");

$outp = "";
if(mysqli_num_rows($result)>0){
    $outp .='{"Status":"Yes"}';
}else{
    $outp .='{"Status":"No"}';
}

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>
