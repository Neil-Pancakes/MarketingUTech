<?php
    require('../sql_connect.php');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $createWebsite = $request['createWebsite'];
        $organize = $request['organize'];
        $misc = $request['misc'];

        $query = "UPDATE `ojt_developer_system_tracker` 
        SET `create_website` = '$createWebsite',
        `organize` = '$organize',
        `misc` = '$misc'
        WHERE `ojt_developer_system_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
