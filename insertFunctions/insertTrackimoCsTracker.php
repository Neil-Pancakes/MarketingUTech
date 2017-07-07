<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $TCS_ID = $request['trakimo_cd_id'];
    $task = $request['daily_task'];
    

    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `trackimo_cs_tracker`(`trackimo_cs_id`, `daily_task`, `track_date`, `entry_time`, `account_id`) VALUES (".$TCS_ID",".$task",CURDATE(),NOW(),1)";
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>