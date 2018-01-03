<?php
	include '../connection/conn.php';
	session_start();
	$userid1 = $_SESSION['myid'];
	$userid2 = $_GET['uid'];
	$n=$_GET['follow'];
	$pid=$_GET['pid'];
	echo $userid1;
	echo $userid2;
		if($n==1)
		{
			echo "hi";
			$sql = "INSERT INTO FollowUser (UserId1,UserId2)VALUES($userid1,$userid2)";

			if ($conn->query($sql) === TRUE) 
			{
				header('location: viewpin.php?pid='.$pid);

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
				header('location: viewpin.php?pid='.$pid);

			} 
		}
?>