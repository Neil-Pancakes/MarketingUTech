<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $ojt_id = $request['ojt_developer_system_id'];
    $create_website = $request['createWebsite'];
    $organize = $request['organize'];
    $misc = $request['misc'];
    $userId = $_SESSION['user_id'];

    $query = "INSERT INTO `ojt_developer_system_tracker`(`create_website`, `organize`, `misc`, 
        `track_date`, `entry_time`, `user_id`) 
        VALUES ('$create_website', '$organize', '$misc', CURDATE(), NOW(), $userId)";
        $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>