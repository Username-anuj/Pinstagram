<?php
	include '../connection/conn.php';
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
		Pinstagram | Edit Profile
		</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<style>
		.error-message{
			color: blue;
			background-color: #ffb116;
			width: 100%;
			height: 30px;
			border-radius: 5px;
			margin-top:10px;
			padding: 3px;
		}
		</style>
		<!-- UPLOAD PROFILE PICTURE PREVIEW -->
		<script type="text/javascript">
		$(document).ready(function() {
			$("#fileUpload").on('change', function () {
			if (typeof (FileReader) != "undefined") {
			var image_holder = $("#image-holder");
			image_holder.empty();
			var reader = new FileReader();
			reader.onload = function (e) {
			$("<img />", {
			"src": e.target.result,
			
			}).appendTo(image_holder);
			}
			image_holder.show();
			reader.readAsDataURL($(this)[0].files[0]);
			} else {
			alert("This browser does not support FileReader.");
			}
			});
		
		});
		</script>
		<!-- /UPLOAD PROFILE PICTURE PREVIEW -->
	</head>
	<body>
	<?php include '../navbar.php'; ?>
		<?php
		//PHP script for showing messages
		if ($_SESSION['message']!=null) {
		echo "<div class=\"error-message\">";
						echo $_SESSION['message'];
		echo " </div>";
		$_SESSION['message'] = null;
		}
		
		/*
			For showing current profile data in the form
		*/
		?>
		<div class="container">
			<div class="row">
				<div class="col-xs-3"></div>
				<div class="col-xs-6">
					<form action="editprofile.php" method="POST" enctype="multipart/form-data">
						<h1 align="center">Edit Profile!</h1>
						<div class="form-group">
							<!-- <label style="display: inline-block;">Name</label> -->
							<input type="text" class="form-control" name="UserName" value="<?php echo $_SESSION['whoami']; ?>" required>
						</div>
						<div class="form-group">
							<input type="email" class="form-control" name="Email" value="<?php echo $_SESSION['email']; ?>" required>
						</div>
						
						<div class="form-group">
							<input type="password" class="form-control" name="Pwd" value="<?php echo $_SESSION['pwd']; ?>" required>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="CPwd" value="<?php echo $_SESSION['pwd']; ?>" required>
						</div>
						<div class="form-group">
							<p>Edit profile picture:</p><br>
							<!-- 				<img src="../images/dp/<?php //echo $_SESSION['profile_picture'];?>">
							-->				<div id="wrapper">
								<div id="image-holder">
									<img style="height: 200px;width: 200px;border-radius: 50%;" class="img-responsive" src="../images/dp/<?php echo $_SESSION['profile_picture'];?>">
								</div>
							</div>
							<input type="file" id="fileUpload" name="Dp">
							
						</div>
						<div class="form-group">
							Add Address(optional):
							<textarea class="form-control" rows="5" name="address" placeholder="Enter your address for buying pins"><?php echo $_SESSION['address']; ?></textarea>
							
						</div>
						<input type="submit" name="submit" 	class="btn btn-default" value="Save Changes">
					</form>
				</div>
				<div class="col-xs-3"></div>
			</div>
		</div>
		
	</body>
</html>
<?php
if(isset($_POST['submit'])){
	echo $address = $_POST['address'];
	echo $username = $_POST["UserName"];
	echo $email = $_POST["Email"];
	echo $password = $_POST["Pwd"];
	echo $password_confirm = $_POST["CPwd"];
	if(empty($_FILES["Dp"]["name"])){
		$dp = $_SESSION['profile_picture'];
			$dp_temp = $_SESSION['profile_picture'];
	}
	else{
	echo $dp = $_FILES["Dp"]["name"];
	echo $dp_temp = $_FILES["Dp"]["tmp_name"];
	}
	echo $myid = $_SESSION['myid'];
	$email_check = "SELECT * FROM User WHERE Email='$email' And not UserId='".$myid."' ";  //to check if email already exists
	$run = $conn->query($email_check);
	
	$username_check = "SELECT * FROM User WHERE UserName='$username' And not UserId='".$myid."'";//for unique username
	$run1 = $conn->query($username_check);
	if($run->num_rows >= 1)
	{
		$_SESSION['message']  = "Email is already registered";
			header('location: pro.php');
	}
	else if($run1->num_rows >= 1)
	{
		$_SESSION['message']  = "Username is already used. Enter another username";
			header('location: pro.php');}
	else
	{
		if($password==$password_confirm)
		{
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				
				$sql = "UPDATE User SET Address = '$address',UserName = '$username', Pwd = '$password', Email = '$email',Dp = '$dp' WHERE UserId = '$myid' ";
				move_uploaded_file($dp_temp,"../images/dp/{$dp}");
				$run_sql = $conn->query($sql);
				/*print_r($run_sql);*/
				if ($run_sql === true)
				{
					$_SESSION['message'] = "Changes Saved";
					//header('location: pro.php');
				}
				else
				{
					$_SESSION['message'] = "Unknown error occured";
					//header('location: pro.php');
				}
				$idquery = "SELECT * FROM User WHERE Email='$email'";
				$run_idquery = $conn->query($idquery);
				$roq = $run_idquery->fetch_assoc();
				$_SESSION['myid'] = $roq['UserId'];
				$_SESSION['email'] = $roq['Email'];
				$_SESSION['whoami'] = $roq['UserName'];
				$_SESSION['usertype'] = $roq["Type"];
				$_SESSION['profile_picture'] = $roq['Dp'];
				$_SESSION['pwd'] = $row['Pwd'];
				echo $run_idquery;
				header('location: login.php');

			}
		}
		else
		{
			$_SESSION['message'] = "Passwords do not match";
			
			header('location: pro.php');
		}
	}
}
?>