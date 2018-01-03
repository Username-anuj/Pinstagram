<?php 
include '../connection/conn.php';
session_start();
$_SESSION['uid']=$_GET['id'];
$uid=$_SESSION['uid'];
$seen=$_GET['seen'];
$userid=$_SESSION['myid'];
if($uid==$_SESSION['myid'])
{
	header('location: ../profile/pro.php');
}
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
$n=1;
if ($result->num_rows > 0) 
{
  while($row = $result->fetch_assoc()) 
  {
    $uid1=$row["UserId1"];
    if($uid1==$_SESSION['myid']) 
    {
      $n=0;
    }
  }
}
if(isset($seen)) 
{
  $sql = "UPDATE Notification SET Seen=1 WHERE UserId='$userid' AND UserId2='$uid'";
  $result=$conn->query($sql);
}
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Pinstagram | OtherProfile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style type="text/css">
      #follow-button {
        color: #b30000;
        font-family: "Helvetica";
        font-size: 10pt;
        background-color: #ffffff;
        border: 1px solid;
        border-color: #b30000;
        border-radius: 3px;
        width: 150px;
        height: 40px;
        position: absolute;
        top: 100px;
      }
      #unfollow-button{
        color: #ffffff;
        font-family: "Helvetica";
        font-size: 10pt;
        background-color: #b30000;
        border: 1px solid;
        border-color: #b30000;
        border-radius: 3px;
        width: 150px;
        height: 40px;
        position: relative;  
        top: 100px;
      }
      .well{
        border-color: white;
        background: white;
        border-radius: 20px;
        color: black;
      }
      .well:hover{
        background: #e3e3e3;
        border-radius: 20px;
        color: black;
      }
      .nav-tabs{
        border: none;
      }
      .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        border: none;
      }
      .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover, .nav-tabs>li>a:hover{
        background: #e3e3e3;
        border-radius: 60px;
      }
      .nav-tabs>li>a{
        color:#b3b3b3;
      }
      .centered-and-cropped{
        object-fit: cover;
      }
      a:hover{
        text-decoration: none;
      }

    </style>
    <link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
    <script src="js/modernizr.custom.js"></script>
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/comp.css" />
  </head>
<body style="background: white; color: black; font-family: Garamond;">
  <!-- <i class="fa fa-pencil" aria-hidden="true"></i> -->

  <?php include '../navbar.php'; ?>


  <div class="container-fluid">
    <div class="row"  style="height: 250px;">
      <div class="col-xs-7">
        <div class="pull-left">
          <h1 style="position: absolute; left: 150px; top: 60px; font: 400 50px/1.3 'Berkshire Swash', Helvetica, sans-serif;"> <strong> <?php echo $uname;?></strong></h1>
        </div>
        <div class="pull-right col-xs-3">
          <?php
          if($n==1)
          {
            ?>
            <button id="follow-button"> <h4 style="padding:0px; margin:0px; font-family: Garamond;"> <a href="followuser.php?n=<?php echo $n?>" style="color:#b30000; font-family: Garamond;"> <strong>+ Follow</strong> </a> </h4></button>
            <?php
          }
          else if($n==0)
          {
            ?>
            <!-- <a href="followuser.php?n=<?php //echo $n?>"> <button id="unfollow-button">&#x2714; Following </button> </a><br> -->
            <button id="unfollow-button"> <h4 style="padding:0px; margin:0px;"> <a href="followuser.php?n=<?php echo $n?>" style="color:white; font-family: Garamond;"> <strong>&#x2714; Following</strong> </a> </h4></button>
            <?php
          }?>
          <div class="">
            <a href="../messaging/chat.php?uid=<?php echo $uid?>" style="color:#b30000; font-family: Garamond;"> <strong><i class="fa fa-comments fa-3x"></i>
</strong> </a>        </div>
        </div>
       

      </div>
      <div class="col-xs-2" style="position: absolute; top: 100px; right: 100px; height: 200px;">

        <img style="height: 220px;width: 220px;border-radius: 50%;" class="centered-and-cropped" src="../images/dp/<?php echo $dp;?>">

      </div>
      <?php 
      $sql="SELECT * FROM FollowUser WHERE UserId2='$uid'";
      $result = $conn->query($sql); 
      $numfollowers=$result->num_rows;
      $sql="SELECT * FROM FollowUser WHERE UserId1='$uid'";
      $result = $conn->query($sql);
      $numFollowing=$result->num_rows;
      ?>
      
    </div>

    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#pins"><strong> Pins</strong></a></li>
      <li><a data-toggle="tab" href="#followers"><strong></style>Followers(<?php echo $numfollowers?>)</strong></a></li>
      <li><a data-toggle="tab" href="#following"><strong>Following (<?php echo $numFollowing?>)</strong></a></li>
    </ul>

    <div class="tab-content">
      <div id="pins" class="tab-pane fade in active">
        <div class="container">
          <ul class="grid effect-1" id="grid">
           
            <?php
            $sql = "SELECT * from Pin where UserId = '$uid'";
            $result = $conn->query($sql);
            if($result->num_rows>0)
            {
            ?>
            <?php
            while($row = $result->fetch_assoc())
            {
             $pid=$row["PinId"];
             $Pic=$row["Pic"];
             $Title=$row["Name"];
             $Description=$row["Description"];
             ?>
             <li>
              <a href="../showpin/viewpin.php?pid=<?php echo $pid?>">
                <div class="well"> 
                  <img src="<?php echo "../pinupload/".$Pic?>" style="width: 20em; border-radius: 20px;">
                  <center>
                   <b><?php echo $Title?></b><br><?php echo $Description?> 
                 </center>
               </div>
             </a>
           </li>           
           <?php
         }
       }
       else
       {
         ?>
         <li></li>
       <?php 
     }
     ?>
       </ul>
     </div>
     
     <script src="js/masonry.pkgd.min.js"></script>
     <script src="js/imagesloaded.js"></script>
     <script src="js/classie.js"></script>
     <script src="js/AnimOnScroll.js"></script>
     <script>
      new AnimOnScroll( document.getElementById( 'grid' ), {
        minDuration : 0.4,
        maxDuration : 0.7,
        viewportFactor : 0.2
      } );
    </script>
  </div>
  <div id="followers" class="tab-pane fade">
   <div class="container">
    <ul class="grid effect-1" id="grid">
   

      <?php
      $sql="SELECT * FROM FollowUser WHERE UserId2='$uid'";
      $result = $conn->query($sql);
      // echo $sql;
      // print_r($result);
      // echo "<br>";
      ?>
      <?php 
      while($row_followers = $result->fetch_assoc())
      { 
       // echo "hi";
       // echo $row_followers['UserId1'];
       // echo "hi";
       ?>
       <li>
        <?php 
        // echo "hi";
        // echo $row_followers['UserId1'];
        $follower_detail = "SELECT * from User where UserId = '".$row_followers['UserId1']."'"; 
        $result_follower_detail = $conn->query($follower_detail) ;
        $row_follower_detail = $result_follower_detail->fetch_assoc();
        $numPins="SELECT * FROM Pin WHERE UserId='".$row_followers['UserId1']."'"; 
        $resNumPins=$conn->query($numPins);
        $noPins=$resNumPins->num_rows;
        $numFollow="SELECT * FROM FollowUser WHERE UserId2='".$row_followers['UserId1']."'"; 
        $resNumFollow=$conn->query($numFollow);
        $noFollow=$resNumFollow->num_rows;
        ?>
        <a href="../otherprofile/othprofile.php?id=<?php echo $row_followers['UserId1']; ?>">

          <!-- hi -->
          <div class="well" style="width: 300px;height: 300px;">
            <center>
              <img style="height: 230px;width: 230px;border-radius: 50%;" class="centered-and-cropped" src="../images/dp/<?php echo $row_follower_detail['Dp'];?>">
              <h3 style="display: inline;">
                <?php
                echo $row_follower_detail['UserName']; 
                ?>
                <br>
                <!-- HELLO!! -->

              </h3>

              <?php echo $noPins." Pins "?> <strong> &middot; </strong>
              <?php echo $noFollow." Followers"?>
            </center>
          </div>

        </a>
      </li>

      <?php
    }
    ?>
  </ul>
</div>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/classie.js"></script>
<script src="js/AnimOnScroll.js"></script>
<script>
  new AnimOnScroll( document.getElementById( 'grid' ), {
    minDuration : 0.4,
    maxDuration : 0.7,
    viewportFactor : 0.2
  } );
</script>
</div>
<div id="following" class="tab-pane fade">

 <div class="container">
  <ul class="grid effect-1" id="grid">

    <?php
    $sql="SELECT * FROM FollowUser WHERE UserId1='$uid'";
    $result = $conn->query($sql);
      // echo $sql;
    ?>
    <?php 
    while($row_followers = $result->fetch_assoc())
    { 
        // echo $row_followers['UserId2'];
      ?>
      <li>
        <a href="../otherprofile/othprofile.php?id=<?php echo $row_followers['UserId2']; ?>">
          <?php 
           // echo "Hi";
          $follower_detail = "SELECT * from User where UserId = '".$row_followers['UserId2']."'"; 
            // echo $row_followers['UserId2'];
          $result_follower_detail = $conn->query($follower_detail) ;
          $row_follower_detail = $result_follower_detail->fetch_assoc();
          $numPins="SELECT * FROM Pin WHERE UserId='".$row_followers['UserId2']."'"; 
          $resNumPins=$conn->query($numPins);
          $noPins=$resNumPins->num_rows;
          $numFollow="SELECT * FROM FollowUser WHERE UserId2='".$row_followers['UserId2']."'"; 
          $resNumFollow=$conn->query($numFollow);
          $noFollow=$resNumFollow->num_rows;
          ?>
          <div class="well" style="width: 300px;height: 300px;">
            <center>
              <img style="height: 230px;width: 230px;border-radius: 50%;" class="centered-and-cropped" src="../images/dp/<?php echo $row_follower_detail['Dp'];?>">
              <h3 style="display: inline;">
                <?php
                echo $row_follower_detail['UserName']; 
                ?>
                <br>

              </h3>

              <?php echo $noPins." Pins "?> <strong> &middot; </strong>
              <?php echo $noFollow." Followers"?>
            </center>
          </div>

        </a>
      </li>

      <?php
    }
    ?>
  </ul>
</div>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/classie.js"></script>
<script src="js/AnimOnScroll.js"></script>
<script>
  new AnimOnScroll( document.getElementById( 'grid' ), {
    minDuration : 0.4,
    maxDuration : 0.7,
    viewportFactor : 0.2
  } );
</script>
</div>
</div>
</div>
</body>
</html>
