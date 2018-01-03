<?php
include '../connection/conn.php';
session_start();
$userid=$_SESSION['myid'];
$sql="SELECT * from User where UserId='$userid'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$website=$row["Website"];
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="js/modernizr.custom.js"></script>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title>Render</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="js/modernizr.custom.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/comp.css" />
</head>
<body style="background: white;">
	<?php include '../navbar.php';
	if ($_SESSION['message']!=null) {
		echo "<div class=\"error-message\">";
		echo $_SESSION['message'];
		echo " </div>";
		$_SESSION['message'] = null;
	}?>
	<div class="container">
		<ul class="grid effect-6" id="grid" >



			<?php



			
			
			$sql="SELECT * from SponsorPins where UserId='$userid'";
			$result=$conn->query($sql);
			if ($result->num_rows>0)
			{
				while($row=$result->fetch_assoc())
				{
					$Pid=$row["PinId"];
					$Pic=$row["Pic"];
					$Title=$row["Name"];
					$Description=$row["Description"];
					$NumVisits=$row["NumVisits"];
					$Status=$row["Status"];
					$Seen=$row["Seen"];

					?>
					<li>
						<a href="http://<?php echo $website?>">
							<div class="well" style="color:black">
								<center>
									<img src="<?php echo "../pinupload/".$Pic?>" style="width:20em"><br>
										<!-- <br>
										<br>-->
										<b><?php echo $Title?></b><br><?php echo $Description?> <br> 
										<i> Number of visits: <?php echo $NumVisits?> </i> <br>

										<?php 
										if($Status==0)
											{ ?>
										<i class="fa fa-times fa" aria-hidden="true" style="color:red; float: left; font-size: 20px;"></i>
										<?php
									}
									else
									{
										?>
										<i class="fa fa-check-circle-o" aria-hidden="true" style="color:green; float: left; font-size: 20px;"></i>

										<?php 
									}
									?>
									<?php 
									if($Seen==1)
										{ ?>
									<a href="seen.php?seen=<?php echo $Seen?>&pid=<?php echo $Pid?>" style="color:black;"><i class="fa fa-eye fa-2x" aria-hidden="true" style=" float: right; font-size: 20px;"></i></a>
									<?php
								}
								else
								{
									?>
									<a href="seen.php?seen=<?php echo $Seen?>&pid=<?php echo $Pid?>" style="color:black;"><i class="fa fa-eye-slash fa-2x" aria-hidden="true" style=" float: right; font-size: 20px;"></i></a>
									<br>

									<?php 
								}

								

								?>

							</center>
						</div>
					</a>
				</li>
				<?php
			}
		}
		?>
	</ul>
</div>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/classie.js"></script>
<script src="js/AnimOnScroll.js"></script>
<script>
	new AnimOnScroll( document.getElementById( 'grid' ), {
		minDuration : 0.4,
		maxDuration : 0.7,
		viewportFactor : 0.2
	} );
</script>
</body>
</html>