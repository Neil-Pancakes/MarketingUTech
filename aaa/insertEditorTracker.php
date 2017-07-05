<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $editor_id = $request['editor_id'];
    $writer_id = $request['writer_id'];
    $word_cnt = $request['word_cnt'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `editor_tracker`(`editor_id`, `writer_id`, `word_cnt`, `track_date`, `entry_time`, `account_id`) VALUES (".$editor_id",".$writer_id",".$word_cnt",CURDATE(),NOW(),1)";)
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>