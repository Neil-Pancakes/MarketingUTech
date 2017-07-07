<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $SEOID = $request['id'];
    $dTask = $request['dTask'];
    

    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `seo_specialist`(`seospecialist_id`, `daily_task`, `track_date`, `entry_time`, `account_id`) VALUES (".$SEOID",".$dTask",CURDATE(),NOW(),1)";
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>