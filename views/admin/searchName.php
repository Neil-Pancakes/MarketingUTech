<?php
require ("../../functions/php_globals.php");

$keyword = $_POST['keyword'];
$query = "SELECT * FROM users WHERE firstName LIKE ('%".$keyword."%') OR lastName LIKE ('%".$keyword."%') ORDER BY id ASC LIMIT 0, 10";
$result = mysqli_query($mysqli, $query);
if($result){
	$list = mysqli_fetch_all($result, MYSQLI_ASSOC);
	foreach ($list as $rs) {
		// put in bold the written text
		$name = str_ireplace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['firstName']." ".$rs['lastName']);
		// add new option
	    echo '<li class="name_result" onclick="set_item(\''.str_replace("'", "\'", $rs['firstName']." ".$rs['lastName']).'\', '.$_POST['id'].', '.$rs['id'].')">'.$name.'</li>';
	}	
}

?>