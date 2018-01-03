<?php

include '../connection/conn.php';
session_start();


$email = $_POST['email'];
$password = $_POST['pwd'];

	$email_check = "SELECT * FROM User WHERE Email='$email'";   //to check if email is registered
	$result = $conn->query($email_check);
	//print_r($result); //DO NOT DELETE THIS COMMENT

	$row = $result->fetch_assoc();

	if($result->num_rows == 0)
	{
		$_SESSION['message'] = "Email is not registered. Please try again";
		header('location: login.php');
	}
	else
	{
		if($row["Pwd"]==$password&&$row["Status"]==1)
		{
			 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) 
			 {
			 	$_SESSION['address'] = $row['Address'];
			 	$_SESSION['whoami'] = $row["UserName"];  //user defined variables whoami and my_id
			 	$_SESSION['usertype'] = $row["Type"]; //to give extra options if user is an admin
			 	$_SESSION['profile_picture'] = $row["Dp"];
			 	$_SESSION['myid'] = $row['UserId'];
			 	$_SESSION['loggedin'] = 1;
			 	$_SESSION['email'] = $row['Email'];
			 	$_SESSION['pwd'] = $row['Pwd'];

			 	$timele = "SELECT now()";
			 	$result_timele = $conn->query($timele);
			 	$row_timele = $result_timele->fetch_assoc();
			 	$timeliya = $row_timele['now()'];

			 	echo $_SESSION["logintime"]=$timeliya;
			 	$myid = $_SESSION['myid'];
			 	$sql = "UPDATE User SET Online = 'Online' WHERE UserId = '$myid'";
			
				$run_sql = $conn->query($sql);
				
				

				if($row['Type']==0)
				{
					$_SESSION['user'];
				}
			 	if($row['Type']==1){ header('location: ../admin/theme/index.php');}
				else{ header('location: ../render/render.php');}
			 }

		}
		else if($row["Pwd"]!==$password)
		{
			$_SESSION['message'] = "Incorrect Password";
			header('location: login.php');
		}
		else {
			$_SESSION['message'] = "You cannot login as you have been blocked.";
		}
	}
?>