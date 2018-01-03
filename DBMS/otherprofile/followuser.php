<?php
	include '../connection/conn.php';
	session_start();
	$userid1 = $_SESSION['myid'];
	$userid2 = $_SESSION['uid'];
	$n=$_GET['n'];
	echo $userid1;
	echo $userid2;
		if($n==1)
		{
			echo "hi";
			$sql = "INSERT INTO FollowUser (UserId1,UserId2)VALUES($userid1,$userid2)";

			if ($conn->query($sql) === TRUE) 
			{
				header('location: othprofile.php?id='.$userid2);

			}
			else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

		}
		else
		{

			$sql = "DELETE FROM FollowUser WHERE UserId1=$userid1 AND UserId2=$userid2";

			if ($conn->query($sql) === TRUE) 
			{
				header('location: othprofile.php?id='.$userid2);

			} 
		}
?>