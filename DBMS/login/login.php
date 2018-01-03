<?php

include '../connection/conn.php';
session_start();
// include '../navbar.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
    Pinstagram | Sign In
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="bgcss/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<style>
.w3-lobster {
    font-family: "Lobster", serif;
}
</style>

    <style>
    .error-message{
      color: red;
      background-color: #ffb116; 
      width: 100%; 
      height: 30px; 
      border-radius: 5px; 
      margin-top:10px; 
      padding: 3px;
    }
    .form-control:focus {
  border-color: #8134AF;
 box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
}
    </style>
  </head>
  <body>

    <?php
    //PHP script for showing messages
          if ($_SESSION['message']!=null) {
            echo "<div class=\"error-message\">";
            echo $_SESSION['message'];
            echo " </div>";
            $_SESSION['message'] = null;
          }
            
        ?>
        <img style="display: none;" src="notblur.jpg">
        <div class="container">
    <div class="row">
  <div class="col-md-4"></div>
  <div style=" position: absolute;

  top: 30%;
  left: 32%;background-color: white;border-radius: 10px;" class="col-md-4">  
<center>  <a href="../index.php"><img style="height: 25%;width: 25%;border-radius: 40%;margin-top: -10%;margin-bottom: 10px;  " src="logo.jpg"></a>
 <div class="w3-container w3-lobster">
  <p class="w3-xxlarge">Sign in to Pinstagram!</p>
</div>
</center>
  <form  style="padding-top: 0px;
    padding-right: 12px;
    padding-bottom: 20px;
    padding-left: 12px;" action="login_back.php" method="post">
            <div class="form-group">
              <input style="border-radius: 20px" type="email" class="form-control" name="email" placeholder="Email address" required>
            </div>
            <div class="form-group">
              <input style="border-radius: 20px" type="password" class="form-control" name="pwd" placeholder="Password" required>
            </div>
            
            <button type="submit" class="btn btn-default" style="border-color: #8134AF;border-radius: 10px;" name="submit"><div class="w3-lobster">
  <b style="font-size: 18px">Sign In !</b>
</div></button> <p class="pull-right" style="padding: 6px 12px;">Or <a href="../signup/signup.php">Create an account</a></p>
          </form>
          </div>
          <div class="col-md-4"></div>
        </div>
    </div>
    <script  src="bgjs/index.js"></script>

  </body>
</html>