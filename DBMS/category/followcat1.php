<?php
include '../connection/conn.php';
session_start();
include '../navbar.php';
$userid = $_SESSION['myid'];
$checker=[];
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
			$j=0;
				foreach($_POST['cat'] as $selected)
				{
					$sql = "SELECT CatId FROM Categories WHERE CatName='$selected'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) 
					{
						echo "HI<br>";
						while($row = $result->fetch_assoc()) 
						{
							$cid=$row["CatId"];
							echo $cid;
							$checker[$j++]=$cid;
						}
					} 
					else
					{
						echo "Error catid";
					} 
					if(array_search($cid, $selectcid)===FALSE)
					{
						echo $cid;
						$sql = "INSERT INTO FollowCat (CatId,UserId) VALUES ('$cid','$userid')";

						if ($conn->query($sql) === TRUE) 
						{
							echo "New record created successfully<br>";
							// header('location: ../render/render.php');

						}
					} 
				}
				header('location: ../render/render.php');
				$checked=implode(',',$checker);
				print_r($checked);
				$sql_delete="DELETE FROM FollowCat WHERE UserId='$userid' AND CatId NOT IN ($checked)";
				if($conn->query($sql_delete))
				{
					header('location: ../render/render.php');

				}
				
			

			}
		}
	}
	?>
