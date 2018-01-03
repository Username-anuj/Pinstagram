<?php
include '../connection/conn.php';
session_start();

$userid = $_SESSION['myid'];
$boardid=$_POST['ID'];
$pid=$_POST['pid'];

echo 'Hi'.$boardid.$pid;

// $sql="INSERT INTO FollowBoard (BoardId, PinId) VALUES ($boardid, $pid)";
// $run=$conn->query($sql);

$sql = "SELECT NumPin FROM Board WHERE BoardId='$boardid'";
$result = $conn->query($sql);
// echo $sql;
while($row = $result->fetch_assoc()) 
{
	$no=$row["NumPin"];
	$no=$no+1;
	$sql = "UPDATE Board SET NumPin='$no' WHERE BoardId='$bid'";
	$res=$conn->query($sql);

}
$sql="SELECT * FROM Pin WHERE PinId='$pid'";
$result=$conn->query($sql);

while($row=$result->fetch_assoc())
{
	$pic=$row["Pic"];
}

$sql="SELECT * FROM BoardPins";
$result = $conn->query($sql);
$tf=$result->num_rows+1;
$target_dir = "uploads/";
$target_file = $target_dir.$pic;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$targ=$target_dir.$tf;
echo $targ;
if ($uploadOk == 1) 
{
	if (copy('../pinupload/'.$pic, '../boards/'.$targ)) 
	{
		// echo "Hi";
		
		$sql = "INSERT INTO BoardPins (Pic) 
		VALUES ('$targ')";

		$run=$conn->query($sql);
		$sql = "SELECT PinId FROM BoardPins WHERE Pic='$targ'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$pinid=$row["PinId"];
			}
		} 

		$sql="INSERT INTO FollowBoard (BoardId, PinId) VALUES ($boardid, $pinid)";
		// $run=$conn->query($sql);


		if ($conn->query($sql) === TRUE) 
		{
			echo "Hi<br>";
			 header('location: viewpin.php?pid='.$pid);
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}
	else
	{
		echo "error";
	}
}

?>