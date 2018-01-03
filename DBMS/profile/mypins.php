<?php
	include '../connection/conn.php';
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Pins</title>
</head>
<body>
<strong>These are my pins:</strong>
<i>
<?php
	$pin_query = "SELECT * from Pin where UserId = '".$_SESSION['myid']."'";
	$result_pin_query = $conn->query($pin_query);
	// print_r($result);
?>
<ol>
<?php
	while($row_pin_query = $result_pin_query->fetch_assoc())
	{
?>
			<li>
				<?php echo "Name: ".$row_pin_query['Name'];?>
				<br>
				<?php echo "Description: ".$row_pin_query['Description'];?>
				<br>
				<?php 
					$cat_query = "SELECT * FROM Categories where CatId = '".$row_pin_query['CatId']."' ";
					$result_cat_query = $conn->query($cat_query);
					$row_cat_query = $result_cat_query->fetch_assoc();
					echo "Category: ".$row_cat_query['CatName'];
				?>
				<br>
				Image:<br> 
				<img src="../pinupload/<?php echo $row_pin_query['Pic']?>">
				<br>
				<?php echo "Likes: ".$row_pin_query['Likes'];?><br>
				<?php echo "Shares: ".$row_pin_query['Share'];?>

				<br><br><br>
			</li>
<?php
	}
?>
</ol>
</i>
</body>
</html>