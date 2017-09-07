<?php
	require ("../../functions/php_globals.php");

	if(isset($_POST['a_id']) && isset($_POST['ac_id'])){
		$query = 'UPDATE `announcement`
			SET `isRead` = "true"
			WHERE id = "'.$_POST['a_id'].'"
		';
		if(mysqli_query($mysqli, $query)){
			$query = 'SELECT *
				FROM `announcement_content`
				WHERE `id` = "'.$_POST['ac_id'].'"
			';
			$result = mysqli_query($mysqli, $query);
			if($result){
				$row = mysqli_fetch_assoc($result);
				$query = 'SELECT * 
					FROM `announcement` 
					WHERE `id` = "'.$_POST['a_id'].'"
				';
				$result = mysqli_query($mysqli, $query);
				if($result){
					$row2 = mysqli_fetch_assoc($result);
					if($row2['isRead'] == 'true'){
						$isRead = "Read";
					} else {
						$isRead = "<strong>Unread</strong>";
					}
					echo "
						<tr id='".$row['id']."' data-toggle='modal' data-target='#viewModal'>
						<td>".$row['title']."</td>
						<td>".$isRead."</td>
						</tr>
						<p id='msg_".$row['id']."' hidden>".$row['message']."</p>
					";
				}
			}
		}
	}
?>