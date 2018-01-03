<?php
include '../connection/conn.php';
session_start();
$_SESSION['uid']=13;
$uid=$_SESSION['uid'];
$sql="SELECT * FROM User WHERE UserId='$uid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
  while($row = $result->fetch_assoc()) 
  {
    $uname=$row["UserName"];
    $dp=$row["Dp"];
  }
}
$sql="SELECT UserId1 FROM FollowUser WHERE UserId2='$uid'";
$result = $conn->query($sql);
$_SESSION['n']=1;
if ($result->num_rows > 0) 
{
  while($row = $result->fetch_assoc()) 
  {
    $uid1=$row["UserId1"];
    if($uid1==$_SESSION['myid']) 
    {
      $_SESSION['n']=0;
    }
  }
} 
?>
<!DOCTYPE html>

<html>
<head>
  <title>
    Pinstagram|   </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
      .img-responsive {
        margin: 0 auto;
      }
      #follow-button {
        color: #b30000;
        font-family: "Helvetica";
        font-size: 10pt;
        background-color: #ffffff;
        border: 1px solid;
        border-color: #b30000;
        border-radius: 3px;
        width: 85px;
        height: 30px;
        /*position: absolute;  */
        top: 40px;
        cursor: hand;       
      }
      #unfollow-button{
        color: #ffffff;
        font-family: "Helvetica";
        font-size: 10pt;
        background-color: #b30000;
        border: 1px solid;
        border-color: #b30000;
        border-radius: 3px;
        width: 85px;
        height: 30px;
        /*position: absolute;  */
        top: 40px;
        cursor: hand; 
      }

    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-7">
          <div class="pull-left">
            <h1><?php echo $uname;?></h1>
          </div>
          <div class="pull-right">
            <?php
            if($_SESSION['n']==1)
            {
              ?>
              <a href="followuser.php"> <button id="follow-button">+ Follow</button> </a><br>
              <?php
            }

            else
            {
              ?>
              <a href="followuser.php"> <button id="unfollow-button"> Following &#x2714;</button> </a><br>
              <?php
            }?>
            <!-- <a href="../login/logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> </a><br> -->

          </div>


        </div>
        <div class="col-xs-5">

          <img style="height: 200px;width: 200px;border-radius: 50%;" class="img-responsive" src="../images/dp/<?php echo $dp;?>">

        </div>

      </div>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#pins">Pins</a></li>
        <li><a data-toggle="tab" href="#followers">Followers</a></li>
        <li><a data-toggle="tab" href="#following">Following</a></li>
      </ul>
      <div class="tab-content">

        <div id="pins" class="tab-pane fade in active">
          <?php
          $pin_query = "SELECT * from Pin where UserId = '$uid'";
          $result_pin_query = $conn->query($pin_query);
        // print_r($result);
          ?>
          <ol>
            <?php
            while($row_pin_query = $result_pin_query->fetch_assoc())
            {
              ?>
              <li>
                <?php echo "Name: ".$row_pin_query['Name'];?>
                <br>
                <?php echo "Description: ".$row_pin_query['Description'];?>
                <br>
                <?php
                $cat_query = "SELECT * FROM Categories where CatId = '".$row_pin_query['CatId']."' ";
                $result_cat_query = $conn->query($cat_query);
                $row_cat_query = $result_cat_query->fetch_assoc();
                echo "Category: ".$row_cat_query['CatName'];
                ?>
                <br>
                Image:<br>
                <img src="../pinupload/<?php echo $row_pin_query['Pic']?>">
                <br>
                <?php echo "Likes: ".$row_pin_query['Likes'];?><br>
                <?php echo "Shares: ".$row_pin_query['Share'];?>
                <br><br><br>
              </li>
              <?php
            }
            ?>
          </ol>
        </div>
        <div id="followers" class="tab-pane fade">

          <?php
          $sql="SELECT * FROM FollowUser WHERE UserId2='$uid'";
          $result = $conn->query($sql);
          ?>
          <h3> Follower ( <?php  echo $result->num_rows;?> )</h3>
          <?php 
          while($row_followers = $result->fetch_assoc())
          { 
            ?>

            <a href="../otherprofile/othprofile.php?id=<?php echo $row_followers['UserId1']; ?>"><?php 

              $follower_detail = "SELECT * from User where UserId = '".$row_followers['UserId1']."'"; 
              $result_follower_detail = $conn->query($follower_detail) ;
              $row_follower_detail = $result_follower_detail->fetch_assoc();
              ?>
              <div>
                <img style="height: 50px;width: 50px;border-radius: 50%;" src="../images/dp/<?php echo $row_follower_detail['Dp'];?>">
                <h3 style="display: inline;">
                  <?php
                  echo $row_follower_detail['UserName']; 
                  ?>
                </h3>
              </div>

            </a>

            <?php
          }
          ?>
        </div>
        <div id="following" class="tab-pane fade">

          <?php
          $sql_following="SELECT * FROM FollowUser WHERE UserId1='$uid'";
          $result_following = $conn->query($sql_following);
          ?>
          <h3> Following ( <?php  echo $result_following->num_rows;?> )</h3>
          <?php  
          while($row_following = $result_following->fetch_assoc())
          { 
            ?>

            <a href="../otherprofile/othprofile.php?id=<?php echo $row_following['UserId2']; ?>"><?php 

              $following_detail = "SELECT * from User where UserId = '".$row_following['UserId2']."'"; 
              $result_following_detail = $conn->query($following_detail) ;
              $row_following_detail = $result_following_detail->fetch_assoc();
              ?>
              <div>
                <img style="height: 50px;width: 50px;border-radius: 50%;" src="../images/dp/<?php echo $row_following_detail['Dp'];?>">
                <h3 style="display: inline;">
                  <?php
                  echo $row_following_detail['UserName']; 
                  ?>
                </h3>
              </div>

            </a>

            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </body>
  </html>