<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $dev_ID = $request['wordpressDevID'];
    $fix_bug_cnt = $request['fixCnt'];
    $create_pages_cnt = $request['createPage'];
    $responsive_design_cnt = $request['respoDesignCnt'];
    $modify_pages_cnt = $request['modPageCnt'];
    $misc_cnt = $request['miscCnt'];

    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `wordpress_developer`(`wordpress_developer_id`, `fix_bug_cnt`, `create_pages_cnt`, `responsive_design_cnt`, `modify_pages_cnt`, `misc_cnt`, `track_date`, `entry_time`, `account_id`) VALUES (".$dev_ID",".$fix_bug_cnt",".$create_pages_cnt",".$responsive_design_cnt",".$modify_pages_cnt",".$misc_cnt",CURDATE(),NOW(),1)";
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>