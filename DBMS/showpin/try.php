
<?php
include '../connection/conn.php';
session_start();
$_GET['pid']=1;
$pid=$_GET['pid'];
$seen=$_GET['seen'];
$userid=$_SESSION['myid'];
$sql="SELECT * FROM Pin WHERE PinId='$pid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$Pic=$row["Pic"];
$Title=$row["Name"];
$Description=$row["Description"];
$cid=$row["CatId"];
$usid=$row["UserId"];
$download=$row["Download"];
$sql="SELECT UserId FROM LikePin WHERE PinId='$pid'";
$result = $conn->query($sql);
$numLikes=$result->num_rows;
// print_r($result);
$n=1;
while($row = $result->fetch_assoc())
{
  // print_r($row);
  // echo $_SESSION['myid'];
  $uid=$row["UserId"];
  // echo $uid;
  if($uid==$_SESSION['myid'])
  {
    $n=0;
  }
}
function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);
  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;
  $string = array(
    'y' => 'year',
    'm' => 'month',
    'w' => 'week',
    'd' => 'day',
    'h' => 'hour',
    'i' => 'minute',
    's' => 'second',
    );
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }
  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}
if(isset($seen)) 
{
  $sql = "UPDATE Notification SET Seen=1 WHERE UserId='$userid' AND PinId='$pid'";
  $result=$conn->query($sql);
}
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pinstagram | Admin</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- Jquery latest -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
      .btn{
        background-color: transparent; 
        color: #337ab7; 
        font-size: 100%; 
        padding:0px; 
        border:none
      }

    .btn:hover{
    color:#23527c;
    text-decoration: underline;
    background: transparent;
      }

    </style>

</head>

<div class="content-wrapper">

  <div class="container-fluid">

    <hr class="mt-2">

    <div class="card-columns">
      <!-- Example Social Card-->
      <div class="card mb-3" >
      
        <a href="#">
          <img src="../pinupload/<?php echo $Pic; ?>" alt="" >
        </a>
        <div class="card-body">
          <h6 class="card-title mb-1"><a href="#"><?php echo $Title ?></a></h6>
          <?php
        $sql1 = "SELECT * FROM User WHERE UserId='$usid'";
        $result1 = $conn->query($sql1);
        $row1=$result1->fetch_assoc();
                        $uname=$row1["UserName"];
                        $dp=$row1["Dp"];
                        ?>
          <p class="card-text small"><?php echo $Description ?> <br>
             <div class="card-body small bg-faded">
                <div class="media" id="comm">
                  <img class="d-flex mr-3" src="../images/dp/<?php echo $dp;?>" style="height: 45px; width: 45px; border-radius:50%" alt="">
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><a href="../otherprofile/othprofile.php?id=<?php echo $usid?>"><?php echo $uname?></a></h6> 
                    <!-- Follow -->
                  </div>
                </div>
              </div>
          </p>
        </div>

        <hr class="my-0">
        <div class="card-body py-2 small">
          <a class="mr-3 d-inline-block" href="likepin.php?n=<?php echo $n?>&pid=<?php echo $pid ?>">
            <?php
            if($n==1)
            {
              ?>
              <i class="fa fa-heart-o" aria-hidden="true" style="color: #ff4d4d
              "></i>
              <?php
            }
            else
            {
              ?>
              <i class="fa fa-heart" aria-hidden="true" style="color: #ff4d4d
              "></i>
              <?php
            }
            ?></a>
             <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myLikeModal" id="likebutton"><?php
        if(!empty($numLikes))
        {
          echo $numLikes." Likes";
        } 
        else
        {
          echo "Like";
        }
        ?></button>



        <div id="myLikeModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> People</h4>
              </div>
              <div class="modal-body">
                  <?php
                  $likequery = "SELECT * from LikePin where PinId = '$pid'";
                  $resultlikequery = $conn->query($likequery);
                  while($rowlikequery = $resultlikequery->fetch_assoc())
                  {
                    $userId=$rowlikequery['UserId'];
                    $userQuery="SELECT * FROM User WHERE UserId='$userId'";
                    $resultUser=$conn->query($userQuery);
                    while($rowUser=$resultUser->fetch_assoc())
                    {
                      $userName=$rowUser['UserName'];
                      ?>


                      <a href="../otherprofile/othprofile.php?id=<?php echo $userId?>"> <?php echo $userName?> </a> <br>


                      <?php
                    }
                  }
                  ?>
              </div>
              <div class="">

              </div>

            </div>
          </div>
        </div>


        


 
            <a class="mr-3 d-inline-block" href="#comm">
              <i class="fa fa-fw fa-comment"></i>Comment</a>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mySaveModal">
           <i class="fa fa-paperclip" aria-hidden="true"></i> Save to boards</a> 
           </button>

           <div id="mySaveModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Save To Boards</h4>
              </div>
              <div class="modal-body">
                <form action="savetoboards.php" method="post" enctype="multipart/form-data">
                  <?php
                  $board_query = "SELECT * from Board where UserId = '".$_SESSION['myid']."'";
                  $result_board_query = $conn->query($board_query);
                  while($row_board_query = $result_board_query->fetch_assoc())
                  {
                    $Bid=$row_board_query['BoardId'];
                    $Bname=$row_board_query['BoardName'];
                    ?>

                    <input type="hidden" name="pid" value="<?php echo $pid ?>">

                    <input type="hidden" name="ID" value="<?php echo $Bid ?>">

                    <button type="submit" class="btn btn-info btn-lg" style="width:100%; background: white; color:black"> <?php echo $Bname?> </button> <br> <br>



                    <?php
                  }
                  ?>

                </form>

              </div>
              <div class="">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#CreateNewBoard" style="background-color: #f2f2f2; color: #23527c; border-color: #e6e6e6" data-dismiss="modal">  Create New Board  </button>

              </div>

            </div>
          </div>
        </div>
        <br>
        <br>

        <div id="CreateNewBoard" class="modal fade" role="dialog" tabindex="-1">
          <div class="modal-dialog">


            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title"> Save To Boards</h4>
              </div>
              <div class="modal-body">
                <form action="createboard.php" method="post" enctype="multipart/form-data">
                  <input type="text" name="Boardnmd">
                  <input type="hidden" name="pid" value="<?php echo $pid ?>"><br> <br>

                  <button type="submit" class="btn btn-info btn-lg"> Create  </button> 

                </form>

              </div>
              <div class="modal-footer">

              </div>

            </div>
          </div>
        </div>




            <a class="mr-3 d-inline-block" href="reportpin.php?pid=<?php echo $pid ?>">
           <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Report Pin</a>



           <?php if($download==1)
                      {
                        ?>


           <a class="mr-3 d-inline-block" href="../pinupload/<?php echo $Pic ?>" download>
           <i class="fa fa-download" aria-hidden="true"> </i> Download Pin
           </a>

           <?php
                        }
                        ?>



<!--Module Remaining-->
           <a class="mr-3 d-inline-block" href="#">
           <i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy This Pin</a>

           <!--End Of Module-->





              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myShareModal">
          <i class="fa fa-fw fa-share"></i>Share</a>
        </button>

        <!-- Modal -->
        <div id="myShareModal" class="modal fade" role="dialog" tabindex="-1">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <?php echo $Title?></h4>
              </div>
              <div class="modal-body">

                <img src="../pinupload/<?php echo $Pic; ?>" style="width: 35em"><br>
                <div class="form-group">
                  Add Description:
                  <form id="myFormId">
                    <textarea id="nameValidation" onkeyup="hojabhai()" class="form-control" name="desc" placeholder="Enter the description"> </textarea>
                    <script>
                      var desc='';
                      function hojabhai(){
                        desc = $('#myFormId').serialize();
                        $('#lejabhai').attr("href","sharepin.php?pid=<?php echo $pid ?>&"+desc);
                      }
                    </script>
                  </form>
                </div>
              </div>
              <div class="">
                <a id="lejabhai" href="sharepin.php?pid=<?php echo $pid ?>">
                  <button type="button" class="btn btn-default">Share Pin</button>
                </a>
              </div>

            </div>
          </div>
        </div>


                

              </div>
              <hr class="my-0">
              <div class="card-body small bg-faded">
                <div class="media" id="comm">
                  <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><a href="#">John Smith</a></h6>Very nice! I wish I was there! That looks amazing!
                  </div>
                </div>
              </div>
              <div class="card-footer small text-muted">Posted 32 mins ago</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/popper/popper.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Page level plugin JavaScript-->
      <script src="vendor/chart.js/Chart.min.js"></script>
      <script src="vendor/datatables/jquery.dataTables.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin.min.js"></script>
      <!-- Custom scripts for this page-->
      <script src="js/sb-admin-datatables.min.js"></script>
      <script src="js/sb-admin-charts.min.js"></script>
    </body>

    </html>
