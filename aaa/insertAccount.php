<?php 
  require("sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  if(count($request>0)){
    $account_id = $request['account_id'];
    $email = $request['email'];
    $fname = $request['fname'];
    $lname = $request['lname'];
    $role = $request['role'];
    $job_title = $request['job_title'];
    $pass = $request['pass'];


    for($x=0; $x<count($articles); $x++){
        $query = "INSERT INTO `account`(`account_id`, `email`, `fname`, `lname`, `role`, `job_title`, `pass`) VALUES (".$account_id",".$email",".$fname",".$lname",".$role",".$job_title",".$pass")";)
        /*SELECT CONVERT(DATE, GetDate());*/
        $result = mysqli_query($mysqli, $query);
    }
  }else{
      echo "error";
  }
?>