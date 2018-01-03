<?php
	include '../connection/conn.php';
	session_start();
	$data=$_POST['serialize'];

	$receiver = $_POST['to'];
	 $sender = $_SESSION['myid'];
	// $message = $data['sendmessage'];

	// $receiver = $_GET['to'];
	//  $sender = $_SESSION['myid'];
	 $message = $_POST['sendmessage'];

			echo "hi";
			$sql = "INSERT INTO chats (Sender,Receiver,Message)VALUES($sender,$receiver,'$message')";

			if ($conn->query($sql) === TRUE) 
			{
				 // header('location: chat.php?uid='.$receiver);
				echo $data;
			}
			else {
    echo "Error: " . $sql . "<br>" . $conn->error;}
?>