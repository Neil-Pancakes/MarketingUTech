<?php
    require('../sql_connect.php');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $task = $request['dailytask'];

        $query = "UPDATE `seo_specialist_tracker` 
        SET `daily_task` = '$task'
        WHERE `seospecialist_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
