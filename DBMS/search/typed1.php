<?php

include '../connection/conn.php';
session_start();


$key = $_POST['search_query'];
// $password = $_POST['pwd'];

$query_pins=$conn->query("SELECT * from Pin where Description LIKE '%{$key}%'");
if($query_pins->num_rows==0){echo 'No records found';}
 ?>
 <html>
 <head>
 	<title>Search Result</title>
 </head>
 <body>
 <ol>
 <?php
    	while($row_pins=$query_pins->fetch_assoc())
    	{
    	  // $array['Category'][$index_category] = $row_category['CatName'];
    	  // $index_category++;
    		 $array=array('label' => $row_pins['Description'],'category' => 'Pins');?>
    		<li> 
    		<?php echo $array['label'];?>
    		<img src="../pinupload/<?php echo $row_pins['Pic']; ?>">
    		</li>
    		<?php
    		 // echo $array['category'];
    	}
 // foreach ($array as $key => $value) {
 //     echo "Key: $key; Value: $value\n";
 // }
 ?>
 </ol>
 </body>
 </html>
   	