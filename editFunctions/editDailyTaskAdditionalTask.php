<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $task = $request['task'];
        $query = "UPDATE `additional_task_tracker` 
        SET `task` = '$task',
        `track_date` = CURDATE(),
        `entry_time` = NOW()
        WHERE `additional_task_tracker_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
