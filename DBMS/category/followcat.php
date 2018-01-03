<?php
include '../connection/conn.php';
session_start();
// include '../navbar.php';

$userid = $_SESSION['myid'];
if(isset($_POST['submit']))
{
	$userid = $_SESSION['myid'];
	if(!empty($_POST['cat']))
	{
		$checked_count = count($_POST['cat']);
		if($checked_count<5)
		{
			$_SESSION['message']="Please select atleast 5 categories";
			header('location: cat.php');

		}
		else
		{
			$i=1;
			$sql="SELECT * FROM FollowCat WHERE UserId='$userid'";
			$result=$conn->query($sql);
			if($result->num_rows==0)
			{
				$selectcid[1]=0;
			}
			else if ($result->num_rows>0)
			{
				while($row=$result->fetch_assoc())
				{
					$selectcid[$i]=$row["CatId"];
					$i=$i+1;
				}
			}
				foreach($_POST['cat'] as $selected)
				{
					$sql = "SELECT CatId FROM Categories WHERE CatName='$selected'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) 
					{
						while($row = $result->fetch_assoc()) 
						{
							$cid=$row["CatId"];
						}
					}  
					if(array_search($cid, $selectcid)===FALSE)
					{
						$sql1 = "INSERT INTO FollowCat (CatId,UserId) VALUES ('$cid','$userid')";

						if ($conn->query($sql1) === TRUE) 
						{
							echo "New record created successfully<br>";

						}
					} 
				}
				header('location: ../render/render.php');
			}
		}
	}
	?>