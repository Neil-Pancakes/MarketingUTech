<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $task = $request['dailytask'];

        $query = "UPDATE `trackimo_cs_tracker` 
        SET `daily_task` = '$task'
        WHERE `trackimo_cs_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
