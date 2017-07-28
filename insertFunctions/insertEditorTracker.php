<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $articles = $request['articleSet'];
    $words = $request['wordSet'];
    $array =  (array) $articles;

    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `editor_tracker`(`writer_id`, `word_cnt`, `track_date`, `entry_time`, `account_id`) 
        VALUES (".$array[$x]['WriterId'].", $words[$x], CURDATE(), NOW(), 3)";
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>