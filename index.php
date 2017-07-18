<?php
  ob_start();
  session_start();

  if(isset($_SESSION['loggedin'])){
    header("location: home.php");
    die();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Sign-in -->
    <meta name="google-signin-client_id" content="746015490934-gl3bvgacv9oq9b3kg1gpj4s2m76pa62j.apps.googleusercontent.com"/>
    <!-- Google Signout JS !-->
    <script src="includes/js/googleSignout.js"></script>
    <!-- Google Sign-in API -->
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

    <title>Sign in</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="includes/css/styles.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .login-button{
        padding-top: 5px;
      }
    </style>
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST" action="functions/login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          <div class="login-button btn-block" id="my-signin2"></div>
        </div>
      </form>

    </div> <!-- /container -->
  
  <script>
    function onSuccess(googleUser) {
      var id_token = googleUser.getAuthResponse().id_token;

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'functions/google-authenticate.php');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        console.log('Signed in as: ' + xhr.responseText);
        console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
        window.location.href = "home.php";
      };
      xhr.send('idtoken=' + id_token);
    }
    function onFailure(error) {
      console.log(error);
    }
    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 300,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });
    }
  </script>
  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
  </body>
</html>
