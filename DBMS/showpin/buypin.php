<?php
include '../connection/conn.php';
session_start();
$pid=$_GET['pid'];



echo $uid=$_SESSION['myid'];
echo $address = $_POST['address'];
echo $qty = $_POST['quantity'];
$sql="SELECT * FROM Pin WHERE PinId='$pid'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

// echo $row;
// echo $row["Stock"];
if($row["Stock"]-$qty>-1)
{
	$bought = "INSERT INTO BuyPin (PinId, UserId, Quantity) VALUES ('$pid','$uid','$qty')";
	$result_bought=$conn->query($bought);


	$no=$row["Stock"];
	// echo $no;
	$no=$no-$qty;
	// echo $no;
	$inc_count = "UPDATE Pin SET Stock='$no' WHERE PinId='$pid'";
	$conn->query($inc_count);
	$set_new_address = "UPDATE User SET Address='$address' WHERE UserId='$uid'";
	if($conn->query($set_new_address))
	{
		$_SESSION['address']=$address;
	}
header("refresh:2;url=viewpin.php?pid=$pid");}
else 
{
	echo "Stock not available. Redirecting you to the pin. Please wait ...";
	// sleep(2);
	// header('location: viewpin.php?pid='.$pid);
	 header("refresh:2;url=viewpin.php?pid=$pid");
}
?>