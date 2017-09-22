<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);

  if(count($request>0)){
    $name = $request['name'];
    $type = $request['type'];
    $userId = $request['userId'];
    
    $query = "INSERT INTO `additional_task`(`name`, `type`, `user_id`) 
        VALUES ('$name', '$type', $userId)";
        $result = mysqli_query($mysqli, $query);
    $last_id = $mysqli->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;

    $query2 = "INSERT INTO `additional_task_tracker`
    (`task`, `track_date`, `entry_time`, `additional_task_id`) 
    VALUES (' ', CURDATE(), NOW(), $last_id)";
    $result2 = mysqli_query($mysqli, $query2);
  }else{
      echo "error";
  }
?>