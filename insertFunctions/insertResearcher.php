<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $ojt_researcher_id = $request['ojt_researcher_id'];
    $niche = $request['niche'];
    $num_companies = $request['num_companies'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `ojt_researcher`(`ojt_researcher_id`, `niche`, `num_companies`, `track_date`, `entry_time`, `account_id`) VALUES (".$ojt_researcher_id",".$niche",".$num_companies",CURDATE(),NOW(),1)";
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>