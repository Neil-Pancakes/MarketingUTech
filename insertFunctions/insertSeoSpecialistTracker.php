<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $dTask = $request['dailyTask'];
    $userId = $_SESSION['user_id'];

    $query = "INSERT INTO `seo_specialist_tracker`(`daily_task`, `track_date`, 
        `entry_time`, `user_id`) 
        VALUES ('$dTask', CURDATE(), NOW(), $userId)";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>