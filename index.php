<?php
  ob_start();
  session_start();

  if(isset($_SESSION['loggedin'])){
    header("location:views/home/home.php");
    die();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="746015490934-gl3bvgacv9oq9b3kg1gpj4s2m76pa62j.apps.googleusercontent.com"/>
    
    <title>EIMS - Log In</title>

    <!-- JS !-->
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>

    <!-- CSS !-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.css">
    <link href="includes/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="includes/css/styles.css">
    <link rel="stylesheet" href="includes/css/signin.css">

  </head>

  <body>

    <div class="container">

      <div class="col-md-12 text-center">
        <img src="includes/img/utech_logo.png" class="logo">
      </div>

      <?php 
        if(isset($_GET['err']) && isset($_SESSION["error"])) {
          echo '
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center alert alert-danger" role="alert">
                  '.$_SESSION["error"].'
                </div>
              </div>';
        }
      ?>
      
      <form class="form-signin" method="POST" action="functions/login.php">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <div>
          <button class="btn btn-lg btn-primary btn-block" onclick="showLoading()" type="submit">Sign in</button>
          <div class="google-signin-button btn-block" id="my-signin2"></div>
        </div>
      </form>
    </div> <!-- /container -->
  
  <script type="text/javascript">

    function onSuccess(googleUser) {

      showLoadingGoogle(googleUser);

      var id_token = googleUser.getAuthResponse().id_token;

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'functions/google-authenticate.php');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        window.location.href = "views/home/home.php";
      };
      xhr.send('idtoken=' + id_token);
    }

    function onFailure(error) {
      window.location.href = "index";
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

    function showLoadingGoogle(googleUser){
      swal({
       title: "Logging in as:",
       text: googleUser.getBasicProfile().getName(),
       allowOutsideClick: false
      });
      swal.showLoading();
    }

    function showLoading(){
      swal({
       title: "Logging in",
       allowOutsideClick: false
      });
      swal.showLoading();
    }
  </script>

  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
  
  </body>
</html>
