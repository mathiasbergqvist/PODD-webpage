<?php
  //Set session variables if logged in
  include_once("php_includes/login_functions.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/ic_main_logo.png">

    <title>PODD - Protable diary data collection</title>


    <!--Include the jQuery scripts-->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- CSS stylesheet -->
    <link rel="stylesheet" type="text/css" href="stylesheet.css">

    <!-- Bootstrap - Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Bootstrap - Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Bootstrap - Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <div id="main_navbar" class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php?site=home"><img src="images/ic_main_logo.png" class="img-responsive" alt="Responsive image"></a>
          </div>
          
          <?php
            if(loggedin()){
              ?>

              <ul class="nav navbar-nav">
                <li id="nav-home"  <?php if($_GET['site'] == "profile"){echo "class=active";}?> ><a href="index.php?site=profile&user=<?php echo $_SESSION['name'] ?>">Hem</a></li>
                <li id="nav-info" <?php if($_GET['site'] == "info"){echo "class=active";}?> ><a href="index.php?site=info">Info</a></li>
              </ul>
              <button type="button" id="btn-logout" class="btn btn-primary navbar-btn">Logga ut</button>

              <?php
            }
          ?>

        </div>
      </div>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

        <div id="body">

          <?php
            $subpages = array("home", "login", "register", "profile", "info");
            if(isset($_GET['site'] ) and in_array($_GET['site'], $subpages))
            {
              include($_GET['site'] . ".php");
            }
            else
            {
              include("home.php");
            }
          ?>

        </div>
      </div>

    </div> <!-- /container -->

    <div id="footer">
      <div class="container">
        <p class="text-muted">PODD är utvecklad av avdelningen för <a href="http://www.itn.liu.se/mit?l=sv">Medie- och Informationsteknik - MIT</a> vid Linköpings Universitet.</p>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script type="text/javascript" src="scripts.js"></script>
    <!-- Placed at the end of the document so the pages load faster
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
     -->
    <!--
    <script type='text/javascript'>
      $(document).ready(function() {
           $('.carousel').carousel({
               interval: 2000
           })
      });    
    </script>
  -->
  </body>
</html>
