<?php
    require("../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    if(count($request>0)){
        $id = $request['id'];
        $niche = $request['niche'];
        $numOfCompanies = $request['numOfCompanies'];

        $query = "UPDATE `ojt_researcher_tracker` 
        SET `niche` = '$niche',
        `num_companies` = '$numOfCompanies'
        WHERE `ojt_researcher_id` = $id";

        $result = mysqli_query($mysqli, $query);
    }
?>
