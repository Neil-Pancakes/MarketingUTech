<?php 
  require("../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request)>0){
    echo $request['fixbugCnt'];
    $fix_bug_cnt = (isset($request['fixbugCnt'])? $request['fixbugCnt']:0);
    $create_pages_cnt = (isset($request['createpageCnt'])? $request['createpageCnt']:0);
    $responsive_design_cnt = (isset($request['responsivedesignCnt'])? $request['responsivedesignCnt']:0);
    $modify_pages_cnt = (isset($request['modifypageCnt'])? $request['modifypageCnt']:0);
    $misc_cnt = (isset($request['miscCnt'])? $request['miscCnt']:0);

    $query = "INSERT INTO `wordpress_developer_tracker`(`fix_bug_cnt`, `create_pages_cnt`, `responsive_design_cnt`, `modify_pages_cnt`, `misc_cnt`, `track_date`, `entry_time`, `account_id`) 
    VALUES 
    ($fix_bug_cnt, $create_pages_cnt, $responsive_design_cnt, $modify_pages_cnt, $misc_cnt, CURDATE(), NOW(),1)";
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>