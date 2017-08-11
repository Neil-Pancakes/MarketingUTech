<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $name = $request['name'];
        $type = $request['type'];

        $query = "UPDATE `additional_task` 
        SET `name` = '$name',
        SET `type` = '$type'
        WHERE `additional_task_tracker_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
