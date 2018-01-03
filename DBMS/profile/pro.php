<?php
include '../connection/conn.php';
session_start();
$userid = $_SESSION['myid'];
$pic=[];
$sql="SELECT * FROM User WHERE UserId='$userid'";
$result=$conn->query($sql);
$row = $result->fetch_assoc();
if($row['Type']==2)
{
  header('location: businesspro.php');
}
// include '../navbar.php';
?>
<html>
<head>
  <title>
    Pinstagram| View Profile  </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="js/modernizr.custom.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/comp.css" />
    <style type="text/css">
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
  </head>
  <body style="background: white; color: black;font-family: Garamond;">
    <?php include '../navbar.php'; ?>
    <div class="container-fluid">
      <div class="row" style="height: 250px;">
        <div class="col-xs-7">
          <div class="pull-left">
            <h1 style="position: absolute; left: 150px; top: 60px; font: 400 50px/1.3 'Berkshire Swash', Helvetica, sans-serif;"> <strong> <?php echo $_SESSION['whoami'];?> </strong></h1>
          </div>
          <div class="pull-right" style="margin-top: 20px">
            <a href="editprofile.php"> <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a><br>
            <a href="../login/logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> </a><br>
          </div>


        </div>
        <div style="position: absolute; top: 100px; right: 100px; height: 200px;">

          <img style="height: 220px;width: 220px;border-radius: 50%;" class="centered-and-cropped" src="../images/dp/<?php echo $_SESSION['profile_picture'];?>">

        </div>
        <?php 
        $sql="SELECT * FROM FollowUser WHERE UserId2='".$_SESSION['myid']."'";
        $result = $conn->query($sql); 
        $numfollowers=$result->num_rows;
        $sql="SELECT * FROM FollowUser WHERE UserId1='".$_SESSION['myid']."'";
        $result = $conn->query($sql);
        $numFollowing=$result->num_rows;
        ?>

      </div>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#pins"><strong>Pins</strong></a></li>
        <li><a data-toggle="tab" href="#boards"><strong>Boards</strong></a></li>
        <li><a data-toggle="tab" href="#followers"><strong>Followers (<?php echo $numfollowers?>)</strong></a></li>
        <li><a data-toggle="tab" href="#following"><strong>Following (<?php echo $numFollowing?>)</strong></a></li>
      </ul>
      
      <div class="tab-content">

       <div id="pins" class="tab-pane fade in active">
        <div class="container">
          <ul class="grid effect-1" id="grid">

            <li> <a href="../pinupload/pin.php">
             <div class="well"> <center>
              <img src="pluspin.jpg" style="width: 20em; border-radius: 20px;"><br>

              <b> Upload Pin</b>
            </center>
          </div>
        </a></li>

        <?php
        $sql = "SELECT * from Pin where UserId = '".$_SESSION['myid']."'";
        $result = $conn->query($sql);
        ?>
        <?php
        while($row = $result->fetch_assoc())
        {
         $pid=$row["PinId"];
         $Pic=$row["Pic"];
         $Title=$row["Name"];
         $Description=$row["Description"];
         ?>
         <li style="padding:0px; margin: 0px;">
          <a href="../showpin/viewpin.php?pid=<?php echo $pid?>">
            <div class="well"> 
              <center>
                <img src="<?php echo "../pinupload/".$Pic?>" style="width: 20em; border-radius: 20px;"><br>

                <b><h4><?php echo $Title?></h4></b><?php echo $Description?> 
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

<div id="boards" class="tab-pane fade">
  <div class="container">
    <ul class="grid effect-1" id="grid">

      <li style="padding:0px; margin: 0px;"> <a href="../boards/board.php">
       <div class="well" style="width:350px;height: 300px;"> <center>
        <img src="plusboard.jpg" style="width: 300px; height: 200px; border-radius: 20px;"><br>

        <b style="font-size: 20px;">Create Board</b>
      </center>
    </div>
  </a></li>


  <!-- FOR BOARDS -->
  <?php
  $board_query = "SELECT * from Board where UserId = '".$_SESSION['myid']."'";
  $result_board_query = $conn->query($board_query);
        // print_r($result);
  ?>

  <?php
  while($row_board_query = $result_board_query->fetch_assoc())
  {
    $bdid=$row_board_query['BoardId'];
      // echo $bdid;
    $i=0;
    $pinBoardQuery="SELECT * FROM FollowBoard WHERE BoardId=$bdid";
      // echo $pinBoardQuery;
    $resPinBoardQuery=$conn->query($pinBoardQuery);
    $num=$resPinBoardQuery->num_rows;
    if($resPinBoardQuery->num_rows>0)
    {
      while ($rowPinBoardQuery = $resPinBoardQuery->fetch_assoc())
      {
        $pid=$rowPinBoardQuery['PinId'];
          // echo $pid;
        $pinQuery="SELECT * FROM BoardPins WHERE PinId='$pid'";
        $resPinQuery=$conn->query($pinQuery);
        $rowPinQuery=$resPinQuery->fetch_assoc();
        $pic[$i++]="../boards/".$rowPinQuery['Pic'];
          // echo $pic[$i-1];
      }
    }
    if($i==0)
    {
      $i++;
    }
    for($j=$i;$j<6;$j++)
    {
      $pic[$j]="default.png";
    }

    ?>
    <li style="padding:0px; margin: 0px;">
      <a href="boards.php?boardId=<?php echo $row_board_query['BoardId']; ?>" style="color:black">
        <div class="well" style="width:350px;height: 300px; position: relative; padding:20px">
          <center>
            <div class="image1" style="width:100px;height:100px;padding:0px;margin:1px; position: absolute; top:15px; left:15px; border-top-left-radius: 20px;">
              <img src="<?php echo $pic[0]?>" class="centered-and-cropped" style="width:100px;height:100px;padding:0px;margin:1px; border-top-left-radius: 20px;">
            </div>
            <div class="image2" style="width:100px;height:150px;padding:0px;margin:1px; position:absolute;top:15px; left:15px; transform: translateX(100px);">
              <img src="<?php echo $pic[1]?>" class="centered-and-cropped" style="width:100px;height:150px;padding:0px;margin:1px;">
            </div>
            <div class="image3" style="width:100px;height:100px;padding:0px;margin:1px; position:absolute;top:15px; left:15px; transform: translateX(200px); border-top-right-radius: 20px;">
              <img src="<?php echo $pic[2]?>" class="centered-and-cropped" style="width:100px;height:100px;padding:0px;margin:1px; border-top-right-radius: 20px;">
            </div>
            <div class="image4" style="width:100px;height:100px;padding:0px;margin:1px; position:absolute;top:15px; left:15px; transform: translateY(100px); border-bottom-left-radius: 20px;">
              <img src="<?php echo $pic[3]?>" class="centered-and-cropped" style="width:100px;height:100px;padding:0px;margin:1px;  border-bottom-left-radius: 20px;">
            </div>
            <div class="image5" style="width:100px;height:50px;padding:0px;margin:1px; position:absolute;top:15px; left:15px; transform: translate(100px,150px);">
              <img src="<?php echo $pic[4]?>" class="centered-and-cropped" style="width:100px;height:50px;padding:0px;margin:1px;">
            </div>
            <div class="image6" style="width:100px;height:100px;padding:0px;margin:1px; position:absolute;top:15px; left:15px; transform: translate(200px,100px); border-bottom-right-radius: 20px;">
              <img src="<?php echo $pic[4]?>" class="centered-and-cropped" style="width:100px;height:100px;padding:0px;margin:1px; border-bottom-right-radius: 20px;">
            </div>
            <!-- <br> -->

            <h3 style="position: absolute; top: 210px; width: 90%"><?php echo $row_board_query['BoardName']; ?></h3>
            <h6 style="position: absolute; top: 250px; width: 90%; color: #808080;"> <?php echo $num?> Pins </h6>
            <a href="../boards/editboard.php?bid=<?php echo $row_board_query['BoardId'];?>"><i class="fa fa-pencil" aria-hidden="true" style="position:absolute; bottom: 10px; right: 10px; color: #4d4d4d;"></i></a>

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
<!-- FOR BOARDS --> 
</div>
<div id="followers" class="tab-pane fade">
  <div class="container">
    <ul class="grid effect-1" id="grid">

      <?php
      $sql="SELECT * FROM FollowUser WHERE UserId2='".$_SESSION['myid']."'";
      $result = $conn->query($sql);
      ?>
      <?php 
      while($row_followers = $result->fetch_assoc())
      { 
        ?>
        <li style="padding:0px; margin: 0px;">
          <a href="../otherprofile/othprofile.php?id=<?php echo $row_followers['UserId1']; ?>"><?php 

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
<div id="following" class="tab-pane fade">
  <div class="container">
    <ul class="grid effect-1" id="grid">

      <?php
      $sql="SELECT * FROM FollowUser WHERE UserId1='".$_SESSION['myid']."'";
      $result = $conn->query($sql);
      ?>
      <?php 
      while($row_followers = $result->fetch_assoc())
      { 
        ?>
        <li style="padding:0px; margin: 0px;">
          <a href="../otherprofile/othprofile.php?id=<?php echo $row_followers['UserId2']; ?>"><?php 

            $follower_detail = "SELECT * from User where UserId = '".$row_followers['UserId2']."'"; 
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