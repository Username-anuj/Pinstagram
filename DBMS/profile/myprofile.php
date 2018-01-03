<?php
include '../connection/conn.php';
session_start();
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
		
		<strong>
			Name:</strong><?php 
			echo $_SESSION['whoami'];
			?>

			<br>
			<strong>
				Followers:</strong> 
				<?php 
					$sql="SELECT * FROM FollowUser WHERE UserId2='".$_SESSION['myid']."'";
					$result = $conn->query($sql);
					echo $result->num_rows; 
				?>

				<br>
				<strong>
					Following:</strong> 
					<?php 
						$sql="SELECT * FROM FollowUser WHERE UserId1='".$_SESSION['myid']."'";
						$result = $conn->query($sql);
						echo $result->num_rows;  ?>
					<br>
					<a href="mypins.php">My Pins</a><br>
					<a href="myboards.php">My Boards</a>
					<br>
					Profile Picture:<br>
					<img src="../images/dp/<?php echo $_SESSION['profile_picture'];?>">
					<a href="editprofile.php">Edit Profile</a><br>
					<a href="../login/logout.php">LOG OUT </a>
					<br>
				</body>
				</html>
