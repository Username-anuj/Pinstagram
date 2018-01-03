<?php
include '../connection/conn.php';
session_start();



$pid=$_GET['pid'];;
$sql="SELECT * FROM BoardPins WHERE PinId='$pid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$Pic=$row["Pic"];
$Title=$row["Name"];
$Description=$row["Description"];
$cid=$row["CatId"];
$usid=$row["UserId"];
$sql="SELECT UserId FROM LikePin WHERE PinId='$pid'";
$result = $conn->query($sql);
// print_r($result);
$n=1;
while($row = $result->fetch_assoc()) 
{
	// print_r($row);
	// echo $_SESSION['myid'];
	$uid=$row["UserId"];
	// echo $uid;
	if($uid==$_SESSION['myid']) 
	{
		$n=0;
	}
}

function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
		);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>

<html>
<head>
	<title>Pins</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<style type="text/css">
		#like
		{
			width: 10em;
			cursor: hand;
			font-family: "Helvetica";
			font-size: 10pt;
		}
		#share
		{
			width: 10em;
			cursor: hand;
			font-family: "Helvetica";
			font-size: 10pt;
		}
		#report
		{
			width: 30em;
			cursor: hand;
			font-family: "Helvetica";
			font-size: 5pt;
		}
		#download
		{
			width: 30em;
			cursor: hand;
			font-family: "Helvetica";
			font-size: 5pt;
		}
		#entire
		{
			width: 40em;
		}
	</style>
</head>
<body >



	<center>
		<div class="well" id="entire" >
			<img src="../boards/<?php echo $Pic; ?>" class="img-responsive" style="width: 35em"><br> <br>
			<a href="likepin.php?n=<?php echo $n?>&pid=<?php echo $pid ?>">
				<h2 style="color: black; text-decoration: none;"> <?php echo $Title ?> </h2>
				<h3 style="color: black; text-decoration: none;"> <?php echo $Description ?> </h3>
				<div class="well" id="like">
					<?php 
					if($n==1)
					{
						?>
						<i class="fa fa-heart-o fa-4x" aria-hidden="true" style="color: #ff4d4d
						"></i>
						<?php
					}
					else
					{
						?>
						<i class="fa fa-heart fa-4x" aria-hidden="true" style="color: #ff4d4d
						"></i>
						<?php
					}

					?>



				</div>
			</a>
			<a href="sharepin.php?pid=<?php echo $pid ?>">
				<div class="well" id="share" >
					<i class="fa fa-paper-plane-o fa-4x" aria-hidden="true"></i>
				</div></a>

				<a href="reportpin.php?pid=<?php echo $pid ?>">
					<div class="well" id="report">
						<i class="fa fa-exclamation-circle fa-4x" aria-hidden="true"> Report </i>

					</div> </a>

					<a href="../pinupload/<?php echo $Pic ?>" download> 
						<div class="well" id="download">

							<i class="fa fa-download fa-4x" aria-hidden="true" class="img-responsive"> Download </i>
						</div>  </a>
						<?php 
						$sql1 = "SELECT * FROM User WHERE UserId='$usid'";
						$result1 = $conn->query($sql1);
						$row1=$result1->fetch_assoc();
						$uname=$row1["UserName"];
						$dp=$row1["Dp"];
						?>

						<a href="../otherprofile/othprofile.php?id=<?php echo $usid?>"><div class="well"><span style="float: left;"><img src="../images/dp/<?php echo $dp;?>" width="50" height="50" style="border-radius: 50%"> </span><span>Uploaded by<br> <strong style="font-size:15pt"><?php echo $uname?></span></strong></div></a>

						<h2> Comments </h2>

						
						<?php 
						$sql = "SELECT * FROM Comments WHERE PinId='$pid' ORDER BY CreatedOn";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) 
						{
							while($row = $result->fetch_assoc()) 
							{
								$userid=$row["UserId"];
								$cont=$row["Content"];
								$time=$row["CreatedOn"];
								$sql1 = "SELECT * FROM User WHERE UserId='$userid'";
								$result1 = $conn->query($sql1);
								$row1=$result1->fetch_assoc();
								$uname=$row1["UserName"];
								$dp=$row1["Dp"];
								?>
								<div class="well">
									<a href="../otherprofile/othprofile.php?id=<?php echo $userid?>"><span style="float: left;"><img src="../images/dp/<?php echo $dp;?>" width="50" height="50" style="border-radius: 50%"> </span><span><?php echo $uname?></span> </a><br>
									<span><?php echo $cont?> </span><br>
									<span><?php echo time_elapsed_string($time) ?></span>
								</div>

								<?php
							}
						}
						?>
						<form action="comment.php" method="post" enctype="multipart/form-data">
							<textarea name="content" rows="2" cols="55" >Add your comment here...</textarea>
							<input type="hidden" name="pid" value="<?php echo $pid?>">
							<input type="submit" name="submit" value="Post">
						</form>
					</div>
				</center>
				<h3><center>	MORE LIKE THIS </h3> </center>
				<iframe src="../showcat/viewcat.php?cid=<?php echo $cid?>" height="100%" width="100%"></iframe>
			</body>
			</html>