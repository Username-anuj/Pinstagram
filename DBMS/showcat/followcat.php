<?php
	include '../connection/conn.php';
	session_start();
	$userid = $_SESSION['myid'];
	$cid = $_GET['cid'];
	$n=$_GET['n'];
	echo $cid;
	echo $n;
		if($n==1)
		{

			 echo "hi";
			$sql = "INSERT INTO FollowCat (CatId, UserId) VALUES ('$cid','$userid')";

			if ($conn->query($sql) === TRUE) 
			{
				header('location: catpage.php?cid='.$cid);

			}
		}
		else
		{

			$sql = "DELETE FROM FollowCat WHERE CatId=$cid AND UserId=$userid";
			echo $sql;
			print_r($conn->query($sql));
			if ($conn->query($sql) === TRUE) 
			{
				echo "hi";
				header('location:  catpage.php?cid='.$cid);

			} 
			else
			{
				echo "Error";
			}
		}
?>