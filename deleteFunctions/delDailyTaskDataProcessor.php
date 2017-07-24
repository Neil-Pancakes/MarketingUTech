<?php
    require("../sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        
    
    $query = "DELETE FROM `data_processor_tracker` WHERE `data_processor_id` = $id";

    $result = mysqli_query($mysqli, $query);
  }
?>