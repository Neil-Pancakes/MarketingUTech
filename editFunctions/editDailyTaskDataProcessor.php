<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $status = $request['status'];
        $task = $request['task'];

        $query = "UPDATE `data_processor_tracker` 
        SET `daily_task` = '$task', `task_status` = '$status' 
        WHERE `data_processor_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
