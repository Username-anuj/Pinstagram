<?php
	include '../connection/conn.php';
	session_start();
	$uid=$_GET['id'];
	$setval=$_GET['setval'];
	$appendurl = $_GET[''];
	$block_user = "UPDATE User
		SET Status = $setval
		WHERE UserId = $uid";
    $result = $conn->query($block_user);
    // header('location:root.php');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    ?>
