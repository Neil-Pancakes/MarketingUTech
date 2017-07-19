<?php
  date_default_timezone_set('Asia/Manila');

  if(isset($_GET['time'])) {
  	echo $timestamp = date('h:i:s A');
  }  

  if(isset($_GET['date'])) {
  	echo $timestamp = date('M d, Y');
  }
?>