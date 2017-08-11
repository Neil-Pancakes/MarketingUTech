<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $articles = $request['articleSet'];
    $words = $request['wordSet'];
    $array =  (array) $articles;
    $userId = $_SESSION['user_id'];

    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `editor_tracker`(`writer_id`, `word_cnt`, `track_date`, `entry_time`, `user_id`) 
        VALUES (".$array[$x]['WriterId'].", $words[$x], CURDATE(), NOW(), $userId)";
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>