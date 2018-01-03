<?php
include '../connection/conn.php';
session_start();
/* 
	set session variables
*/
	$_SESSION['email'] = $_POST['Email'];
	$_SESSION['whoami'] = $_POST['UserName'];




	$_SESSION['profile_picture'] = $_FILES["Dp"]["name"];

/*
	*form fields stored in php variables
*/	
	echo $username = $_POST["UserName"];
	echo $email = $_POST["Email"];
	echo $password = $_POST["Pwd"];
	echo $password_confirm = $_POST["CPwd"];
	echo $dp = $_FILES["Dp"]["name"];
	echo $dp_temp = $_FILES["Dp"]["tmp_name"];
	$bus=$_POST['business'];
	$web=$_POST['Web'];

	$email_check = "SELECT * FROM User WHERE Email='$email'";  //to check if email already exists
	$run = $conn->query($email_check);
	
	$username_check = "SELECT * FROM User WHERE UserName='$username'";//for unique username
	$run1 = $conn->query($username_check);

	if($run->num_rows >= 1)
	{
		$_SESSION['message']  = "Email is already registered";
		header('location: signup.php');
	}

	else if($run1->num_rows >= 1)
	{
		$_SESSION['message']  = "Username is already used. Enter another username";
		header('location: signup.php');}
		else
		{
			if($password==$password_confirm)
			{
				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
					if($bus==0)
					{

						$sql = "INSERT INTO User (UserName, Pwd, Email, Status,Dp) VALUES('$username', '$password', '$email', 1,'$dp')";
					}
					else
					{
						$sql = "INSERT INTO User (UserName, Type, Pwd, Email, Status,Dp, Website) VALUES('$username',2, '$password', '$email', 1,'$dp','$web')";
					}

					if(move_uploaded_file($dp_temp,"../images/dp/{$dp}"))
					{
						$_SESSION['message']="Upload";
					}
					else
					{
						$_SESSION['message']="Error";
						header('location: signup.php');

					//header('location: ../index.php');

					}
					$run_sql = $conn->query($sql);
					/*print_r($run_sql);*/
					if ($run_sql === true)
					{
						$_SESSION['message'] = "Registered successfully";
						$_SESSION['address'] = $row['Address'];
						$_SESSION['whoami'] = $row["UserName"];  //user defined variables whoami and my_id
						$_SESSION['usertype'] = $row["Type"]; //to give extra options if user is an admin
						$_SESSION['profile_picture'] = $row["Dp"];
						$_SESSION['myid'] = $row['UserId'];
						$_SESSION['loggedin'] = 1;
						$_SESSION['email'] = $row['Email'];
						$_SESSION['pwd'] = $row['Pwd'];
						if($bus==0)
						{
							header('location: ../category/cat.php');
						}
						else
						{
							header('location: ../render/managepins.php');
						}

					}
					else
					{
						$_SESSION['message'] = "Unknown error occured";

						header('location: signup.php');

					}
					$idquery = "SELECT * FROM User WHERE Email='$email'";

					$run_idquery = $conn->query($idquery);
					$roq = $run_idquery->fetch_assoc();
					$_SESSION['myid'] = $roq['UserId'];
					echo $run_idquery; 

				}
			}
			else
			{
				$_SESSION['message'] = "Passwords do not match";

				header('Location: signup.php');
			}
		}
		?>