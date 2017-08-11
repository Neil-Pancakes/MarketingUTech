<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $name = $request['name'];
    $type = $request['type'];
    $userId = $_SESSION['user_id'];
    
    $query = "INSERT INTO `additional_task`(`name`, `type`, `user_id`) 
        VALUES ('$name', '$type', $userId)";
        $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>