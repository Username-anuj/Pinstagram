<?php
	include '../connection/conn.php';
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Boards</title>
</head>
<body>
<strong>These are my boards:</strong>
<i>
<?php
	$board_query = "SELECT * from Board where UserId = '".$_SESSION['myid']."'";
	$result_board_query = $conn->query($board_query);
	// print_r($result);
?>
<ol>
<?php
	while($row_board_query = $result_board_query->fetch_assoc())
	{
?>
			<li>
				<?php echo $row_board_query['BoardName']; ?>
				<br>
				<?php
					$pin_id_query = "SELECT * from FollowBoard WHERE BoardId = '".$row_board_query['BoardId']."' ";
					$result_pin_id_query = $conn->query($pin_id_query);
				?>
				<ol>
						<?php	
							while($row_pin_id_query = $result_pin_id_query->fetch_assoc())
							{
						?>
							<li>
							<?php	
							$board_pin_query = "SELECT * FROM BoardPins WHERE PinId = '".$row_pin_id_query['PinId']."'";
							$result_board_pin_query = $conn->query($board_pin_query);
							$row_board_pin_query = $result_board_pin_query->fetch_assoc();
						?>
							<img src="../boards/<?php echo $row_board_pin_query['Pic'] ?>">
						
							</li>
						<?php	
							}
						?>
				</ol>
			</li>
<?php
	}
?>
</ol>
</i>
</body>
</html>