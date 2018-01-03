<?php
include '../connection/conn.php';
session_start();
$me = $_SESSION['myid'];
$other = $_GET['uid'];
// $n=$_GET['n'];
// echo $me;
// echo $other;
$other_user = $conn->query("call user_info($other,'*')");
$conn->next_result();
$other_user_row = $other_user->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="UTF-8">
		<!-- <meta http-equiv="Refresh" content="3"> -->
		<title>Pinstagram Chat</title>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
		<link rel="stylesheet" href="css/style.css">
		<!-- <script type="text/javascript" src="jquery-1.3.2.js"> </script> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="./lib/css/emoji.css" rel="stylesheet">
	</head>
	<body>
		<?php
			// $qid = $_SESSION['myid'];
			// $sql1="SELECT DISTINCT * FROM FollowUser WHERE UserId1='$me'";
		//       $result1 = $conn->query($sql1);
		
		?>
		<div class="container">
			<div clas="row">
				<div class="col-md-8">
					<div class="container-fluid">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<span class="glyphicon glyphicon-comment"></span>
								<?php
								if($other_user_row['Online']=='Online'){
								echo $other_user_row['Online'];
								}
								else {
									echo 'last seen at : '.date('g:i A, j M Y',strtotime($other_user_row['LastSeen']));
								}
								?>
							</div>
							
							
							<div class="panel-body">
								<ul class="chat" id="caht">
									<!--  -->
								</ul>
							</div>
							<div class="panel-footer">
								<form id="form1">
									<div class="input-group">
										<input type="hidden" name="to" id="to" value="<?php echo $other?>">
										<span class="input-group-btn">
											<input type="submit" id="btn1" value="Send" name="submit" class="btn btn-warning btn-sm" id="btn-chat">
										</span>
										<input type="text" name="sendmessage" class="form-control input-sm" placeholder="Type your message here..." data-emojiable="true"/>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel-body">
						<ul class="chat">
							<li>
								<a href="../profile/pro.php">Exit Messenger</a>
							</li>
							<?php
								// while($row1 = $result1->fetch_assoc())
								// {
									
									// 	$follower = $row1['UserId2'];
									
									// 	$user = $conn->query("call user_info($follower,'*')");
								// 				$conn->next_result();
								// 				$user_row = $user->fetch_assoc();
							$chats = array();
							$chatlist="SELECT DISTINCT Sender,Receiver from chats where Sender='$me' or Receiver='$me' ";
							$res_chatlist=$conn->query($chatlist);
							while($row_chatlist=$res_chatlist->fetch_assoc())
							{
								if($row_chatlist['Sender']==$me)
								{
									// echo "heloooooooooo oneeeeeee";
									$pushing = $row_chatlist['Receiver'];
									array_push($chats,"$pushing");
								}
								if($row_chatlist['Receiver']==$me)
								{
									// echo "heloooooooooo twooooooo";
									$pushing = $row_chatlist['Sender'];
									array_push($chats,"$pushing");
								}
							}
							
							$i=count((array_unique($chats)));
							
							$final_list=array();
								$final_list=array_unique($chats);
							$final_list = array_values($final_list);
							// print_r($final_list);
								while($i>=0)
								{
									
									$follower = $final_list[$i-1];
									$i=$i-1;
									$user = $conn->query("call user_info($follower,'*')");
								$conn->next_result();
								$user_row = $user->fetch_assoc();
							?>
							
							<li class="left clearfix">
								<span class="chat-img pull-left">
									<img src="../images/dp/<?php echo $user_row['Dp']?>" alt="User Avatar" style="height: 30px;width: 30px;border-radius:50%;" class="centered-and-cropped" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<a href="./chat.php?uid=<?php echo $user_row['UserId']; ?>"><strong class="primary-font"><?php echo $user_row['UserName']?></strong> </a><small class="pull-right text-muted">
										<?php
											if($user_row['Online']=='Online')
											{
										?>
										<span style="
											padding: 2px 9px;
											background: green;
											width: 5px;
											border-radius: 100%;
											margin-left: auto;
											margin-right: auto;
											width: 1%;">
										</span>
										<?php
											}
										?></small>
									</div>
									<p><b>
										
									</b></p>
								</div>
							</li>
							<?php	}
							?>
						</ul>
					</div>
				</div>
				<h1>Hellllllllooooo</h1>
				
			</div>
			<div class="container-fluid">
					<div class="row">
							<div class="cols=""">
									
							</div>
					</div>
			</div>
		</div>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
		<script src="http://cdn.rawgit.com/ashleighy/emoji.js/master/emoji.js.js"></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
				<script src="./lib/js/config.js">
		</script>
		<script src="./lib/js/util.js"></script>
		<script src="./lib/js/jquery.emojiarea.js"></script>
		<script src="./lib/js/emoji-picker.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var interval = setInterval(function(){
				$.ajax({
		url : 'getmsg.php?uid=<?php echo $other?>',
		success: function(data){
		// console.log(data);
		$('#caht').html(data);
		}
		});
		},1000);
		window.emojiPicker = new EmojiPicker({
		emojiable_selector: '[data-emojiable=true]',
		assetsPath: './lib/img/',
		popupButtonClasses: 'fa fa-smile-o'
		});
		window.emojiPicker.discover();
		});
		
		</script>
		<script type="text/javascript">
		var request;
			$("#form1").submit(function(event){
				event.preventDefault();
				var $form = $(this);
			var serializedData = $form.serialize();
			request = $.ajax({
		url: "sendmessage.php",
		type: "post",
		data: serializedData
		});
		document.getElementById("form1").reset();
			});
		</script>

	</body>
</html>