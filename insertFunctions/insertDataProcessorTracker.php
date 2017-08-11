<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $data_id = $request['data_id'];
    $daily_task = $request['daily_task'];
    $task_status = $request['task_status'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `data_processor_tracker`(`data_processor_id`, `daily_task`, `task_status`, `track_date`, `entry_time`, `account_id`) VALUES (".$data_id",".$daily_task",".$task_status",CURDATE(),NOW(),1)";)
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>