<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $comment = $request['comment'];
        $site = $request['site'];
        $schema = $request['schema'];
        $competitor = $request['competitor'];
        $relationship = $request['relationship'];
        $misc = $request['misc'];

        $query = "UPDATE `ojt_seo_tracker` 
        SET `comment` = '$comment', 
        `site_audit` = '$site',
        `schema_markup` = '$schema',
        `competitor_backlink_analysis` = '$competitor',
        `relationship_link_research` = '$relationship',
        `misc` = '$misc'
        WHERE `ojt_seo_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
