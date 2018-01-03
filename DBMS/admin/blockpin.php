<?php
	include '../connection/conn.php';
	session_start();
	$pid=$_GET['id'];
	echo $setval=$_GET['setval'];
	$block_pin = "UPDATE Pin
		SET Status = $setval
		WHERE PinId = $pid";
    $result = $conn->query($block_pin);
    // header('location:root_pins.php');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    ?>
