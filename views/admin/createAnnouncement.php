<?php
	require '../../functions/php_globals.php';

	$title = $_POST['title'];
	$message = $_POST['message'];
	$isBroadcast = 'false';

	if (isset($_POST['isBroadcast'])) {
		$isBroadcast = 'true';
	}
	echo $title;
	echo $message;
	echo $isBroadcast;

	foreach ($_POST['user'] as $user_id) {
		echo $user_id;
	}
?>