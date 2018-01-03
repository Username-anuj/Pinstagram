<?php
	include '../../connection/conn.php';
	session_start();
		$query = "SELECT * FROM Categories";
		$result = $conn->query($query);
		// $row = $result->fetch_assoc();
		$jsonArray = array();
		if ($result->num_rows > 0) 
		{
		  while($row = $result->fetch_assoc()) 
		  {
		    $jsonArrayItem = array();
		    $jsonArrayItem['label'] = $row['CatName'];
		    
		    $catid = $row['CatId'];
		    $num_pin = "SELECT count(*) from Pin where CatId='$catid'";
		    $result_num_pin = $conn->query($num_pin);
		    $row_num_pin = $result_num_pin->fetch_assoc();
		    $jsonArrayItem['value'] = $row_num_pin['count(*)'];;
		    array_push($jsonArray, $jsonArrayItem);
		  }
		}
		header('Content-type: application/json');
		echo json_encode($jsonArray);/*Gives output as json as shown below*/
?>

