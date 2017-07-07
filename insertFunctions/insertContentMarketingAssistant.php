<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $content_id = $request['content_id'];
    $curated_cnt = $request['curated_cnt'];
    $drafted_cnt = $request['drafted_cnt'];
    $pictures_cnt = $request['pictures_cnt'];
    $videos_cnt = $request['videos_cnt'];
    $misc_cnt = $request['misc_cnt'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `content_marketing_assistant`(`content_marketing_assistant_id`, `curated_cnt`, `drafted_cnt`, `pictures_cnt`, `videos_cnt`, `misc_cnt`, `track_date`, `entry_time`, `account_id`) VALUES (".$content_id",".$curated_cnt",".$drafted_cnt",".$pictures_cnt",".$videos_cnt",".$misc_cnt",CURDATE(),NOW(),1)";)
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>