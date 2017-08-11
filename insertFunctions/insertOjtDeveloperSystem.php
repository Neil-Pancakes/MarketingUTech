<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $ojt_id = $request['ojt_developer_system_id'];
    $create_website = $request['create_website'];
    $organize = $request['organize'];
    $misc = $request['misc'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `ojt_developer_system`(`ojt_developer_system_id`, `create_website`, `organize`, `misc`, `track_date`, `entry_time`, `account_id`) VALUES (".$ojt_id",".$create_website",".$organize",".$misc",CURDATE(),NOW(),1)";
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>