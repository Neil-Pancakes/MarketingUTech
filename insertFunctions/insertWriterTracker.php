<?php 
  require("../sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
echo $request;
  if(count($request>0)){
    $articles = $request['articleSet'];
    $words = $request['wordSet'];
    
    
    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO writer_tracker (article_title, word_cnt, track_date, entry_time, account_id) VALUES 
        ('".$articles[$x]."', ".$words[$x].", CURDATE(), NOW(), 1)";
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>