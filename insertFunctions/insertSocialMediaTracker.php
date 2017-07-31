<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $fbcnt = (isset($request['facebookCnt'])? $request['facebookCnt']:0);
    $pinterestcnt = (isset($request['pinterestCnt'])? $request['pinterestCnt']:0);
    $mbcnt = (isset($request['MBCnt'])? $request['MBCnt']:0);
    $taftcnt = (isset($request['taftCnt'])? $request['taftCnt']:0);
    $wacnt = (isset($request['WACnt'])? $request['WACnt']:0);
    $userId = $_SESSION['user_id'];

    $query = "INSERT INTO `social_media_tracker`(`fb_balay_cnt`, `pinterest_balay_cnt`, `mb_cnt`, 
      `taft_cnt`, `wa_cnt`, `track_date`, `entry_time`, `user_id`) 
      VALUES ($fbcnt, $pinterestcnt, $mbcnt, $taftcnt, $wacnt, CURDATE(), NOW(), $userId)";

    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>