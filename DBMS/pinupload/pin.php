<?php
include '../connection/conn.php';
session_start();
$userid=$_SESSION['myid'];
$sql="SELECT * FROM User WHERE UserID='$userid'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
if($row["Type"]==2)
{
	$n=1;
}
else
{
	$n=0;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload Pin  </title>
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
	<?php //include '../navbar.php'; 
	if ($_SESSION['message']!=null) {
	echo "<div class=\"error-message\">";
	echo $_SESSION['message'];
	echo " </div>";
	$_SESSION['message'] = null;
	}?>

	<!-- <div id="main">
		<div id="form"> -->
			<img style="display: none;" src="../login/notblur.jpg">
		<div class="container">
    <div class="row" style="">
  <div class="col-md-4"></div>
  <div style=" position: absolute;

  top: 10%;
  left: 32%;background-color: white;border-radius: 10px;" class="col-md-4">  
<center>  <a id = "hehe" href="../render/render.php"><img style="height: 25%;width: 25%;border-radius: 50%;margin-top: -10%;margin-bottom: 10px;  " src="../login/logo.jpg"></a>
 <div class="w3-container w3-lobster">
  <p class="w3-xxlarge">Upload Pin!</p>
</div>
</center>	
			<form  style="padding-top: 0px;
    padding-right: 12px;
    padding-bottom: 20px;
    padding-left: 12px;" action="uploadpin.php" method="post" enctype="multipart/form-data">
				Name your pin:
				<br>
				<div id="nm" class="form-group">
					<input type="text" class="form-control" name="Pinnm">
				</div> 
				<br>
				Select image to upload:
				<br>
				<div id="filediv" class="form-group">
					<input type="file" class="" name="file" id="file">
				</div>
				<br>
				Description
				<div id="Description" class="form-group">
					<input type="textarea" class="form-control" name="desc">
				</div>
				<br>
				<?php 
				if($n==0)
				{
					?>
					<div id="cat" class="form-group">
						<select name="categories" class="form-control">
							<option value="Art">Art</option>
							<option value="CarsAndMotorcycles">CarsAndMotorcycles</option>
							<option value="Celebrities">Celebrities</option>
							<option value="Education">Education</option>
							<option value="FoodDrink">FoodDrink</option>
							<option value="Humour">Humour</option>
							<option value="Outdoors">Outdoors</option>
							<option value="Photography">Photography</option>
							<option value="Quotes">Quotes</option>
							<option value="Sports">Sports</option>
							<option value="Tech">Tech</option>
							<option value="Travel">Travel</option>	
						</select>
					</div>

					<br>
					Can Buy?<br>
					<label class="radio-inline"><input type="radio" name="CanBuy" value="1" onclick="document.getElementById('ifYes').style.display = 'block';" id="yesCheck" > Yes<br></label>
					<label class="radio-inline"><input type="radio" name="CanBuy" value="0" onclick="document.getElementById('ifYes').style.display = 'none';" id="noCheck"> No<br></label>
					<br>
					<div id="ifYes" class="form-group" style="display:none">
						Stock<br>
						<input type="number" name="Stock" min="1" id="stock"><br>
						Price<br>
						<input type="number" name="Price" min="1" id="price"><br> 
					</div>
					<div class="form-group">
					Can others download?<br>
					<label class="radio-inline"><input type="radio" name="download" value="1"> Yes<br></label>
					<label class="radio-inline"><input type="radio" name="download" value="0"> No<br></label>
					</div>
					<?php 
				} 
				?>

				<!-- <input type="submit" value="Add" name="submit"> -->
				<button type="submit" class="btn btn-default" style="border-color: #8134AF;border-radius: 10px;" name="submit">
  <b style="font-size: 18px">Add</b>
			</button> 
				<br>
			</form>
			 </div>

          <div class="col-md-4"></div>

        </div>
    </div>
		<!-- </div>
	</div> -->
<script  src="../login/bgjs/index.js"></script>
</body>
</html>

