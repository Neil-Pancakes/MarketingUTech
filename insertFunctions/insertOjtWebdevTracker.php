<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $fixCnt = (isset($request['fixbugCnt'])? $request['fixbugCnt']:0);
    $responCnt = (isset($request['responsiveCnt'])? $request['responsiveCnt']:0);
    $bkupCnt = (isset($request['backupCnt'])? $request['backupCnt']:0);
    $optiCnt = (isset($request['optimizeCnt'])? $request['optimizeCnt']:0);
    $misc = (isset($request['miscCnt'])? $request['miscCnt']:0);
    $userId = $_SESSION['user_id'];

    $query = "INSERT INTO `ojt_webdev_tracker`(`fix_bugs_cnt`, `responsive_cnt`, `backup_cnt`, `optimize_cnt`, 
        `misc_cnt`, `track_date`, `entry_time`, `user_id`) 
        VALUES ($fixCnt, $responCnt, $bkupCnt, $optiCnt, $misc, CURDATE(), NOW(), $userId)";
        /*SELECT CONVERT(DATE, GetDate());*/
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>