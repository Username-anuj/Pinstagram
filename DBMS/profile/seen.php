<?php
include '../connection/conn.php';
session_start();
echo "hi";
$userid=$_SESSION['myid'];
$seen=$_GET['seen'];
$pid=$_GET['pid'];
echo $seen;
echo $pid;
if($seen==1)
{
	$sql="UPDATE SponsorPins SET Seen=0 WHERE PinId='$pid'";
	if ($conn->query($sql) === TRUE) {
		header('location: businesspro.php');
	}
} 
else
{
	$sql="SELECT * FROM SponsorPins WHERE UserId='$userid' AND Seen=1";
	$result = $conn->query($sql);
	if($result->num_rows>5)
	{
		$_SESSION['message']="You have exceeded your limit of the number of Ads.";
		header('location: businesspro.php');
	}
	else
	{
		$sql="UPDATE SponsorPins SET Seen=1 WHERE PinId='$pid'";
		if ($conn->query($sql) === TRUE) 
		{
			header('location: businesspro.php');
		}

	}
}
?>