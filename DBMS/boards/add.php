<?php
include '../connection/conn.php';
session_start();

$userid = $_SESSION['myid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$bid=$_POST["ID"];
	$target_dir = "uploads/";
	$targ = $target_dir . basename($_FILES["file"]["name"]);
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$filename=($_FILES["file"]["name"]);
	if(isset($_POST["submit"])) 
	{
		$check = getimagesize($_FILES["file"]["tmp_name"][$i]);
		if($check !== false) 
		{
			$uploadOk = 1;
		} else 
		{
			$uploadOk = 0;
		}

	}


	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
	{
			$uploadOk = 0;
	}

	if ($uploadOk == 1) 
	{
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $targ)) {
			$sql = "INSERT INTO BoardPins (Pic) VALUES ('$targ')";
			$run=$conn->query($sql);

			$sql = "SELECT PinId FROM BoardPins WHERE Pic='$targ'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc()) 
				{
					$pid=$row["PinId"];
				}
			} 
			$sql = "INSERT INTO FollowBoard(BoardId,PinId) VALUES ('$bid','$pid')";

			$run=$conn->query($sql);
			
			$sql = "SELECT NumPin FROM Board WHERE BoardId='$bid'";
			$result = $conn->query($sql);

			while($row = $result->fetch_assoc()) 
			{
				$no=$row["NumPin"];
				$no=$no+1;
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