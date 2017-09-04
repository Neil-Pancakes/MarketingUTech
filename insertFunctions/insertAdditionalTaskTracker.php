<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);

  if(count($request>0)){
    $task = $request['taskSet'];
    $additional_task_id = $request['idSet'];
    for($x=0; $x<count($task); $x++){
      if($task[$x]!=""){
        $query = "INSERT INTO `additional_task_tracker`
        (`task`, `track_date`, `entry_time`, `additional_task_id`) 
        VALUES ('$task[$x]', CURDATE(), NOW(), $additional_task_id[$x])";
        $result = mysqli_query($mysqli, $query);
      }
    }
  }else{
      echo "error";
  }
?>