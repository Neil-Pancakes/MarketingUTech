<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $marketing_id = $request['marketing_id'];
    $daily_task = $request['daily_task'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `marketing_tracker`(`marketing_id`, `daily_task`, `track_date`, `entry_time`, `account_id`) VALUES (".$marketing_id",".$daily_task",CURDATE(),NOW(),1)";)
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>