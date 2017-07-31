<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $feature = (isset($request['featuredimgCnt'])? $request['featuredimgCnt']:0);
    $graphic = (isset($request['graphicdesigningCnt'])? $request['graphicdesigningCnt']:0);
    $banner = (isset($request['bannerCnt'])? $request['bannerCnt']:0);
    $misc = (isset($request['miscCnt'])? $request['miscCnt']:0);
    $userId = $_SESSION['user_id'];

    $query = "INSERT INTO `multimedia_tracker`(`featured_image_cnt`, `graphic_designing_cnt`, 
    `banner_cnt`, `misc_cnt`, `track_date`, `entry_time`, `user_id`) 
        VALUES ($feature, $graphic, $banner, $misc, CURDATE(), NOW(), $userId)";
        /*SELECT CONVERT(DATE, GetDate());*/
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>