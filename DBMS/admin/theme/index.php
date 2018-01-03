
<?php
include("../../connection/conn.php");
session_start();
if($_SESSION['loggedin']==1 && $_SESSION['usertype']==1)
{
  $num_user = "SELECT count(*) from User where Status=1";
 $result_num_user = $conn->query($num_user);
 $row_num_user = $result_num_user->fetch_assoc();
 // $tot_users = 99*$row_num_user['count(*)'];
 $tot_users = $row_num_user['count(*)'];

 $num_pin = "SELECT count(*) from Pin where Status=1";
 $result_num_pin = $conn->query($num_pin);
 $row_num_pin = $result_num_pin->fetch_assoc();
 // $tot_pins = 999*$row_num_pin['count(*)'];
 $tot_pins = $row_num_pin['count(*)'];

  $num_order = "SELECT count(*) from BuyPin";
 $result_num_order = $conn->query($num_order);
 $row_num_order = $result_num_order->fetch_assoc();
 // $tot_orders = 99*$row_num_order['count(*)'];
 $tot_orders = $row_num_order['count(*)'];

  $num_like = "SELECT sum(Likes) from Pin;";
 $result_num_like = $conn->query($num_like);
 $row_num_like = $result_num_like->fetch_assoc();
 // $tot_likes = 9999*$row_num_like['sum(Likes)'];
 $tot_likes = $row_num_like['sum(Likes)'];


  $most_liked = "SELECT * from Pin where Likes=(select max(Likes) from Pin)";
 $result_most_liked = $conn->query($most_liked);
 $row_most_liked = $result_most_liked->fetch_assoc();
 // $tot_likes = 9999*$row_num_like['sum(Likes)'];
 $most_liked_pin = $row_most_liked['Pic'];
 $most_liked_pin_id = $row_most_liked['PinId'];
 $uploaded_by = $row_most_liked['UserId'];
 $pin_name = $row_most_liked['Name'];
 $pin_desc = $row_most_liked['Description'];
 $pin_cat = $row_most_liked['CatId'];

 $name_user = "SELECT * from User where UserId = '$uploaded_by'";
 $result_name_user = $conn->query($name_user);
 $row_name_user = $result_name_user->fetch_assoc();
 $name_uploaded_by = $row_name_user['UserName'];

 $name_cat = "SELECT * from Categories where CatId = '$pin_cat'";
 $result_name_cat = $conn->query($name_cat);
 $row_name_cat = $result_name_cat->fetch_assoc();
 $name_uploaded_in = $row_name_cat['CatName'];


 $most_sold = "SELECT PinId from(select count(PinId) as most_sold,PinId from BuyPin where Status=1 group by PinId Order by most_sold desc limit 1) as most_sold_pin";
 $result_most_sold = $conn->query($most_sold);
 $row_most_sold = $result_most_sold->fetch_assoc();
 $most_sold_id = $row_most_sold['PinId'];


$res_most_sold_pin = $conn->query("call pin_info($most_sold_id,'*')");
$conn->next_result();
$row_most_sold_pin = $res_most_sold_pin->fetch_assoc();

$most_sold_pin_path = $row_most_sold_pin['Pic'];
$most_sold_uploaded_by = $row_most_sold_pin['UserId'];
$most_sold_pin_name = $row_most_sold_pin['Name'];
$most_sold_pin_desc = $row_most_sold_pin['Description'];
$most_sold_pin_price = $row_most_sold_pin['Price'];

$most_sold_pin_cat = $row_most_sold_pin['CatId'];

$res_cat_of_most_sold = $conn->query("call cat_from_pin($most_sold_pin_cat)");
 $conn->next_result();
$row_cat_of_most_sold = $res_cat_of_most_sold->fetch_assoc();

$res_user_of_most_sold = $conn->query("call user_from_pin($most_sold_pin_cat)");
 $conn->next_result();
$row_user_of_most_sold = $res_user_of_most_sold->fetch_assoc();


 $most_followed = "SELECT UserId2,followed as num_followers from (select count(*) as followed,UserId2 from FollowUser Group by UserId2 order by followed desc  limit 1) as most_followed";
 $result_most_followed = $conn->query($most_followed);
 $row_most_followed = $result_most_followed->fetch_assoc();
 $most_followed_id = $row_most_followed['UserId2'];
$num_followers = $row_most_followed['num_followers'];
$res_most_followed_user = $conn->query("call user_info($most_followed_id,'*')");
$conn->next_result();
$row_most_followed_user = $res_most_followed_user->fetch_assoc();

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

  <!-- Compiled and minified CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> -->

  <!-- Compiled and minified JavaScript -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> -->



  <script type="text/javascript">
    $(function() {
    function count($this){
        var current = parseInt($this.html(), 10);
        $this.html(++current);
        if(current !== $this.data('count')){
            setTimeout(function(){count($this)}, 10);
        }
    }        
  $(".counter").each(function() {
      $(this).data('count', parseInt($(this).html(), 10));
      $(this).html('0');
      count($(this));
  });
});
  </script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html"><p style="color: white;display: inline;">Pinstagram</p></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="user_table.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Users</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="pin_table.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Pins</span>
          </a>
        </li>
        
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="../../login/logout.php" class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out" style="color: white;"></i><p style="color: white;display: inline;">Logout</p></a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-md-3 mb-3">
          <div class="card text-white o-hidden h-10" style="background-color:#09192A!important;">
            <div class="card-body">
              <div class="float-right">
                <i class="fa fa-users fa-4x" aria-hidden="true"></i>
              </div>
              <div class="mr-5">
                     <p class="counter" style="font-size: 50px;"><?php echo $tot_users;?></p><p>Users</p>
              </div>
            </div>
            <!-- <a class="card-footer text-white clearfix small z-1" href="user_table.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a> -->
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card text-white o-hidden h-10" style="background-color:#09192A!important;">
            <div class="card-body">
              <div class="float-right">
                <i class="fa fa-table fa-4x" aria-hidden="true"></i>
              </div>
              <div class="mr-5"><p class="counter" style="font-size: 50px;"><?php echo $tot_pins;?></p><p>Pins</p></div>
            </div>
           <!--  <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a> -->
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card text-white o-hidden h-10" style="background-color:#09192A!important;">
            <div class="card-body">
              <div class="float-right">
                <i class="fa fa-shopping-bag fa-4x" aria-hidden="true"></i>
              </div>
              <div class="mr-5"><p class="counter" style="font-size: 50px;"><?php echo $tot_orders;?></p><p>Orders</p></div>
            </div>
           <!--  <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a> -->
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card text-white o-hidden h-10" style="background-color:#09192A!important;">
            <div class="card-body">
              <div class="float-right">
                <i class="fa fa-heart fa-4x" aria-hidden="true"></i>
              </div>
              <div class="mr-5"><p class="counter" style="font-size: 50px;"><?php echo $tot_likes;?></p><p>Likes</p></div>
            </div>
            <!-- <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a> -->
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-7">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> User Registrations</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12 my-auto">
                  <div id="reg_timeline">Pinstagram Categories Report</div>
                      <!-- <script src="js/jquery-2.1.4.js"></script> -->
                      <script src="../report_data/js/fusioncharts.js"></script>
                      <script src="../report_data/js/fusioncharts.charts.js"></script>
                      <script src="../report_data/js/themes/fusioncharts.theme.zune.js"></script>
                      <script src="../report_data/js/app_regtimeline_bargraph.js"></script>
                </div>
                <!-- <div class="col-sm-3 text-center my-auto">
                  <div class="h4 mb-0 text-primary">$34,693</div>
                  <div class="small text-muted">Money Spent</div>
                  <hr>
                  <div class="h4 mb-0 text-warning">$18,474</div>
                  <div class="small text-muted"></div>
                  <hr>
                  <div class="h4 mb-0 text-success">$16,219</div>
                  <div class="small text-muted">YTD Margin</div>
                </div> -->
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
          <!-- Card Columns Example Social Feed-->
          <div class="mb-0 mt-4">
            <i class="fa fa-newspaper-o"></i> The most... </div>
          <hr class="mt-2">
          <div class="card-columns">
            <!-- Example Social Card-->
            <div class="card mb-3">
             <p align="center" style="margin-left: 5px!important;margin-top: 5px!important;margin-bottom: 5px!important;">Most Liked Pin</p>
              <a href="#">
                <img class="card-img-top img-fluid w-100" src="../../pinupload/<?php echo $most_liked_pin; ?>" alt="">
              </a>
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="../../showpin/viewpin.php?pid=<?php echo $most_liked_pin_id; ?>"><?php echo $pin_name; ?></a></h6>
                <p class="card-text small"><?php echo $pin_desc; ?></p>
              </div>
              <hr class="my-0">
             <!--  <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-comment"></i>Comment</a>
                <a class="d-inline-block" href="#">
                  <i class="fa fa-fw fa-share"></i>Share</a>
              </div>
              <hr class="my-0"> -->
            <!--   <div class="card-body small bg-faded">
                <div class="media">
                  <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><a href="#">John Smith</a></h6>Very nice! I wish I was there! That looks amazing!
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a href="#">Like</a>
                      </li>
                      <li class="list-inline-item">·</li>
                      <li class="list-inline-item">
                        <a href="#">Reply</a>
                      </li>
                    </ul>
                    <div class="media mt-3">
                      <a class="d-flex pr-3" href="#">
                        <img src="http://placehold.it/45x45" alt="">
                      </a>
                      <div class="media-body">
                        <h6 class="mt-0 mb-1"><a href="#">David Miller</a></h6>Next time for sure!
                        <ul class="list-inline mb-0">
                          <li class="list-inline-item">
                            <a href="#">Like</a>
                          </li>
                          <li class="list-inline-item">·</li>
                          <li class="list-inline-item">
                            <a href="#">Reply</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="card-footer small text-muted">Posted by <?php echo $name_uploaded_by; ?> in <?php echo $name_uploaded_in; ?></div>
            </div>
            <!-- Example Social Card-->
            <div class="card mb-3">
            <p align="center" style="margin-left: 5px!important;margin-top: 5px!important;margin-bottom: 5px!important;">Most Followed User</p>
              <a href="../../otherprofile/othprofile.php?id=<?php echo $row_most_followed_user['UserId'] ?>">
                <img class="card-img-top img-fluid w-100" style="height: 200px;width: 200px;border-radius: 50%;" src="../../images/dp/<?php echo $row_most_followed_user['Dp'];?>" alt="">
              </a>
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="../../otherprofile/othprofile.php?id=<?php echo $row_most_followed_user['UserId'] ?>"><?php echo $row_most_followed_user['UserName'] ;?></a></h6>
                <p class="card-text small"><?php echo $num_followers ;?> followers !
                 
                </p>
              </div>
              <hr class="my-0">
             
              <!-- <div class="card-footer small text-muted">Posted 46 mins ago</div> -->
            </div>
            <!-- Example Social Card-->
            <div class="card mb-3">
             <p align="center" style="margin-left: 5px!important;margin-top: 5px!important;margin-bottom: 5px!important;">Most Sold Pin</p>
              <a href="#">
                <img class="card-img-top img-fluid w-100" src="../../pinupload/<?php echo $most_sold_pin_path ?>" alt="">
              </a>
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="../../showpin/viewpin.php?pid=<?php echo $most_sold_id?>"><?php echo $most_sold_pin_name; ?></a></h6>
                <p class="card-text small">
                  <?php echo $most_sold_pin_desc; ?>
                </p>
              </div>
              <hr class="my-0">
              
              <div class="card-footer small text-muted">Posted by <?php echo $row_user_of_most_sold['UserName']; ?> in <?php echo $row_cat_of_most_sold['CatName'] ?></div>
            </div> 
            <!-- Example Social Card-->
            
          </div>
          <!-- /Card Columns-->
        </div>
        <div class="col-lg-5">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i>Pin Distribution</div>
            <div class="card-body">
            <div id="catpins_piechart">Pinstagram Categories Report</div>
              <script src="../report_data/js/app_catpins_piechart.js"></script>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
          <!-- Example Notifications Card-->
          <!-- <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bell-o"></i> Feed Example</div>
            <div class="list-group list-group-flush small">
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>David Miller</strong>posted a new article to
                    <strong>David Miller Website</strong>.
                    <div class="text-muted smaller">Today at 5:43 PM - 5m ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>Samantha King</strong>sent you a new message!
                    <div class="text-muted smaller">Today at 4:37 PM - 1hr ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>Jeffery Wellings</strong>added a new photo to the album
                    <strong>Beach</strong>.
                    <div class="text-muted smaller">Today at 4:31 PM - 1hr ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <i class="fa fa-code-fork"></i>
                    <strong>Monica Dennis</strong>forked the
                    <strong>startbootstrap-sb-admin</strong>repository on
                    <strong>GitHub</strong>.
                    <div class="text-muted smaller">Today at 3:54 PM - 2hrs ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div> -->
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i>Categories Characteristics</div>
        <div class="card-body">
          <div id="catlikes_bargraphs">Pinstagram Categories Report</div>
          <script src="../report_data/js/fusioncharts.js"></script>
          <script src="../report_data/js/fusioncharts.charts.js"></script>
          <script src="../report_data/js/themes/fusioncharts.theme.zune.js"></script>
          <script src="../report_data/js/app_catlikes_bargraphs.js"></script>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
        </div>
      </div>
      <!-- Area Chart Example-->
      <!-- <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i>Categories Characteristics</div>
        <div class="card-body">
          <div id="catlikes_bargraphs">Pinstagram Categories Report</div>
          <script src="../report_data/js/fusioncharts.js"></script>
          <script src="../report_data/js/fusioncharts.charts.js"></script>
          <script src="../report_data/js/themes/fusioncharts.theme.zune.js"></script>
          <script src="../report_data/js/app_catlikes_bargraphs.js"></script>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div> -->
      <!-- Example DataTables Card-->
      <!--  -->
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Pinstagram 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../../login/logout.php">Logout</a>
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
    <!-- <script src="js/sb-admin-charts.min.js"></script> -->
  </div>
</body>

</html>
<?php }
else 
{
echo '<h1>Gotcha, thief!</h1>';
echo "<a href='../../login/login.php'><button>Log in first</button></a>";
}
?>