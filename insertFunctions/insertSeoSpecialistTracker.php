<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $dTask = $request['dailyTask'];
    
    $query = "INSERT INTO `seo_specialist_tracker`(`daily_task`, `track_date`, 
        `entry_time`, `account_id`) 
        VALUES ('$dTask', CURDATE(), NOW(), 1)";
        /*SELECT CONVERT(DATE, GetDate());*/
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>