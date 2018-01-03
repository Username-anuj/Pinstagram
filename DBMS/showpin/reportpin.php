<?php
include '../connection/conn.php';
session_start();
$pid=$_GET['pid'];
$uid=$_SESSION['myid'];
$sql="SELECT * FROM Pin WHERE PinId='$pid'";
$result=$conn->query($sql);
while($row=$result->fetch_assoc())
{
	$no=$row["NumReport"];
}
$no=$no+1;
$sql = "UPDATE Pin SET NumReport='$no' WHERE PinId='$pid'";

if ($conn->query($sql) === TRUE) 
{
	header('location: viewpin.php?pid='.$pid);
}
?>