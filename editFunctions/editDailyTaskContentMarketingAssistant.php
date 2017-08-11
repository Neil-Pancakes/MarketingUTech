<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $curated = $request['curatedCnt'];
        $drafted = $request['draftedCnt'];
        $picture = $request['pictureCnt'];
        $video = $request['videoCnt'];
        $misc = $request['miscCnt'];

        $query = "UPDATE `content_marketing_assistant_tracker` 
        SET `curated_cnt` = $curated, 
        `drafted_cnt` = $drafted,
        `pictures_cnt` = $picture,
        `videos_cnt` = $video,
        `misc_cnt` = $misc
        WHERE `content_marketing_assistant_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
