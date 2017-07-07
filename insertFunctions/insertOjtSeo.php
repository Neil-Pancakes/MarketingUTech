<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $ojt_seo_id = $request['ojt_seo_id'];
    $comment = $request['comment'];
    $site_audit = $request['site_audit'];
    $schema_markup = $request['schema_markup'];
    $competitor = $request['competitor'];
    $relationship = $request['relationship'];
    $misc = $request['misc'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `ojt_seo`(`ojt_seo_id`, `comment`, `site_audit`, `schema_markup`, `competitor_backlink_analysis`, `relationship_link_research`, `misc`, `track_date`, `entry_time`, `account_id`) VALUES (".$ojt_seo_id",".$comment",".$site_audit",".$schema_markup",".$competitor",".$relationship",".$misc",CURDATE(),NOW(),1)";
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>