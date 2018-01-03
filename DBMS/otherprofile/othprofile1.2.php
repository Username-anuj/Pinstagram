<?php
include '../connection/conn.php';
session_start();
include '../navbar.php';
$_SESSION['uid']=$_GET['id'];
$uid=$_SESSION['uid'];
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
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
      top: 60px;
    }
    #unfollow-button{
      color: #ffffff;
      font-family: "Helvetica";
      font-size: 10pt;
      background-color: #b30000;
      border: 1px solid;
      border-color: #b30000;
      border-radius: 3px;
      width: 100px;
      height: 30px;
      /*position: absolute;  */
      top: 40px;
    }
    .rows {
      column-width: 20em;
      column-gap: 10px;

    }
    .item {
      display: inline-block;
    }
      <script src="js/modernizr.custom.js"></script>
<link rel="stylesheet" type="text/css" href="css/default.css" />
  <link rel="stylesheet" type="text/css" href="css/component.css" />
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
          if($_SESSION['n']===1)
          {
            ?>
            <a href="followuser.php"> <button id="follow-button">+ Follow</button> </a><br>
            <?php
          }
          else if($_SESSION['n']===0)
          {
            ?>
            <a href="followuser.php"> <button id="unfollow-button">&#x2714; Following </button> </a><br>
            <?php
          }?>

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
        <div class="row">
          <div class="rows">
            <?php
            $sql = "SELECT * from Pin where UserId = '$uid'";
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
              <div class="item">
              <a href="../showpin/viewpin.php?pid=<?php echo $pid?>">
              <div class="well"> 
                <img src="<?php echo "../pinupload/".$Pic?>" class="img-responsive"><br>
                <center><br>
                 <br>
                 <b><?php echo $Title?></b><br><?php echo $Description?> 
               </center>
             </div>
             </a>
           </div>
           
           <?php
         }
         ?>
       </div>
     </div>
   </div>
   <div id="followers" class="tab-pane fade">
    <?php
    $sql="SELECT * FROM FollowUser WHERE UserId2='$uid'";
    $result = $conn->query($sql);
    ?>
    <h3> Followers ( <?php  echo $result->num_rows;?> )</h3>
    <?php 
    while($row = $result->fetch_assoc())
    { 
      ?>

      <a href="../otherprofile/othprofile.php?id=<?php echo $row['UserId1']; ?>"><?php 

        $sql1 = "SELECT * from User where UserId = '".$row['UserId1']."'"; 
        $result1 = $conn->query($sql1) ;
        $row1 = $result1->fetch_assoc();
        ?>
        <div>
          <img style="height: 50px;width: 50px;border-radius: 50%;" src="../images/dp/<?php echo $row1['Dp'];?>">
          <h3 style="display: inline;">
            <?php
            echo $row1['UserName']; 
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
    $sql="SELECT * FROM FollowUser WHERE UserId1='$uid'";
    $result = $conn->query($sql);
    ?>
    <h3> Following ( <?php  echo $result->num_rows;?> )</h3>
    <?php  
    while($row = $result->fetch_assoc())
    { 
      ?>

      <a href="../otherprofile/othprofile.php?id=<?php echo $row['UserId2']; ?>"><?php 

        $sql2 = "SELECT * from User where UserId = '".$row['UserId2']."'"; 
        $result2 = $conn->query($sql2) ;
        $row2 = $result2->fetch_assoc();
        ?>
        <div>
          <img style="height: 50px;width: 50px;border-radius: 50%;" src="../images/dp/<?php echo $row2['Dp'];?>">
          <h3 style="display: inline;">
            <?php
            echo $row2['UserName']; 
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
