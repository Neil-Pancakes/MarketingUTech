<?php
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  if(count($request>0)){
    @$email = $request->articleSet;
    @$pass = $request->wordSet;
  }else{
      echo "error";
  }
?>