<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $feature = (isset($request['featuredimgCnt'])? $request['featuredimgCnt']:0);
    $graphic = (isset($request['graphicdesigningCnt'])? $request['graphicdesigningCnt']:0);
    $banner = (isset($request['bannerCnt'])? $request['bannerCnt']:0);
    $misc = (isset($request['miscCnt'])? $request['miscCnt']:0);


    $query = "INSERT INTO `multimedia_tracker`(`featured_image_cnt`, `graphic_designing_cnt`, `banner_cnt`, `misc_cnt`, `track_date`, `entry_time`, `account_id`) 
        VALUES ($feature, $graphic, $banner, $misc, CURDATE(),NOW(),1)";
        /*SELECT CONVERT(DATE, GetDate());*/
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>