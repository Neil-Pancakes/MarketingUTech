<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $article = $request['article'];
        $wordCnt = $request['wordCnt'];

        $query = "UPDATE `writer_tracker` SET `article_title` = '".$article."', `word_cnt` = '".$wordCnt."' WHERE `writer_id` = '".$id."'";

        $result = mysqli_query($mysqli, $query);
    }
?>