<?php
	include '../connection/conn.php';
	session_start();
	$_SESSION['uid']=$_GET['id'];
	$uid=$_SESSION['uid'];
	$sql="SELECT * FROM User WHERE UserId='$uid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $uname=$row["UserName"];
            $dp=$row["Dp"];
        }
    } 
	else 
	{
		echo "0 results<br>";
    }

    $sql="SELECT UserId1 FROM FollowUser WHERE UserId2='$uid'";
    $result = $conn->query($sql);
    $_SESSION['n']=1;
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $uid1=$row["UserId1"];
            if($uid1==$_SESSION['myid']) 
    		{
    			$_SESSION['n']=0;
    		}
        }
    }
   

?>

<html>
	<head>
		<title>
		Pinstagram|		</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
	<form action="followuser.php" method="post" enctype="multipart/form-data">
		
		<strong>
			Name:</strong>
			<?php 
				echo $uname;
			?>
		
		<br>
		<strong>
			Followers:</strong> 
			<?php 
				$sql="SELECT * FROM FollowUser WHERE UserId2='$uid'";
    			$result = $conn->query($sql);
    			echo $result->num_rows; 
    	    ?>
		
		<br>
		<strong>
			Following:</strong> 
			<?php 
				$sql="SELECT * FROM FollowUser WHERE UserId1='$uid'";
    			$result = $conn->query($sql);
    			echo $result->num_rows;  ?>
		<br>
		<a href="pins.php">Pins</a>
		<br>
		Profile Picture:<br>
		<img src="../images/dp/<?php echo $dp?>">
		<a href="../login/logout.php">LOG OUT </a>
		<br>
		<?php
			if($_SESSION['n']==1)
			{
				echo '<input type="submit" value="Follow User" name="submit">';
			}
			else
			{
				echo '<input type="submit" value="UnFollow User" name="submit">';
			}	
		?>
		</form>
	</body>
</html>
