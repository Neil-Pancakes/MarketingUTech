<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $smid = $request['smid'];
    $fbcnt = $request['fbcnt'];
    $pinterestcnt = $request['pinterestcnt'];
    $mbcnt = $request['mbcnt'];
    $taftcnt = $request['taftcnt'];
    $wacnt = $request['wacnt'];

    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `social_media_tracker`(`social_media_id`, `fb_balay_cnt`, `pinterest_balay_cnt`, `mb_cnt`, `taft_cnt`, `wa_cnt`, `track_date`, `entry_time`, `account_id`) VALUES (".$smid",".$fbcnt",".$pinterestcnt",".$mbcnt",".$taftcnt",".$wacnt",CURDATE(),NOW(),1)";
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>