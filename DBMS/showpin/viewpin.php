
<?php
include '../connection/conn.php';
session_start();
// $_GET['pid']=1;
$pid=$_GET['pid'];
$show=$_GET['show'];
// $seen=$_GET['seen'];
$userid=$_SESSION['myid'];
$sql="SELECT * FROM Pin WHERE PinId='$pid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$Pic=$row["Pic"];
$Title=$row["Name"];
$Description=$row["Description"];
$cid=$row["CatId"];
$usid=$row["UserId"];
$download=$row["Download"];
$ts=$row["Timestamp"];
// echo $ts;
$sql="SELECT UserId FROM LikePin WHERE PinId='$pid'";
$result = $conn->query($sql);
$numLikes=$result->num_rows;
// print_r($result);
$n=1;
while($row = $result->fetch_assoc())
{
  // print_r($row);
  // echo $_SESSION['myid'];
	$uid=$row["UserId"];
  // echo $uid;
	if($uid==$_SESSION['myid'])
	{
		$n=0;
	}
}

$sql="SELECT UserId1 FROM FollowUser WHERE UserId2='$usid'";
$result = $conn->query($sql);
$follow=1;
if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		$uid1=$row["UserId1"];
		if($uid1==$_SESSION['myid']) 
		{
			$follow=0;
		}
	}
}
if($usid==$userid)
{
	$follow=2;
}
function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);
	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;
	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
		);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}
	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}
if(isset($seen)) 
{
	$sql = "UPDATE Notification SET Seen=1 WHERE UserId='$userid' AND PinId='$pid'";
	$result=$conn->query($sql);
}
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Pinstagram | ViewPin</title>
	<!-- Bootstrap core CSS-->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="css/sb-admin.css" rel="stylesheet">
	<!-- Jquery latest -->
	<link href="css/additional.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	<?php
// if(!empty($show))
// {
	?>
	<!-- <script type="text/javascript">
	$(document).ready(function(){
        $("#myLikeModal").modal('show');
    });		
</script> -->
<?php
	// }?>

	<style type="text/css">
		.btn{
			background-color: transparent; 
			color: #337ab7; 
			font-size: 100%; 
			padding:0px; 
			border:none
		}

		.btn:hover{
			color:#23527c;
			text-decoration: underline;
			background: transparent;
		}

		#follow{
			color: #ffffff;
			font-family: "Helvetica";
			font-size: 10pt;
			background-color: #b30000;
			border: 1px solid;
			border-color: #b30000;
			border-radius: 3px;
			width: 85px;
			height: 30px;
			float: right;
			position: absolute;
			top:15px;
			right: 5px;
		}

		#unfollow{
			color: #b30000;
			font-family: "Helvetica";
			font-size: 10pt;
			background-color: #ffffff;
			border: 1px solid;
			border-color: #b30000;
			border-radius: 3px;
			width: 85px;
			height: 30px;
			float: right;
			position: absolute;
			top:15px;
			right: 5px;
		}

		#sub{
			color: #ffffff;
			font-family: "Helvetica";
			font-size: 10pt;
			background-color: #b30000;
			border: 1px solid;
			border-color: #b30000;
			border-radius: 3px;
			width: 85px;
			height: 30px;
			position: absolute;
			bottom:35px;
		}
		#likefollow{
			color: #ffffff;
			font-family: "Helvetica";
			font-size: 10pt;
			background-color: #b30000;
			border: 1px solid;
			border-color: #b30000;
			border-radius: 3px;
			width: 85px;
			height: 30px;
			float: right;
			position: relative;
			right: 5px;
			top:-100px;
			right: 5px;


		}
		#likeunfollow{
			color: #b30000;
			font-family: "Helvetica";
			font-size: 10pt;
			background-color: #ffffff;
			border: 1px solid;
			border-color: #b30000;
			border-radius: 3px;
			width: 85px;
			height: 30px;
			float: right;
			position: relative;
			top:-100px;
			right: 5px;

		}

		#save:hover{
			background:#337ab7!important;
			color: white;
		}

		#createboard{
			background:#337ab7!important;
			color: white;
			position: absolute;
			bottom: 20px;
			right: 20px;
			padding: 15px;

		}

		#cancel{
			background:#a6a6a6!important;
			color: #4d4d4d;
			position: absolute;
			bottom: 20px;
			left: 50%;
			padding: 15px;
		}

		#share{
			background: transparent;
			color:white;
			font-weight: bold;
			width: 100%;
		}

	</style>

</head>

<div class="content-wrapper">
	<div class="container-fluid">

		<div class="card-columns" style="padding-left: 135px;">
			<!-- Example Social Card-->
			<div class="card mb-3" >
				<?php
				$sql1 = "SELECT * FROM User WHERE UserId='$usid'";
				$result1 = $conn->query($sql1);
				$row1=$result1->fetch_assoc();
				$uname=$row1["UserName"];
				$dp=$row1["Dp"];
				?>
				<div class="card-body small bg-faded">
					<div class="media">
					<a href="../otherprofile/othprofile.php?id=<?php echo $usid?>" style="font: 400 25px/1.3 'Berkshire Swash', Helvetica, sans-serif;"><img class="d-flex mr-3" src="../images/dp/<?php echo $dp;?>" style="height: 50px; width: 50px; border-radius:50%;" alt="">
						<div class="media-body">
							<h3 class="mt-0 mb-1" ><?php echo $uname?></a></h3>
							<p style="font-family: Garamond; font-size: 15px"> <strong> &#183 </strong> <?php echo time_elapsed_string($ts); ?></p>
							<?php 
							if($follow!=2)
							{
								if($follow==1)
								{
									?> 
									<a href="followuser.php?follow=<?php echo $follow?>&pid=<?php echo $pid?>&uid=<?php echo $usid?>"><button type="button" class="btn btn-warning" id="follow"> Follow</button></a>
									<?php 
								}
								else
								{
									?>
									<a href="followuser.php?follow=<?php echo $follow?>&pid=<?php echo $pid?>&uid=<?php echo $usid?>"><button type="button" class="btn btn-warning" id="unfollow"> Following</button></a>
									<?php 
								}
							}
							?>
						</div>
					</div>
				</div>



				<img class="card-img-top img-fluid w-100"  src="../pinupload/<?php echo $Pic; ?>" alt="">
				<div class="card-body">
					<h3 class="card-title mb-1" style="font: 400 30px/1.3 'Berkshire Swash', Helvetica, sans-serif;"><?php echo $Title ?></h3>

					<p class="card-text small" style="font-family: Garamond; font-size: 15px;"><?php echo $Description ?> <br>
					</p>
				</div>

				<hr class="my-0">
				<div class="card-body py-2 small">
					<a href="likepin.php?n=<?php echo $n?>&pid=<?php echo $pid ?>" style="margin:0px">
						<?php
						if($n==1)
						{
							?>
							<i class="fa fa-heart-o" aria-hidden="true" style="color: #ff4d4d
							" style="font-family: Garamond; "></i>
							<?php
						}
						else
						{
							?>
							<i class="fa fa-heart" aria-hidden="true" style="color: #ff4d4d
							" style="font-family: Garamond; "></i>
							<?php
						}
						?></a>
						<?php
						if(!empty($numLikes))
						{ ?>
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myLikeModal" id="likebutton"style="font-family: Garamond; "><span style="font-family: Garamond; "><?php
							
								echo $numLikes." Likes";
							
							?></span></button> 
							<?php
							}

							
							if(empty($numLikes))
							{
								?>
								<a class="mr-3 d-inline-block" href="likepin.php?n=<?php echo $n?>&pid=<?php echo $pid ?>" style="font-family: Garamond; ">
									<?php echo "Like"?></a>
									<?php
								}
								?>



								<div id="myLikeModal" class="modal fade" role="dialog" >
									<div class="modal-dialog">

										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header" style="background: #337ab7; color: white;">
												<center><h4 class="modal-title" style="font: 400 35px/1.3 'Berkshire Swash', Helvetica, sans-serif;"> People</h4></center>
												<button type="button" class="close" data-dismiss="modal" style="position:absolute; right: 5px; color: white">&times;</button>

											</div>
											<div class="modal-body">
												<?php
												$likequery = "SELECT * from LikePin where PinId = '$pid'";
												$resultlikequery = $conn->query($likequery);
												while($rowlikequery = $resultlikequery->fetch_assoc())
												{
													$userId=$rowlikequery['UserId'];

													$sql="SELECT UserId1 FROM FollowUser WHERE UserId2='$userId'";
													$result = $conn->query($sql);
													$follow=1;
													if ($result->num_rows > 0) 
													{
														while($row = $result->fetch_assoc()) 
														{
															$uid1=$row["UserId1"];
															if($uid1==$_SESSION['myid']) 
															{
																$follow=0;
															}
														}
													}
													if($userId==$userid)
													{
														$follow=2;
													}
													$userQuery="SELECT * FROM User WHERE UserId='$userId'";
													$resultUser=$conn->query($userQuery);
													while($rowUser=$resultUser->fetch_assoc())
													{
														$userName=$rowUser['UserName'];
														$dp=$rowUser['Dp'];
														$followQuery="SELECT * FROM FollowUser WHERE UserId2='$userId'";
														$resFollowQuery=$conn->query($followQuery);
														$numFollowers=$resFollowQuery->num_rows;
														// echo $followQuery;
														?>
														<div class= "likers" style="padding: 0px; margin: 0px; height: 70px;">
															<a href="../otherprofile/othprofile.php?id=<?php echo $userId?>"> <span> <img src="../images/dp/<?php echo $dp;?>" style="height: 45px; width: 45px; border-radius: 50%"></span><h4 style="font: 400 30px/1.3 'Berkshire Swash', Helvetica, sans-serif; position: relative; left: 60px; top:-55px; margin:0px; padding:0px;"> <?php echo $userName?> </h4> </a> <br><span style="font-family: Garamond; position: relative; left: 60px; top: -75px;"><?php echo $numFollowers ?> Followers </span></span>
															<?php 
															if($follow!=2)
															{
																if($follow==1)
																{
																	?> 
																	<a href="followuser.php?follow=<?php echo $follow?>&pid=<?php echo $pid?>&uid=<?php echo $userId?>"><button type="button" class="btn btn-warning" id="likefollow"> Follow</button></a>
																	<?php 
																}
																else
																{
																	?>
																	<a href="followuser.php?follow=<?php echo $follow?>&pid=<?php echo $pid?>&uid=<?php echo $userId?>"><button type="button" class="btn btn-warning" id="likeunfollow"> Following</button> </a>
																	<?php 
																}
															}
															?> <hr style="position: relative;top: -60px; padding:0px; margin:0px;">

														</div>


														<?php
													}
												}
												?>
											</div>
											<div class="modal-footer" style="background:#337ab7">

											</div>

										</div>
									</div>
								</div>







								<button type="button" class="btn btn-info btn-lg" onclick=" function() {
									document.getElementById('comm').select();" style="margin-right:1rem">
									<i class="fa fa-fw fa-comment" ></i><span style="font-family: Garamond; ">Comment</span></button>


									<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mySaveModal" style="margin-right:1rem">
										<i style="font: 400 18px/0.8;" class="fa fa-paperclip" aria-hidden="true"></i><span style="font-family: Garamond; "> Save to boards</span></a> 
									</button>

									<div id="mySaveModal" class="modal fade" role="dialog">
										<div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header" style="background: #337ab7; color: white;">
													<center><h4 class="modal-title" style="font: 400 30px/1.3 'Berkshire Swash', Helvetica, sans-serif;"> Save To Boards</h4></center>
													<button type="button" class="close" data-dismiss="modal" style="position: absolute; right: 5px; color: white;">&times;</button>

												</div>
												<div class="modal-body">
													<div style="width: 45%; float:left;"><img src="../pinupload/<?php echo $Pic ?>" style="width:100%"></div>
													<div style="width:50%; float:right;">	
														<?php
														$board_query = "SELECT * from Board where UserId = '".$_SESSION['myid']."'";
														$result_board_query = $conn->query($board_query);
														while($row_board_query = $result_board_query->fetch_assoc())
														{
															$Bid=$row_board_query['BoardId'];
															$Bname=$row_board_query['BoardName'];
															$pinQuery="SELECT * FROM FollowBoard WHERE BoardId=$Bid";
															$resPinQuery = $conn->query($pinQuery);
															if($resPinQuery->num_rows>0)
															{
																$rowPinQuery = $resPinQuery->fetch_assoc();
																$pinBoard=$rowPinQuery['PinId'];
																$pinBoardQuery="SELECT * FROM BoardPins WHERE PinId='$pinBoard'";
																$resPinBoardQuery = $conn->query($pinBoardQuery);
																$rowPinBoardQuery = $resPinBoardQuery->fetch_assoc();
																$src='../boards/'.$rowPinBoardQuery['Pic'];
															}
															else
															{
																$src="default.jpg";
															}
															?>
															<form action="savetoboards.php" method="post" enctype="multipart/form-data">

															<input type="hidden" name="pid" value="<?php echo $pid ?>">

															<input type="hidden" name="ID" value="<?php echo $Bid ?>">

															<button class="btn btn-warning" type="submit" id="save" style="width: 100%; text-align: left;"> <h4 style="font-family: Garamond;"> <img src="<?php echo $src?>" style="height: 50px; width: 50px; border-radius: 50%;" id="save">
																<?php echo $Bname?></h4> </button>

																</form>

																<hr style="padding: 0px; margin: 0px;">



																<?php
															}
															?>



														
													</div>

												</div>
												<div class="modal-footer" style="background: #337ab7;">
													<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#CreateNewBoard" style="width:100%;background-color: transparent color: #23527c; color: white;" data-dismiss="modal" style="font: 400 30px/1.3 'Berkshire Swash', Helvetica, sans-serif;">  <h4 style="font: 400 15px/1.3 'Berkshire Swash', Helvetica, sans-serif;"><strong> + Create New Board </strong> </h4> </button>

												</div>

											</div>
										</div>
									</div>

									<div id="CreateNewBoard" class="modal fade" role="dialog" tabindex="-1">
										<div class="modal-dialog">


											<div class="modal-content">

												<div class="modal-header" style="background: #337ab7; color: white;">

													<center><h4 class="modal-title" style="font: 400 30px/1.3 'Berkshire Swash', Helvetica, sans-serif;"> Save To Boards</h4></center>
													<button type="button" class="close" data-dismiss="modal" style="position: absolute; right: 5px; color: white;" >&times;</button>
												</div>
												<div class="modal-body">
													<div style="width: 45%; float:left"><img src="../pinupload/<?php echo $Pic ?>" style="width:100%"></div>
													<div style="width:50%; float:right">
														<form action="createboard.php" method="post" enctype="multipart/form-data">
															<strong> <h4 style="font-family: Garamond;">Name Your Board:</h4></strong>
															<input type="text" name="Boardnm" class="form-control" style="border: none; box-shadow: inset 0px 0px 0px rgba(0,0,0,0); webkit-box-shadow:0px;">
															<input type="hidden" name="pid" value="<?php echo $pid ?>">
															<hr style="padding: 0px; margin: 0px; ">
															<button type="button" class="btn btn-default" data-dismiss="modal" id="cancel"> <strong> Cancel </strong>
															</button>
															<button type="submit" id="createboard" class="btn btn-info btn-lg"> <strong> Create </strong> </button> 

														</form>
													</div>

												</div>
												<div class="modal-footer" style="background: #337ab7;">

												</div>

											</div>
										</div>
									</div>




									<a class="mr-3 d-inline-block" href="reportpin.php?pid=<?php echo $pid ?>" style="font-family: Garamond; ">
										<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Report Pin</a>


										<?php if($download==1)
										{
											?>


											<a class="mr-3 d-inline-block" href="../pinupload/<?php echo $Pic ?>" style="font-family: Garamond; " download>
												<i class="fa fa-download" aria-hidden="true"> </i> Download Pin
											</a>

											<?php
										}
										?>



										<!--Module Remaining-->

											<!--End Of Module-->
<!-- qwerty -->
<?php
			$buy="SELECT * FROM Pin WHERE PinId='$pid'";
			$result_buy = $conn->query($buy);
			$row_buy = $result_buy->fetch_assoc();
			if ($row_buy["CanBuy"]==1)
			{
						// 	alert('CanBuy');
						// </script>";					
				if($_SESSION['myid']!==$row_buy['UserId'])
				{
					$transact = "SELECT * FROM BuyPin where PinId='$pid' and UserId='".$_SESSION['myid']."'";
					$result_transact=$conn->query($transact);

					$row_transact=$result_transact->fetch_assoc();
					$req = $row_transact['Status'];

					if($req=="")
					{
						$addr = $_SESSION['address'];
						?>
						<button type="button" class="btn btn-info btn-lg" style="font-family: Garamond; " data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart mr-3 d-inline-block" aria-hidden="true"></i>Buy This Pin</button> </i>



						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Buy Pin </h4>
									</div>
									<div class="modal-body">
										<form action="buypin.php?pid=<?php echo $pid; ?>" method="POST" class="form-horizontal" role="form">
										<p><b>Item Details:</b></p>
											<?php 
												$result_stock = $conn->query("SELECT * from Pin where PinId='$pid'");
												$row_stock = $result_stock->fetch_assoc();
											 ?>
											<p>Stock:<?php echo $row_stock['Stock']; ?></p>
											<p id="price">Price:<?php echo $row_stock['Price']; ?></p>
											
											
											
										<p><b>Order Details:</b></p>	
										

											<p style="display: inline">Quantity</p>

											<input id="qty" onChange="hehe();" type="number" name="quantity" size="2" min="1" max="<?php echo $row_stock['Stock']; ?>">
											<!-- <label id="tot" align="center">Total amount:</label> -->
										<script type="text/javascript">
										
											function hehe(){
													var getUrlParameter = function getUrlParameter(sParam) {
													    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
													        sURLVariables = sPageURL.split('&'),
													        sParameterName,
													        i;

													    for (i = 0; i < sURLVariables.length; i++) {
													        sParameterName = sURLVariables[i].split('=');

													        if (sParameterName[0] === sParam) {
													            return sParameterName[1] === undefined ? true : sParameterName[1];
													        }
													    }
													};
													var qty = $('#qty').val();
													// alert(qty);
													var pid = getUrlParameter('pid');
													// alert(pid);
													 $.ajax({
													             type: 'POST',
													             url: 'getprice.php?pid='+pid+'&qty='+qty,
													             success: function(data) {
													                 // alert(data);
													                 $(".totalp").html(data);

													             }
													         });
													 
												}
												
											</script>
											<p></p>
											<p class="totalp">Total Price:0</p>
											<br><br>
											<p>Address:</p>

												<textarea id="nameValidation" class="form-control" name="address" placeholder="Enter your address for buying pins" required><?php echo $_SESSION['address'];?></textarea>
											
											<div class="form-group">
											  <div class="col-sm-offset-2 col-sm-10">
											    <button type="submit" class="btn btn-default">Buy Pin!</button>
											  </div>
											</div>
										</form>
									</div>
									<div class="">
										<a id="lejabhai" href="buypin.php?pid=<?php //echo $pid ?>&address=<?php //echo $addr ?>">
											<button type="button" class="btn btn-default">Send buy request</button>
										</a>
									</div>

								</div>
							</div>
						</div>

						<?php

					}
					elseif ($req==1) {
						?>
						
							<i  class="fa fa-check-circle mr-3 d-inline-block" aria-hidden="true" ><button type="button" class="btn btn-info btn-lg" style="font-family: Garamond; " data-toggle="modal" data-target="#requestaccepted"> Item purchased  <?php $uname_query = "SELECT * from User where UserId = '".$row_buy['UserId']."'";
								$result_uname = $conn->query($uname_query);
								$row_uname = $result_uname->fetch_assoc();
								?></button></i>

								<?php 
								$result_reqsent = $conn->query("SELECT UserId,PinId,Quantity,date(TimeStamp),time(TimeStamp) from BuyPin where UserId='$userid' and PinId='$pid'");
								$row_reqsent = $result_reqsent->fetch_assoc();
								$result_details = $conn->query("SELECT * from Pin where PinId='$pid'");
								$row_details = $result_details->fetch_assoc();
								$price = $row_details['Price'];
								$totp = $price*$row_reqsent['Quantity'];	

							?>
							<div id="requestaccepted" class="modal fade" role="dialog">
							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title"></h4>
							      </div>
							      <div class="modal-body">
							        <p>Seller: <?php echo $row_uname['UserName']; ?></p>
							        <p>Quantity: <?php echo $row_reqsent['Quantity']; ?></p>
							        <p>Total amount: <?php echo $totp; ?> Rupees</p>
							        <p>Date: <?php echo $row_reqsent['date(TimeStamp)']; ?> Time :<?php echo $row_reqsent['time(TimeStamp)']; ?></p>
							        <a href="receipt.php?seller=<?php echo $row_uname['UserName']; ?>&qty=<?php echo $row_reqsent['Quantity']; ?>&tot=<?php echo $totp; ?>&time=<?php echo $row_reqsent['time(TimeStamp)']; ?>&date=<?php echo $row_reqsent['date(TimeStamp)']; ?>" target=_blank>Get Receipt</a>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>

							  </div>
							</div>
															
							<?php						
						}
						else if($req==0)
						{	

							?>

							
							<i  class="fa fa-fa-opencart mr-3 d-inline-block" aria-hidden="true" ><button type="button" class="btn btn-info btn-lg" style="font-family: Garamond; " data-toggle="modal" data-target="#requestsent">Buy request Sent to <?php $uname_query = "SELECT * from User where UserId = '".$row_buy['UserId'] ."'";
							$result_uname = $conn->query($uname_query);
							$row_uname = $result_uname->fetch_assoc();
							echo $row_uname['UserName'];  ?></button></i>

							<?php 
								$result_reqsent = $conn->query("SELECT UserId,PinId,Quantity,date(TimeStamp),time(TimeStamp) from BuyPin where UserId='$userid' and PinId='$pid'");
								$row_reqsent = $result_reqsent->fetch_assoc();
								$result_details = $conn->query("SELECT * from Pin where PinId='$pid'");
								$row_details = $result_details->fetch_assoc();
								$price = $row_details['Price'];
								$totp = $price*$row_reqsent['Quantity'];	

							?>

							<div id="requestsent" class="modal fade" role="dialog">
							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title"></h4>
							      </div>
							      <div class="modal-body">
							        <p>Quantity: <?php echo $row_reqsent['Quantity']; ?></p>
							        <p>Total amount: <?php echo $totp; ?> Rupees</p>
							        <p>Date: <?php echo $row_reqsent['date(TimeStamp)']; ?> Time :<?php echo $row_reqsent['time(TimeStamp)']; ?></p>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>

							  </div>
							</div>

								 


								<?php	
							}


						}
						else { ?>

							<i  class="fa fa-fa-opencart mr-3 d-inline-block" aria-hidden="true" ><button type="button" class="btn btn-info btn-lg" style="font-family: Garamond; " data-toggle="modal" data-target="#viewrequests">View Buy Requests</button></i>
							<div id="viewrequests" class="modal fade" role="dialog">
							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title"></h4>
							      </div>
							      <div class="modal-body">
							        <?php
							        $transact1 = "SELECT * FROM BuyPin where PinId='$pid'";
							        $result_transact1=$conn->query($transact1);

							        while($row_transact1=$result_transact1->fetch_assoc())
							        {
							        	$req1 = $row_transact1['Status'];
							        	if($req1==0)
							        	{

							        		?>
							        			<i class="fa fa-opencart" aria-hidden="true" > Request From <?php 
							        				$uname_query = "SELECT * from User where UserId = '".$row_transact1['UserId']."'";
							        				$result_uname = $conn->query($uname_query);
							        				$row_uname = $result_uname->fetch_assoc();
							        				echo $row_uname['UserName']; ?></i>
							        			 

							        			<a href="sellpin.php?pid=<?php echo $pid ?>&approve=true&uid=<?php echo $row_transact1['UserId'] ?>">
							        				<div class="" style="display: inline-block;border:solid;border-color: green;background-color: green;color: white;border-radius: 10px" id="">
							        					<i class="fa fa-opencart fa-x" aria-hidden="true" > Sell Item <?php 
							        						/*$uname_query = "SELECT * from User where UserId = '".$row_transact1['UserId']."'";
							        						$result_uname = $conn->query($uname_query);
							        						$row_uname = $result_uname->fetch_assoc();
							        						echo $row_uname['UserName']; */?></i>
							        					</div>
							        				</a>
							        				<a href="sellpin.php?pid=<?php echo $pid ?>&approve=false&uid=<?php echo $row_transact1['UserId'] ?>">
							        					<div class="" style="display: inline-block;border:solid;border-color: red;background-color: red;color: white;border-radius: 10px" id="">
							        						<i class="fa fa-opencart fa-x" aria-hidden="true" > Reject Request<?php 
							        							/*$uname_query = "SELECT * from User where UserId = '".$row_transact1['UserId']."'";
							        							$result_uname = $conn->query($uname_query);
							        							$row_uname = $result_uname->fetch_assoc();
							        							echo $row_uname['UserName']; */?></i>
							        						</div>
							        					</a>
							        					<br><br>
							        					<?php
							        				}
							        				elseif($req1==1)
							        				{
							        					?>
							        					
							        						<i class="fa fa-check-circle" aria-hidden="true"> Sold to

							        							<?php 
							        							$uname_query = "SELECT * from User where UserId = '".$row_transact1['UserId']."'";
							        							$result_uname = $conn->query($uname_query);
							        							$row_uname = $result_uname->fetch_assoc();
							        							echo $row_uname['UserName']; ?></i><br><br>
							        						
							        						<?php
							        					}
							        					else
							        					{
							        						?>
							        						
							        							<i class="fa fa-opencart" aria-hidden="true" >No purchases yet</i>
							        						

							        						<?php
							        					}

							        				} ?>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>

							  </div>
							</div>
							<?php
										}
									}
									?>

<!-- /qwerty -->




											<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myShareModal" style="margin-right:1rem">
												<i class="fa fa-fw fa-share"></i><span style="font-family: Garamond; ">Share</span></a>
											</button>

											<!-- Modal -->
											<div id="myShareModal" class="modal fade" role="dialog" tabindex="-1">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
														<div style="background: #337ab7; color: white;" class="modal-header">
															<h4 class="modal-title" style="font: 400 30px/1.3 'Berkshire Swash', Helvetica, sans-serif;"><center> <?php echo $Title?></center></h4>
															<button type="button" class="close" data-dismiss="modal" style="position: absolute; right: 5px; color: white;" >&times;</button>

														</div>
														<div class="modal-body">

															<center><img src="../pinupload/<?php echo $Pic; ?>" style="width: 35em"></center><br>
															<div class="form-group">
																<h4 style="font-family: Garamond; "><strong>Add Description:</strong><br></h4>
																<form id="myFormId">
																	<textarea class="form-control" id="nameValidation" onkeyup="hojabhai()" class="form-control" name="desc" placeholder="Enter the description"> </textarea>
																	<script>
																		var desc='';
																		function hojabhai(){
																			desc = $('#myFormId').serialize();
																			$('#lejabhai').attr("href","sharepin.php?pid=<?php echo $pid ?>&"+desc);
																		}
																	</script>
																</form>
															</div>
														</div>
														<div class="modal-footer" style="background: #337ab7;">
															<a id="lejabhai" style="width: 100%" href="sharepin.php?pid=<?php echo $pid ?>">
																<button type="button" class="btn btn-default" id="share"><h5 style="font: 400 20px/1.3 'Berkshire Swash', Helvetica, sans-serif;">Share Pin</h5></button>
															</a>
														</div>

													</div>
												</div>
											</div>


											<?php
											$sql = "SELECT * FROM Comments WHERE PinId='$pid' ORDER BY CreatedOn";
											$result = $conn->query($sql);
											if ($result->num_rows > 0)
											{
												while($row = $result->fetch_assoc())
												{
													$userId=$row["UserId"];
													$cont=$row["Content"];
													$time=$row["CreatedOn"];
													$sql1 = "SELECT * FROM User WHERE UserId='$userId'";
													$result1 = $conn->query($sql1);
													$row1=$result1->fetch_assoc();
													$uname=$row1["UserName"];
													$dp=$row1["Dp"];
													?>


													<hr class="my-0" style="padding: 0px; margin: 0px;">
													<div class="card-body small bg-faded">
														<div class="media" id="comm">
															<a href="../otherprofile/othprofile.php?id=<?php echo $userId?>"><img class="d-flex mr-3" src="../images/dp/<?php echo $dp;?>" style="width: 45px; height:45px; border-radius: 50%" alt="">
															<div class="media-body">
																<h5 class="mt-0 mb-1" style="font: 400 15px/1.3 'Berkshire Swash', Helvetica, sans-serif;"><?php echo $uname?></a></h5><span style="font-family: Garamond; font-size: 15px; padding:0px; margin:0px;"><?php echo $cont?></span><br> <span style="font-family: Garamond; font-size: 10px;"> <strong> &#183 </strong> <?php echo time_elapsed_string($time) ?></span>
															</div>
														</div>
													</div>

													<?php
												}
											}

											$sql="SELECT * FROM User WHERE UserId='$userid'";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc())
											{
												$dp=$row["Dp"];
												$uname=$row["UserName"];
											}

											?>

											<form action="comment.php" method="post" enctype="multipart/form-data">
												<div class="form-group">
													<hr class="my-0">
													<div class="card-body small bg-faded">
														<div class="media" id="comm">
															<img class="d-flex mr-3" src="../images/dp/<?php echo $dp;?>" style="width: 50px; height:50px; border-radius: 50%" alt="">
															<div class="media-body">
																<h5 class="mt-0 mb-1" style="font: 400 15px/1.3 'Berkshire Swash', Helvetica, sans-serif;"><a href="../otherprofile/othprofile.php?id=<?php echo $userid?>"><?php echo $uname?></a></h5>

																<textarea id="comm" name="content" placeholder="Add your comment here..." style="width:70%;" rows="1" class="form-control"></textarea>
																<input type="hidden" name="pid" value="<?php echo $pid?>">
																<input type="submit" id="sub" name="submit" value="Post"  style="position: absolute; bottom: 55px; right: 5px; background:#337ab7; border-color: #337ab7 "><br>
															</div>
														</div>
													</div>
												</div>
											</form>

											<!-- <div class="card-footer small text-muted">Posted 32 mins ago</div> -->
										</div>
									</div>
								</div>
							</div>
							<h3 style="font: 400 25px/1.3 'Berkshire Swash', Helvetica, sans-serif;"><center>More Like This</center> </h3> 
							<iframe src="../showcat/viewcat.php?cid=<?php echo $cid?>" height="100%" width="100%" style="position: absolute; left: 0px;"></iframe>

							<!-- Bootstrap core JavaScript-->
							<script src="vendor/jquery/jquery.min.js"></script>
							<script src="vendor/popper/popper.min.js"></script>
							<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
							<!-- Core plugin JavaScript-->
							<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
							<!-- Page level plugin JavaScript-->
							<script src="vendor/chart.js/Chart.min.js"></script>
							<script src="vendor/datatables/jquery.dataTables.js"></script>
							<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
							<!-- Custom scripts for all pages-->
							<script src="js/sb-admin.min.js"></script>
							<!-- Custom scripts for this page-->
							<script src="js/sb-admin-datatables.min.js"></script>
							<script src="js/sb-admin-charts.min.js"></script>

						</body>

						</html>
