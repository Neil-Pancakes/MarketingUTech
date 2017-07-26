<?php 
  require("../sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $comment = (isset($request['comment'])? $request['comment']:'No');
    $site_audit = (isset($request['siteAudit'])? $request['siteAudit']:'No');
    $schema_markup = (isset($request['schemaMarkup'])? $request['schemaMarkup']:'No');
    $competitor = (isset($request['competitor'])? $request['competitor']:'No');
    $relationship = (isset($request['relationship'])? $request['relationship']: 'No');
    $misc = (isset($request['misc'])? $request['misc']: '');
    
    $query = "INSERT INTO `ojt_seo_tracker`(`comment`, `site_audit`, `schema_markup`, 
        `competitor_backlink_analysis`, `relationship_link_research`, `misc`, `track_date`, 
        `entry_time`, `account_id`) 
        VALUES ('$comment','$site_audit','$schema_markup','$competitor',
        '$relationship','$misc', CURDATE(), NOW(), 1)";
    $result = mysqli_query($mysqli, $query);
    echo $result;
  }else{
      echo "error";
  }
?>