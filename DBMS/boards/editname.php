<?php
include '../connection/conn.php';
session_start();
$bid=$_POST["bid"];
$bname=$_POST["Name"];
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$sql = "UPDATE Board SET BoardName='$bname' WHERE BoardId='$bid'";
	if ($conn->query($sql) === TRUE) 
	{
		header('location: editboard.php?bid='.$bid);

	}
}

?>