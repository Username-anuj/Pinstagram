<?php
include '../connection/conn.php';
session_start();
$bid=$_GET['bid'];
// $_SESSION['bid']=9;
// $bid=$_SESSION['bid'];

$sql = "SELECT BoardName FROM Board WHERE BoardId='$bid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$bdnm=$row["BoardName"];
$fboard_query = "SELECT * from FollowBoard where BoardId = '$bid'";
		// echo "hello";
		// echo $sql;
$result_fboard_query = $conn->query($fboard_query);
$num=$result_fboard_query->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
	<title> Edit Boards Page </title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="js/modernizr.custom.js"></script>
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
	<style >
		.inputfile {
			width: 0.1px;
			height: 0.1px;
			opacity: 0;
			overflow: hidden;
			position: absolute;
			z-index: -1;
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
		img{
			border-radius: 20px;
		}
		.centered-and-cropped{
			object-fit: cover;
		}
		#follow-button {
			color: #b30000;
			font-family: "Helvetica";
			font-size: 10pt;
			background-color: #ffffff;
			border: 1px solid;
			border-color: #b30000;
			border-radius: 3px;
			width: 150px;
			height: 40px;
			position: absolute;
			top: 100px;
			left: 300px;
			padding: 0px;
			margin: 0px;
		}
	</style>
</head>
<body style="background: white; color: black;font-family: Garamond;">
	<div class="container-fluid">
		<div class="row" style="height: 250px;">
			<div class="col-xs-7">
				<div class="pull-left">
					<h1 style="position: absolute; left: 150px; top: 60px; font: 400 50px/1.3 'Berkshire Swash', Helvetica, sans-serif;"> <strong> <?php echo $row['BoardName'];?> </strong></h1>
					<button id="follow-button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="position:absolute; left: 500px;"> <h2 style="padding:0px; margin:0px; font-family: Garamond; heigth:: 40px;"> <strong>Change</strong> </h2></button>

					<div id="myModal" class="modal fade" role="dialog" >
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header" style="background: #337ab7; color: white;">
									<center><h4 class="modal-title" style="font: 400 35px/1.3 'Berkshire Swash', Helvetica, sans-serif; padding:0px; margin: 0px;"> Change Name </h4></center>
									<button type="button" class="close" data-dismiss="modal" style="position:absolute; right: 5px; color: white">&times;</button>

								</div>
								<div class="modal-body">
									<form action="editname.php" method="POST" enctype="multipart/form-data">
										<strong>Board Name:</strong>
										<input type="text" name="Name" class="form-control" value="<?php echo $bdnm; ?>" required >
										<br>
										<input type="hidden" name="bid" value=<?php echo $bid?>>
										<br>
										<button style="background:#337ab7" class="btn btn-info btn-lg" type="submit" style="position: absolute; left: 700px;"> Change </button>
										<!-- <input type="submit"  name="Change" value="Change"> -->
									</form>
								</div>
								<div class="modal-footer" style="background:#337ab7">


								</div>

							</div>
						</div>
					</div>






					<h5 style=" position: absolute;left:180px; top: 140px; color: #707070"><?php echo $num." Pins"?></h5>
					<div class="plus" style="position: absolute; top: 140px; left: 220px">
			 <form action="add.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="ID" value="<?php echo $bid; ?>">
				<input type="file" name="file" id="file" class="inputfile" onchange="this.form.submit();">
				<label for="file"><img src="rsz_iconplus.png" height="30" width="30"></label>

			</form>
		</div>
				</div>
          <!-- <div class="pull-right" style="margin-top: 20px">
            <a href="editprofile.php"> <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a><br>
            <a href="../login/logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> </a><br>
        </div> -->


    </div>
    <div style="position: absolute; top: 60px; right: 100px; height: 200px;">

    	<img style="height: 220px;width: 220px;border-radius: 50%;" class="centered-and-cropped" src="../images/dp/<?php echo $_SESSION['profile_picture'];?>">

    </div>

</div>



<?php
$fboard_query = "SELECT * from FollowBoard where BoardId = '$bid'";
		// echo "hello";
		// echo $sql;
$result_fboard_query = $conn->query($fboard_query);
?>
<div class="container">
	<ul class="grid effect-6" id="grid">
		<?php
		while($row_fboard_query = $result_fboard_query->fetch_assoc())
		{
					// echo "hi";

			$pin_query="SELECT * FROM BoardPins WHERE PinId = '".$row_fboard_query['PinId']."'";
			$result_pin_query = $conn->query($pin_query);
			while($row_pin_query = $result_pin_query->fetch_assoc())
			{
						// echo "welcome";
				?>
				<li style="opacity:1">
					<div class="well">
						<br>
						<center>
							<img src="<?php echo $row_pin_query['Pic']; ?>">
						</center>
						<!-- <?php echo $row_pin_query['Pic']; ?> -->
						<a href="del.php?pid=<?php echo $row_fboard_query['PinId']; ?>&bid=<?php echo $bid; ?>">  
							<img src="x-30465_960_720.png" height="20" width="20 "></a>
							<br>

						</div>
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

	</div>
</body>
</html>
