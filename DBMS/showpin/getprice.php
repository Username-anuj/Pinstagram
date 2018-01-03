<?php
include '../connection/conn.php';
session_start();
$pid=$_GET['pid'];
$qty=$_GET['qty'];
$sql="SELECT * FROM Pin WHERE PinId='$pid'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$price = $row['Price'];
echo 'Total Price: '.(int)$qty*(int)$price;
?>