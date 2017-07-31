<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $featuredImg = $request['featuredimgCnt'];
        $graphicDesigning = $request['graphicdesigningCnt'];
        $banner = $request['bannerCnt'];
        $misc = $request['miscCnt'];

        $query = "UPDATE `multimedia_tracker` 
        SET `featured_image_cnt` = $featuredImg, 
        `graphic_designing_cnt` = $graphicDesigning,
        `banner_cnt` = $banner,
        `misc_cnt` = $misc
        WHERE `multimedia_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
