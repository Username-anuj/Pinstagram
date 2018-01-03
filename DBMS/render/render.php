<?php
include '../connection/conn.php';
session_start();
$Pid=[];
$Cat=[];
$time=[];
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
	<link rel="stylesheet" type="text/css" href="css/sponsor.css"/>
	 <style type="text/css">
      .well{
        border-color: white;
        background: white;
        border-radius: 20px;
        color: black;
      }
      .well:hover{
        background: #e3e3e3;
        border-radius: 20px;
        color: black;
      }
      img{
        border-radius: 20px;
      }
      a:hover{
      	text-decoration: none;
      }
    </style>
    <link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>


</head>

<body style="background: white;color: black;font-family: Garamond;">
 <?php include '../navbar.php'; ?>
<?php
	$sql="SELECT * from SponsorPins where Status=1 AND Seen=1";
	$result=$conn->query($sql);
	if ($result->num_rows>0)
		{?>
<iframe style="padding: 0px; margin: 0px;" src="try2.php" width="100%" height="260px" scrolling="no"></iframe>
<?php } ?>

	<div class="container">
		<ul class="grid effect-6" id="grid" >

			<?php
			$userid = $_SESSION['myid'];
			$i=0;
			$chk=0;
			$sql="SELECT * from Pin where Score=(SELECT Max(Score) AS MAX_SCORE FROM Pin HAVING MAX_SCORE>0)";
			$result=$conn->query($sql);
			while($row=$result->fetch_assoc())
			{

				$Pidom=$row["PinId"];
				$Pic=$row["Pic"];
				$Title=$row["Name"];
				$Description=$row["Description"];
				?>
				<li>
					<a href="../showpin/viewpin.php?pid=<?php echo $Pidom?>">
						<div class="well">
							<center><b> <h2  style="font: 400 30px/1.3 'Berkshire Swash', Helvetica, sans-serif;"><i style="transform: rotate3d(0,0,1,-30deg); font-size: 20px;" class="fa fa-star" aria-hidden="true"></i><i style="transform: translateY(-3px); font-size: 20px;" class="fa fa-star" aria-hidden="true"></i> Pic Of Month <i style="transform: translateY(-3px);font-size: 20px;" class="fa fa-star" aria-hidden="true"></i><i style="transform: rotate3d(0,0,1,30deg);font-size: 20px;" class="fa fa-star" aria-hidden="true"></i></h2> </b> <br>
								<img src="<?php echo "../pinupload/".$Pic?>" style="width:20em;"><br>
								<b><?php echo $Title?></b><br><?php echo $Description?>
							</center>
						</div>
					</a>
				</li>



				<?php
			}



			$sql1="SELECT * from FollowCat where UserId ='$userid'";
			$result1=$conn->query($sql1);
			while($row1=$result1->fetch_assoc())
			{
				$cid=$row1["CatId"];
				$sql2="SELECT CatName from Categories where CatId='$cid'";
				$result2=$conn->query($sql2);
				if ($result2->num_rows>0)
				{
					while($row2=$result2->fetch_assoc())
					{
						$Cname= $row2["CatName"];
						$sql3="SELECT * from $Cname";
						$result3=$conn->query($sql3);
						$result3=$conn->query($sql3);
						if ($result3->num_rows>0)
						{
							while($row3=$result3->fetch_assoc())
							{
								$Pid[$i]=$row3["PinId"];
								$Cat[$i]=$Cname;
								$time[$i]=0;
								$i=$i+1;
							}
						}
					}
				}
			}
			$sql_follow_user="SELECT * from FollowUser where UserId1=$userid";
			$result_follow_user=$conn->query($sql_follow_user);
			if($result_follow_user>0)
			{
				while($row_follow_user=$result_follow_user->fetch_assoc())
				{
					$uid=$row_follow_user["UserId2"];
					$sql_pin="SELECT * FROM Pin WHERE UserId=$uid";
					$result_pin=$conn->query($sql_pin);
					if($result_pin->num_rows>0)
					{
						while($row_pin=$result_pin->fetch_assoc()) 
						{
							$Pid[$i]=$row_pin["PinId"];
							$time[$i]=0;
							$i=$i+1;

						}

					}
				}
			}
			for($j=0;$j<$i;$j++)
			{
				do
				{
					$chk=0;
					$l=rand()%$i;
					if($time[$l]==0)
					{
						$time[$l]=$time[$l]+1;
					}
					else
					{
						$chk=1;
					}

				}while($chk==1);
				$sql4="SELECT * from Pin where PinId='$Pid[$l]'";
				$result4=$conn->query($sql4);
				if ($result4->num_rows>0)
				{
					while($row=$result4->fetch_assoc())
					{
						$Pic=$row["Pic"];
						$Title=$row["Name"];
						$Description=$row["Description"];
						?>
						<li>
							<a href="../showpin/viewpin.php?pid=<?php echo $Pid[$l]?>">
								<div class="well" style="color:black">
									<center>
										<img src="<?php echo "../pinupload/".$Pic?>" style="width:20em"><br>
										<!-- <br>
										<br>-->
										<b><?php echo $Title?></b><br><?php echo $Description?>
									</center>
								</div>
							</a>
						</li>
						<?php
					}
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