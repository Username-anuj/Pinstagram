<?php
include '../connection/conn.php';
session_start();
$pid=$_GET['pid'];
$uid=$_SESSION['myid'];
$sql="SELECT * FROM Pin WHERE PinId='$pid'";
$result=$conn->query($sql);
$des=$_GET["desc"];

while($row=$result->fetch_assoc())
{
	$pic=$row["Pic"];
	$name=$row["Name"];
	// $pic=$row["Pic"];
	// $like=$row["Likes"];
	$cid=$row["CatId"];
	$no=$row["NumReport"];
	$stat=$row["Status"];
	$share=$row["Share"];

}
$sql="SELECT * FROM Pin";
$result = $conn->query($sql);
$tf=$result->num_rows+1;
$target_dir = "uploads/";
$target_file = $target_dir.$pic;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$targ=$target_dir.$tf.".".$imageFileType;
echo $targ;
if ($uploadOk == 1) 
{
	if (copy('../pinupload/'.$pic, '../pinupload/'.$targ)) 
	{
		// echo "Hi";
		$sql = "SELECT * FROM Categories WHERE CatId='$cid'";
		// print_r($sql);
		$result = $conn->query($sql);
		// print_r($result);
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$cat=$row["CatName"];
			}
		}
		echo $cat;

		$sql = "INSERT INTO Pin (Pic,Name,Description,Likes,UserId,CatId,Share, NumReport, Status) 
		VALUES ('$targ','$name','$des',0,'$uid','$cid','$share','$no','$stat')";

		$run=$conn->query($sql);
		$sql = "SELECT PinId FROM Pin WHERE Pic='$targ'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$pinid=$row["PinId"];
			}
		} 
		$sql="SELECT * from Pin where PinId='$pid'";
		$result=$conn->query($sql);
		if ($result->num_rows>0)
		{
			while($row=$result->fetch_assoc())
			{
				$no=$row["Share"];
				$sc=$row["Score"];
			}	
		}
		$no=$no+1;
		$sc=$sc+10;
		$sql = "UPDATE Pin SET Share='$no', Score='$sc' WHERE PinId='$pid'";
		$result=$conn->query($sql); 
		$sql = "INSERT INTO $cat (PinId) 
		VALUES ('$pinid')";

		if ($conn->query($sql) === TRUE) 
		{
			header('location: viewpin.php?pid='.$pid);
		} 

// $sql = "INSERT INTO Pin (Pic, Name, Description, Likes, UserId, CatId, Share, NumReport, Status) VALUES ('$pic','$name','des','$like','$uid','$cid','$share','$no','$stat')";
// 	if ($conn->query($sql) === TRUE) 
// 	{
// 		header('location: viewpin.php?pid='.$pid);
// 	}
// 	else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

	}
	else
	{
		echo "There was an error";
	}

}


?>