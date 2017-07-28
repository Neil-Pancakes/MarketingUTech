<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $create_website = $request['createWebsite'];
    $organize = $request['organize'];
    $misc = $request['misc'];


    $query = "INSERT INTO `ojt_developer_system_tracker`(`create_website`, `organize`, `misc`, 
        `track_date`, `entry_time`, `account_id`) 
        VALUES ('$create_website', '$organize', '$misc', CURDATE(), NOW(), 1)";
        /*SELECT CONVERT(DATE, GetDate());*/
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>