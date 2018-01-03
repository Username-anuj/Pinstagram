<?php
include '../connection/conn.php';
session_start();

$pid=$_GET['pid'];
$owner=$_GET['userid'];
echo $pid;
echo $owner;
$sql_website="SELECT * from User where UserId='$owner'";
$result_website=$conn->query($sql_website);
$row_website=$result_website->fetch_assoc();
$website=$row_website["Website"];
echo $website;
$sql="SELECT * FROM SponsorPins WHERE PinId='$pid'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$NumVisits=$row['NumVisits'];
echo $NumVisits;
$NumVisits++;

$sql="UPDATE SponsorPins SET NumVisits='$NumVisits' WHERE PinId='$pid'";

if ($conn->query($sql) === TRUE) 
{
	header('location:http://'.$website);
}


?>