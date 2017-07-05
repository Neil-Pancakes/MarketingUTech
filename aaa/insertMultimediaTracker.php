<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $multimedia_id = $request['multimedia_id'];
    $feature = $request['feature'];
    $graphic = $request['graphic'];
    $banner = $request['banner'];
    $misc_cnt = $request['misc_cnt'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `multimedia_tracker`(`multimedia_id`, `featured_image_cnt`, `graphic_designing_cnt`, `banner_cnt`, `misc_cnt`, `track_date`, `entry_time`, `account_id`) VALUES (".$multimedia_id",".$feature",".$graphic",".$banner",".$misc_cnt",CURDATE(),NOW(),1)";)
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>