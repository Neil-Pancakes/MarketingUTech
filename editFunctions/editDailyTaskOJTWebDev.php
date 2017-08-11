<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $fixbug = $request['fixbugCnt'];
        $responsive = $request['responsiveCnt'];
        $backup = $request['backupCnt'];
        $optimize = $request['optimizeCnt'];
        $misc = $request['miscCnt'];

        $query = "UPDATE `ojt_webdev_tracker` 
        SET `fix_bugs_cnt` = $fixbug, 
        `responsive_cnt` = $responsive,
        `backup_cnt` = $backup,
        `optimize_cnt` = $optimize,
        `misc_cnt` = $misc
        WHERE `ojt_webdev_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
