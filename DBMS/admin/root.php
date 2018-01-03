<?php
include("../connection/conn.php");
session_start();
if($_SESSION['loggedin']==1 && $_SESSION['usertype']==1)
{
// $_SESSION['pagename'] = "index.php";
// if($_SESSION['iamroot'] == 1)


?>
<html>
    <head>
        <title>Pinstagram | ViewData</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="css/style.css" /> -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
        
            
        });
$(function() {
    $("td[class='qwe']").find("p").hide();
    $("table").click(function(event) {
    //$("td[class='qwe']").find("p").show();
        event.stopPropagation();
        var $target = $(event.target);
        if ( $target.closest("td").attr("colspan") > 1 ) {
            $target.slideUp();
        } else {
            $target.closest("tr").next().find("p").slideToggle();
        }                    
    });
});

        </script>
    </head>
    <body>
    <?php
    include('./search/index.php')
  ?>      <h1>you are root</h1>      
                <div class="container">
                  <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort Users By
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li class="dropdown-header">Manage Users</li>
                      <li><a href="root.php?sortby=UserId">User id</a></li>
                      <li><a href="root.php?sortby=UserName">User Name</a></li>
                      <li><a href="root.php?sortby=TimeStamp&order=DESC">Latest</a></li>
                      <li><a href="root.php?sortby=TimeStamp">Oldest</a></li>
                      <li class="divider"></li>
                    </ul>
                  </div>
                </div>

                    <div class="container-fluid">
                        <div class="row">
                            <!-- <div class="col-md-2"></div> -->
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="col-md-1"></th>
                                        <th class="col-md-1">User Id</th>
                                        <th class="col-md-1">User Name</th>
                                        <th class="col-md-1">Email</th>
                                        <!-- <th class="col-md-1">Password</th> -->
                                        <th class="col-md-1">Dp</th>
                                        <th class="col-md-1">Liked Pins</th>
                                        <th class="col-md-1">Number Of boards</th>
                                        <th class="col-md-1">Joining Date</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $order = $_GET['sortby'];
                                    $orderby = $_GET['order'];
                                    $query_user = "SELECT * FROM User order by $order $orderby";
                                    $result_user = $conn->query($query_user);
                                    while($row_user = $result_user->fetch_assoc()){
                                    ?>
                                    <tr bgcolor="<?php if($row_user['Status']==0){echo "red";}else{ echo "white"; } ?>">
                                        <td>+</td>
                                        <td class="col-md-1"><p><?php echo $row_user['UserId']; ?></p></td>
                                        <td class="col-md-1"><p><?php echo $row_user['UserName']; ?></p></td>
                                        <td class="col-md-1"><p><?php echo $row_user['Email']; ?></p></td>
                                        <!-- <td class="col-md-1"><p><?php //echo $row_user['Pwd']; ?></p></td> -->
                                        <td class="col-md-1"><p>
                                       
                                        <img style="height: 50px;width: 50px;border-radius: 50%;" class="img-responsive" src="../images/dp/<?php echo $row_user['Dp'];?>" onerror="this.src='../images/dp/default.jpg'">    
                                        </p>
                                        </td>
                                        
                                        <td class="col-md-1"><p><?php echo $row_user['NumLikedPins']; ?></p></td>
                                        <td class="col-md-1"><p><?php echo $row_user['NumBoards']; ?></p></td>
                                        <td class="col-md-1"><p><?php echo $row_user['TimeStamp']; ?></p></td>
                                        <?php if($row_user['Status']==1){ ?>
                                        <td class="col-md-1"><p><a href="blockuser.php?id=<?php echo $row_user['UserId']; ?>&setval=<?php echo 0; ?>">
                                        <i class="fa fa-ban" aria-hidden="true"></i><?php } ?></a></p></td>
                                        <?php if($row_user['Status']==0){ ?>
                                        <td class="col-md-1" style="background-color: white" ></p><a href="blockuser.php?id=<?php echo $row_user['UserId']; ?>&setval=<?php echo 1; ?>">
                                        <i class="fa fa-unlock-alt" aria-hidden="true"></i><?php } ?></a></p></td>
                                        
                                    </tr>
                                    <tr>
                  <td class='qwe'>
                    <p>
                      Other Stats
                    </p>
                  </td>
                  <td class='qwe'>
                    <p>
                      <?php 
                          $pin_uid = $row_user['UserId'];
                          $pin_user = "SELECT * from Pin where UserId = '$pin_uid' and CanBuy = 1 ";
                          $result_pin_user = $conn->query($pin_user);
                          

                          $pins_bought = "SELECT * from BuyPin where UserId = '$pin_uid' and Status = 1";
                          $result_pins_bought = $conn->query($pins_bought);
                       ?>

                      Number of sellable Pins : <?php echo $result_pin_user->num_rows;
                       ?>
                    </p>
                  </td>
                  <td class='qwe'>
                    <p>
                      Total money earned : 
                       <?php  
                           $earned = "select sum(earned) as tot_earned from (SELECT Price*count(BuyPin.PinId) as earned from Pin,BuyPin where Pin.UserId='$pin_uid' and Pin.CanBuy=1 and BuyPin.Status and BuyPin.PinId=Pin.PinId group by Pin.PinId) as alias_name";
                           $result_earned = $conn->query($earned);
                           $row_earned = $result_earned->fetch_assoc();
                               echo $row_earned['tot_earned'];
                       ?>
                    </p>
                  </td>
                  <td class='qwe'>
                    <p>
                        Number of Pins Bought : <?php echo $result_pins_bought->num_rows; ?>
                    </p>
                  </td>
                  <td class='qwe'>
                    <p>
                       Total money spent:
                      <?php 
                      $spent="select sum(spent) as tot_spent from(select Price*count(BuyPin.PinId) as spent from Pin,BuyPin where BuyPin.UserId='$pin_uid' and Pin.CanBuy=1 and BuyPin.Status and BuyPin.PinId=Pin.PinId group by Pin.PinId) as alias_name";
                      $result_spent = $conn->query($spent);
                           $row_spent = $result_spent->fetch_assoc();
                           // {

                               echo $row_spent['tot_spent'];
                      ?>
                    </p>
                  </td>
                  <td class='qwe'>
                    <p>
                      <a href="../../otherprofile/othprofile.php?id=<?php echo $pin_uid; ?>">View Profile</a>
                    </p>
                  </td>
                  <td class='qwe'>
                    <p>
                      <a href="../../otherprofile/othprofile.php?id=<?php echo $pin_uid; ?>">View Profile</a>
                    </p>
                  </td>
                  <td class='qwe'>
                    <p>
                      <a href="../../otherprofile/othprofile.php?id=<?php echo $pin_uid; ?>">View Profile</a>
                    </p>
                  </td>
                  <td class='qwe'>
                    <p>
                      <a href="../../otherprofile/othprofile.php?id=<?php echo $pin_uid; ?>">View Profile</a>
                    </p>
                  </td>

                </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <!-- <div class="col-md-2"></div> -->
                        </div>
                    </div>
                <!-- /USER DATA -->
                               
                
        
        
    </body>
</html>
<?php }
else {
echo '<h1>Gotcha, thief!</h1>';
echo "<a href='../login/login.php'><button>Log in first</button></a>";
}
?>