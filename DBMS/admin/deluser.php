<?php
	include '../connection/conn.php';
	session_start();
	$uid=$_GET['id'];
	$del_user = "UPDATE User
		SET Status = 0
		WHERE UserId = $uid";
    $result = $conn->query($del_user);
    ?>
