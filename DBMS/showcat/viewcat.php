<?php
include '../connection/conn.php';
session_start();
$Pid=[];
$Cat=[];
$time=[];
?>
<html lang="en">
<head>
	<title>Bootstrap </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/modernizr.custom.js"></script>
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<base target="_parent">
</head>
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
    .centered-and-cropped{
      object-fit: cover;
    }
    a:hover{
      text-decoration: none;
    }
    img{
    	border-radius: 20px;
    	/*vertical-align: center;*/
    }
</style>
<body style="background: white;">

	<br>
	<div class="container">
		<ul class="grid effect-6" id="grid">


			<?php
			$userid = $_SESSION['myid'];
			$i=0;
			$chk=0;
			$cid=$_GET["cid"];
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
						<center>
							<a href="../showpin/viewpin.php?pid=<?php echo $Pid[$l]?>">
								<div class="well"> 
								<br>
								<img src="<?php echo "../pinupload/".$Pic?>" style="width:20em;"><br>
									<center>
										<b><?php echo $Title?></b><br><?php echo $Description?> 
									</center>
									<br>
								</div>
							</a>
							</center>
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