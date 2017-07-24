<?php
    require('../sql_connect.php');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $writerId = $request['writerId'];
        $wordCnt = $request['wordCnt'];

        $query = "UPDATE `editor_tracker` 
        SET `writer_id` = $writerId, `word_cnt` = $wordCnt 
        WHERE `editor_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
