<?php
include '../connection/conn.php';
session_start();
include '../navbar.php';
$cid=$_GET['cid'];
// echo $cid;
$userid=$_SESSION["myid"];
$sql="SELECT * FROM FollowCat WHERE CatId='$cid'";
$result = $conn->query($sql);
$numFollow=$result->num_rows;
$n=1;
if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		$uid=$row["UserId"];
		if($uid==$userid) 
		{
			$n=0;
		}
	}
} 
$Pid=[];
$Cat=[];
$time=[];
$i=0;
$chk=0;
$sql2="SELECT CatName from Categories where CatId='$cid'";
$result2=$conn->query($sql2);
if ($result2->num_rows>0)
{
	while($row2=$result2->fetch_assoc())
	{

		$Cname= $row2["CatName"];
		$sql3="SELECT * from $Cname";
		$result3=$conn->query($sql3);
		$numPins=$result3->num_rows;
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
?>
<html lang="en">
<head>
	<title>Bootstrap </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="js/modernizr.custom.js"></script>
	<style type="text/css">
		 #follow-button {
      color: #b30000;
      font-family: "Helvetica";
      font-size: 10pt;
      background-color:transparent;
      border: 1px solid;
      border-color: #b30000;
      border-radius: 3px;
      width: 150px;
      height: 40px;
      position: absolute;
      top: 5px;
     /* right: -800px;*/
    }
    #unfollow-button{
      color: #b30000;
      font-family: "Helvetica";
      font-size: 10pt;
      background-color: transparent;
      border: 1px solid;
      border-color: #b30000;
      border-radius: 3px;
      width: 150px;
      height: 40px;
      position: absolute;  
      top: 5px;
      /*right: -800px;*/
    }
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
	<script src="js/modernizr.custom.js"></script>
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
</head>
<body style="background: white; color: black; font-family: Garamond;">
	<?php //nclude '../navbar.php'; ?>


	<br>


	<div class="container-fluid" style="padding:0px; margin: 0px; position: absolute; top:52px; width: 100%">

		<div class="row"  style="<?php if($cid==9){echo "height: 420px;";} else { echo "height: 290px;"; }?>">

		<img src="c3/<?php echo $cid?>.jpg" class="centered-and-cropped" style="<?php if($cid==9){echo "height: 370px;";} else {echo "height: 230px;"; }?> width:100%; border-radius: 0px; z-index: -2;"> 
      <div class="col-xs-7">
        <div class="pull-left">
          <h1 style="position: absolute; left: 350px; top:-100; font: 400 50px/1.3 'Berkshire Swash', Helvetica, sans-serif; <?php if($cid==9){ echo "color: black;";}else{echo "color: white;";} ?>width: 100%"> <strong> <?php
          // echo $cid;
						if($cid==1)
						{
							echo "Art";
						}
						else if($cid==2)
						{
							echo "Cars And Motorcycles";
						}
						else if($cid==3)
						{
							echo "Celebrities";
						}
						else if($cid==4)
						{
							echo "Education";
						}
						else if($cid==5)
						{
							echo "  Food And Drink";
						}
						else if($cid==6)
						{
							echo " Humour";
						}
						else if($cid==8)
						{
							echo " Photography";
						}
						else if($cid==9)
						{
							echo " Quotes";
						}
						else if($cid==7)
						{
							echo "Outdoors";
						}
						else if($cid==10)
						{
							echo " Sports";
						}
						else if($cid==11)
						{
							echo " Tech";
						}
						else if($cid==12)
						{
							echo " Travel";
						}

						?></strong></h1>
						<h4 style="color: black; position: absolute; left: 350px; top:0px;"> 
						<?php echo $numPins." Pins"; ?> &middot; <?php echo $numFollow." Followers"; ?>
						</h4>

					</div>
					<div class="pull-right">
						<?php
						if($n===1)
						{
							?>
							
							<button id="follow-button"> <h4 style="padding:0px; margin:0px; font-family: Garamond;"> <a href="followcat.php?n=<?php echo $n?>&cid=<?php echo $cid?>" style="color:#b30000; font-family: Garamond;"> <strong>+ Follow</strong> </a> </h4></button>


							<?php
						}
						else if($n===0)
						{
							?>
							<button id="unfollow-button"> <h4 style="padding:0px; margin:0px;"> <a href="followcat.php?n=<?php echo $n?>&cid=<?php echo $cid?>" style="color: #b30000; font-family: Garamond;"> <strong>&#x2714; Following</strong> </a> </h4></button>
							<?php
						}?>

					</div>


				</div>
				<div style="position: absolute;<?php if($cid==9){echo "top: 240;";} else {echo " top: 100px;"; }?> left: 100px; height: 200px;">
        <img style="height: 220px;width: 220px;border-radius: 50%;" class="centered-and-cropped" src="dp/<?php echo $cid;?>.jpg">

      </div>

			</div>

			<div class="container">

				<ul class="grid effect-6" id="grid">


					<?php
					
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
						//echo "../pinupload/".$Pic;
								$Title=$row["Name"];
								$Description=$row["Description"];
								?>
								<li>
								<center>
									<a href="../showpin/viewpin.php?pid=<?php echo $Pid[$l]?>">
										<div class="well"> 
											<img src="<?php echo "../pinupload/".$Pic?>" style="width:20em"><br>
											<center><br>
												<br>
												<b><?php echo $Title?></b><br><?php echo $Description?> 
											</center>
										</div>
									</a></center> </li>
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
			</div>
		</body>
		</html>