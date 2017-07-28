<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $task = $request['dailyTask'];
    
    $query = "INSERT INTO `trackimo_cs_tracker`(`daily_task`, `track_date`, `entry_time`, `account_id`) 
        VALUES ('$task', CURDATE(), NOW(), 1)";
        $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>