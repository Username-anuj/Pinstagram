<?php
include '../connection/conn.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> Pins Page </title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="scpt.js"></script>
</head>
<body>
	<center>
		<div id="main">
			<div id="form">
				<form action="uploadpin.php" method="post" enctype="multipart/form-data">
					Name your pin:
					<br>
					<div id="nm">
						<input type="text" name="Pinnm">
					</div>
					<br>
					Select image to upload:
					<br>
					<div id="filediv">
						<input type="file" name="file" id="file">
					</div>
					<br>
					<div id="Description">
						<input type="textarea" name="desc">
					</div>
					<br>
					<div id="cat">
						<select name="categories">
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
					<input type="submit" value="Add" name="submit">
					<br>
				</form>
			</div>
		</div>
	</center>
</body>
</html>

