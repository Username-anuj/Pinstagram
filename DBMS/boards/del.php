<?php
include '../connection/conn.php';
session_start();
$pin=$_GET[pid];
$bid=$_GET[bid];
$sql = "DELETE FROM FollowBoard WHERE PinId='$pin'";

if ($conn->query($sql) === TRUE) 
{
	$sql1 = "DELETE FROM BoardPins WHERE PinId='$pin'";

	if ($conn->query($sql1) === TRUE) 
	{
		$sql2 = "SELECT NumPin FROM Board WHERE BoardId='$bid'";
		$result = $conn->query($sql2);
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$no=$row["NumPin"];
				$no=$no-1;
				$sql = "UPDATE Board SET NumPin='$no' WHERE BoardId='$bid'";
				if ($conn->query($sql) === TRUE) 
				{
					header('location: editboard.php?bid='.$bid);
					
				}
			}
		}


	}
}

?>

