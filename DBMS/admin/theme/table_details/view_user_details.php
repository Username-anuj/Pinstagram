<?php 
  include("../../../connection/conn.php");
  session_start();
    $pin_uid_str = $_GET['userid'];
    $pin_uid = (int)$pin_uid_str;
    $pin_user = "SELECT * from Pin where UserId = '$pin_uid' and CanBuy = 1 ";
    $result_pin_user = $conn->query($pin_user);
    

    $pins_bought = "SELECT * from BuyPin where UserId = '$pin_uid' and Status = 1";
    $result_pins_bought = $conn->query($pins_bought);
 ?>

 


 <?php  
     $earned = "select sum(earned) as tot_earned from (SELECT Price*count(BuyPin.PinId) as earned from Pin,BuyPin where Pin.UserId='$pin_uid' and Pin.CanBuy=1 and BuyPin.Status and BuyPin.PinId=Pin.PinId group by Pin.PinId) as alias_name";
     $result_earned = $conn->query($earned);
     $row_earned = $result_earned->fetch_assoc();
        // echo ' Total money earned :'.$row_earned['tot_earned'];
 ?>


   <?php //echo 'Number of Pins Bought :'.$result_pins_bought->num_rows; ?>


<?php 
$spent="select sum(spent) as tot_spent from(select Price*count(BuyPin.PinId) as spent from Pin,BuyPin where BuyPin.UserId='$pin_uid' and Pin.CanBuy=1 and BuyPin.Status and BuyPin.PinId=Pin.PinId group by Pin.PinId) as alias_name";
$result_spent = $conn->query($spent);
     $row_spent = $result_spent->fetch_assoc();
     // {

         //echo '   Total money spent:'.$row_spent['tot_spent'];
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<table>
    <th>Number of sellable Pins</th>
    <th>Total money earned :</th>
    <th>Number of Pins Bought</th>
    <th>Total money spent</th>
    <th>Profile</th>
    <tr>
        <td><?php echo $result_pin_user->num_rows;?></td>
        <td><?php echo $row_earned['tot_earned'];?></td>
        <td><?php echo $result_pins_bought->num_rows;?></td>
        <td><?php echo $row_spent['tot_spent'];?></td>
        <td><a href='../../otherprofile/othprofile.php?id=<?php echo $pin_uid_str;?>'> View Profile </a></td>
    </tr>
</table>
</body>
</html>