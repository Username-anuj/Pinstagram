<?php
	include '../../connection/conn.php';
	session_start();
		$query = "select count(*),year(TimeStamp) from User group by year(TimeStamp);";
		$result = $conn->query($query);
		// $row = $result->fetch_assoc();
		$jsonArray = array();
		if ($result->num_rows > 0) 
		{
		  while($row = $result->fetch_assoc()) 
		  {
		    $jsonArrayItem = array();
		    $jsonArrayItem['label'] = $row['year(TimeStamp)'];
		    $jsonArrayItem['value'] = $row['count(*)'];;
		    array_push($jsonArray, $jsonArrayItem);
		  }
		}
		header('Content-type: application/json');
		echo json_encode($jsonArray);/*Gives output as json as shown below*/
	?>

