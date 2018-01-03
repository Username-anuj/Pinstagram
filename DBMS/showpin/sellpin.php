<?php
include '../connection/conn.php';
session_start();
$pid=$_GET['pid'];
$uid = $_GET['uid'];
$approve = $_GET['approve'];
if($approve=='true')
{
$inc_count = "UPDATE BuyPin SET Status=1 WHERE PinId='$pid' and UserId='$uid'";
$conn->query($inc_count);
}
if($approve=='false')
{
	$del_transact = "DELETE FROM BuyPin where PinId='$pid' and UserId='$uid'";
	$conn->query($del_transact);	
}
	header('location: viewpin.php?pid='.$pid);

?>