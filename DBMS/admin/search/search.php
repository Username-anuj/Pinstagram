<?php
   
include '../../connection/conn.php';

    $key=$_GET['key'];
    $array = array();
    $index_user = 0;
    $index_category = 0;

    $query_pins=$conn->query("SELECT * from Pin where Description LIKE '%{$key}%' Limit 4");
    while($row_pins=$query_pins->fetch_assoc())
    {
      // $array['Category'][$index_category] = $row_category['CatName'];
      // $index_category++;
       $array[]=array('label' => $row_pins['Description'],'category' => 'Pins');
    }
    
    $query_user=$conn->query("SELECT * from User where UserName LIKE '%{$key}%'");
    while($row_user=$query_user->fetch_assoc())
    {
      // $array[$index_user][label] = 'User';
     //  $array[$index_user][name] = $row_user['UserName'];
      $array[]=array('label' => $row_user['UserName'],'category' => 'User');

    
    }
    
    $query_category=$conn->query("SELECT * from Categories where CatName LIKE '%{$key}%'");
    while($row_category=$query_category->fetch_assoc())
    {
      // $array['Category'][$index_category] = $row_category['CatName'];
      // $index_category++;
       $array[]=array('label' => $row_category['CatName'],'category' => 'Category');
    }

    // $query_typed=$conn->query("SELECT * from Pin where Description LIKE '%{$key}%'");
    // while($row_typed=$query_typed->fetch_assoc())
    // {
    //   // $array['Category'][$index_category] = $row_category['CatName'];
    //   // $index_category++;
    //    $array[]=array('label' => $row_typed['Name'],'category' => 'Typed');
    // }
    
    // echo $array;
    // header('Content-type: application/json');
    echo json_encode($array);
?>