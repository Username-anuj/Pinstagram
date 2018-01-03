<?php
include '../connection/conn.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title> Boards Page </title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="sc.js"></script>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../login/bgcss/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<script src="scpt.js"></script>
<style>
.w3-lobster {
    font-family: "Lobster", serif;
}
</style>

    <style>
   /* html, body{
    	overflow: hidden;

    }*/
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
  <?php //include '../navbar.php'; ?>

<center>
<div id="main">
<div id="form">
<img style="display: none;" src="../login/notblur.jpg">
		<div class="container">
    <div class="row" style="">
  <div class="col-md-4"></div>
  <div style=" position: absolute;

  top: 10%;
  left: 32%;background-color: white;border-radius: 10px;" class="col-md-4">  
<center>  <a id = "hehe" href="../render/render.php"><img style="height: 25%;width: 25%;border-radius: 50%;margin-top: -10%;margin-bottom: 10px;  " src="../login/logo.jpg"></a>
 <div class="w3-container w3-lobster">
  <p class="w3-xxlarge">Create Board!</p>
</div>
</center>
				<form  style="padding-top: 0px;
    padding-right: 12px;
    padding-bottom: 20px;
    padding-left: 12px;" action="upload.php" method="post" enctype="multipart/form-data">
Name your board:
<br>
<div id="nm" class="form-group">
<input type="text" name="Boardnm" class="form-control">
</div>
<br>
Select image to upload:
<br>
<div id="filediv">
<input type="file" name="file[]" id="file">
</div>
<br>
<input type="button" id="add_more" class="upload" style="background-image: url('rsz_iconplus.png'); width:70px; height:70px; background-repeat: no-repeat;
background-position: 50% 50%; border-radius: 100px;" ><br>
<button type="submit" class="btn btn-default pull-right" style="border-color: #8134AF;border-radius: 10px;" name="submit"><div class="w3-lobster">
  <b style="font-size: 18px">Add !</b>
</div></button> <br>
</form>
</div>
</div>
</center>
		<script  src="../login/bgjs/index.js"></script>

</body>
</html>
