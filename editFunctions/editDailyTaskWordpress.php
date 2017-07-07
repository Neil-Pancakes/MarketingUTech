<?php
    require('../sql_connect.php');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $fixbug = $request['fixbugCnt'];
        $createpage = $request['createpageCnt'];
        $responsivedesign = $request['responsivedesignCnt'];
        $modifypage = $request['modifypageCnt'];
        $misc = $request['miscCnt'];

        $query = "UPDATE `wordpress_developer_tracker` 
        SET `fix_bug_cnt` = $fixbug, 
        `create_pages_cnt` = $createpage,
        `responsive_design_cnt` = $responsivedesign,
        `modify_pages_cnt` = $modifypage,
        `misc_cnt` = $misc
        WHERE `wordpress_developer_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
