<?php
    require('../sql_connect.php');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $facebookCnt = $request['facebookCnt'];
        $pinterestCnt = $request['pinterestCnt'];
        $mbCnt = $request['mbCnt'];
        $taftCnt = $request['taftCnt'];
        $waCnt = $request['waCnt'];

        $query = "UPDATE `social_media_tracker` 
        SET `fb_balay_cnt` = $facebookCnt, 
        `pinterest_balay_cnt` = $pinterestCnt,
        `mb_cnt` = $mbCnt,
        `taft_cnt` = $taftCnt,
        `wa_cnt` = $waCnt
        WHERE `social_media_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
