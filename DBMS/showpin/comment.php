<?php
include '../connection/conn.php';
session_start();
$uid=$_SESSION['myid'];
$pid=$_POST["pid"];
$cont=$_POST["content"];

$sql = "INSERT INTO Comments (UserId,PinId,Content) VALUES ('$uid','$pid','$cont')";

if ($conn->query($sql) === TRUE) 
{
	echo "New record created successfully<br>";
	header('location: viewpin.php?pid='.$pid);

}
else
{
echo "Error: " . $sql . "<br>" . $conn->error;
}

?>