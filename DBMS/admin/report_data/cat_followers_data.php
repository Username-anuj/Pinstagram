<?php
	include '../../connection/conn.php';
	session_start();
		$query_num_followers = "select count(UserId),CatId from FollowCat group by CatId ";
		$result_num_followers = $conn->query($query_num_followers);
		// $row = $result->fetch_assoc();
		$jsonArray = array();
		if ($result_num_followers->num_rows > 0) 
		{
		  while($row_num_followers = $result_num_followers->fetch_assoc()) 
		  {

		    $jsonArrayItem = array();

		    $catid = $row_num_followers['CatId'];
		    
		    $cat_name = "SELECT * from Categories where CatId='$catid'";
		    $result_cat_name = $conn->query($cat_name);
		    $row_cat_name = $result_cat_name->fetch_assoc();
		    
		    $jsonArrayItem['label'] = $row_cat_name['CatName'];
		    
		    $jsonArrayItem['value'] = $row_num_followers['count(UserId)'];;
		    array_push($jsonArray, $jsonArrayItem);
		  }
		}
		header('Content-type: application/json');
		echo json_encode($jsonArray);
	?>