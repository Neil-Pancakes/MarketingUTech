<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $niche = $request['niche'];
    $num_companies = $request['numOfCompanies'];
    $userId = $_SESSION['user_id'];

        $query = "INSERT INTO `ojt_researcher_tracker`(`niche`, `num_companies`, `track_date`, 
        `entry_time`, `user_id`) 
        VALUES ('$niche','$num_companies', CURDATE(), NOW(), $userId)";
        
        $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>