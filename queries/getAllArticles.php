<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	require("../functions/sql_connect.php");

	$query = "SELECT `writer`.`writer_id`, `writer`.`article_title`, CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`id`FROM `writer_tracker` `writer` INNER JOIN `users` `u` ON `u`.`id` = `writer`.`user_id` ORDER BY `writer`.`article_title` ";
	$result = $mysqli->query($query);

	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {
	        $outp .= ",";
	    }
	    $outp .= '{"Article":"'  . $rs["article_title"] . '",';
	    $outp .= '"Writer":"'  . $rs["name"] . '",';
	    $outp .= '"WriterId":"'   . $rs["writer_id"]        . '"}';
	}
	$outp ='{"records":['.$outp.']}';
	$mysqli->close();

	echo($outp);
?>