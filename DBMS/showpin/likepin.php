<?php
include '../connection/conn.php';
session_start();
$userid = $_SESSION['myid'];
$n=$_GET['n'];
$pid=$_GET['pid'];
if($n==1)
{
	$sql = "INSERT INTO LikePin (PinId, UserId) VALUES ('$pid','$userid')";
	$result=$conn->query($sql);
	$sql="SELECT * from Pin where PinId='$pid'";
	$result=$conn->query($sql);
	if ($result->num_rows>0)
	{
		while($row=$result->fetch_assoc())
		{
			$no=$row["Likes"];
			$sc=$row["Score"];
		}
	}
	$no=$no+1;
	$sc=$sc+1;
	$sql = "UPDATE Pin SET Likes='$no', Score='$sc' WHERE PinId='$pid'";
	$result=$conn->query($sql);
}
else
{

	$sql = "DELETE FROM LikePin WHERE UserId=$userid AND PinId=$pid";
	$result=$conn->query($sql);
	$sql="SELECT * from Pin where PinId='$pid'";
	$result=$conn->query($sql);
	if ($result->num_rows>0)
	{
		while($row=$result->fetch_assoc())
		{
			$no=$row["Likes"];
			$sc=$row["Score"];
		}
	}
	$no=$no-1;
	$sc=$sc-1;
	$sql = "UPDATE Pin SET Likes='$no', Score='$sc' WHERE PinId='$pid'";
	$result=$conn->query($sql);
}

$sql="SELECT * FROM LikePin WHERE UserId='$userid'";
$result=$conn->query($sql);
$no=$result->num_rows;

$sql = "UPDATE User SET NumLikedPins='$no' WHERE UserId='$userid'";
$result=$conn->query($sql);
header('location: viewpin.php?pid='.$pid);
?>