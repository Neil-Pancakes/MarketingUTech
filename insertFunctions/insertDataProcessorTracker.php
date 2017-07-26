<?php 
  require("../sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $daily_task = $request['taskSet'];
    $task_status = $request['statusSet'];


    for($x=0; $x<count($daily_task); $x++){
        $query = "INSERT INTO `data_processor_tracker`(`daily_task`, `task_status`, 
        `track_date`, `entry_time`, `account_id`) 
        VALUES ('$daily_task[$x]', '$task_status[$x]', CURDATE(), NOW(), 1)";
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>