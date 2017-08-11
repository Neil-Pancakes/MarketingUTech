<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $OJTID = $request['id'];
    $fixCnt = $request['fix_bugs_cnt'];
    $responCnt = $request['responsive_cnt'];
    $bkupCnt = $request['backup_cnt'];
    $optiCnt = $request['optimize_cnt'];
    $misc = $request['misc_cnt'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `ojt_webdev`(`ojt_webdev_id`, `fix_bugs_cnt`, `responsive_cnt`, `backup_cnt`, `optimize_cnt`, `misc_cnt`, `track_date`, `entry_time`, `account_id`) VALUES (".$OJTID",".$fixCnt",".$responCnt",".$bkupCnt",".$optiCnt",".$misc",CURDATE(),NOW(),1)";
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>