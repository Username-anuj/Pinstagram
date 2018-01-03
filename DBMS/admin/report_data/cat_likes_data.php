<?php
	include '../../connection/conn.php';
	session_start();
		$query_sum_likes = "select sum(Likes),CatId from Pin group by CatId;";
		$result_sum_likes = $conn->query($query_sum_likes);
		// $row = $result->fetch_assoc();
		$jsonArray = array();
		if ($result_sum_likes->num_rows > 0) 
		{
		  while($row_sum_likes = $result_sum_likes->fetch_assoc()) 
		  {

		    $jsonArrayItem = array();

		    $catid = $row_sum_likes['CatId'];
		    
		    $cat_name = "SELECT * from Categories where CatId='$catid'";
		    $result_cat_name = $conn->query($cat_name);
		    $row_cat_name = $result_cat_name->fetch_assoc();
		    
		    $jsonArrayItem['label'] = $row_cat_name['CatName'];
		    
		    $jsonArrayItem['value'] = $row_sum_likes['sum(Likes)'];;
		    array_push($jsonArray, $jsonArrayItem);
		  }
		}
		header('Content-type: application/json');
		echo json_encode($jsonArray);
	?>