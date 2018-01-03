<?php
include("../../connection/conn.php");
session_start();
if($_SESSION['loggedin']==1 && $_SESSION['usertype']==1)
{
  ?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Datatables</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
<!-- jQuery library -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <!-- Latest compiled JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  var table = $(".asdfgh").DataTable({
    "order": [[1, "asc"]]
  });

  // Add event listener for opening and closing details
  $(".asdfgh tbody").on("click", "td.details-control", function() {
    var tr = $(this).closest("tr");
    var row = table.row(tr);
    // var bhangar = $(this).find('.uid').text();
    // console.log(bhangar);

var data = table.row( $(this).parents() ).data();/*parents('tr')*/
var userid = parseInt(data[1]);
console.log(userid);
        // alert($.type(userid) );
    $.ajax({
                type: 'POST',
                url: './table_details/view_user_details.php?userid='+userid,
                success: function(data) {
                    // alert(data);
                    $(".dikhadebhai").html(data);

                }
            });
      if (row.child.isShown()) {
      row.child.hide();
      tr.removeClass("shown");
    }
    else {
      row.child("<div><p class='dikhadebhai'></p></div>").show();
      tr.addClass("shown");
    }
  });
   $('.asdfgh tbody').on( 'click', "td.details-control", function () {
        
    } );
});
</script>
<style type="text/css">
  .content-wrapper {
    margin-left: 0!important;
}
</style>
</head>

<body >
 
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="./index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
<!--       Example DataTables Card -->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Pinstagram Users</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="asdfgh table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                <th></th>
                  <th>User Id</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Dp</th>
                  <th>Liked Pins</th>
                  <th>Number Of boards</th>
                  <th>Joining Date</th>
                  <th>helo</th>
                </tr>
              </thead>
              

             <!--  <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </tfoot> -->
              <tbody>
              <?php
                $query_user = "SELECT * FROM User";
                $result_user = $conn->query($query_user);
                while($row_user = $result_user->fetch_assoc()){
              ?>
                <tr bgcolor="<?php if($row_user['Status']==0){echo "red";}else{ echo "white"; } ?>">
                    <td class="details-control">+</td>
                    <td > <?php echo $row_user['UserId']; ?></td>
                    <td ><p><?php echo $row_user['UserName']; ?></p></td>
                    <td ><p><?php echo $row_user['Email']; ?></p></td>
                    
                    <td >
                   <p>
                    <img style="height: 50px;width: 50px;border-radius: 50%;" class="img-responsive" src="../../images/dp/<?php echo $row_user['Dp'];?>" onerror="this.src='../../images/dp/default.jpg'">    
                    </p>
                    </td>
                    
                    <td><p><?php echo $row_user['NumLikedPins']; ?></p></td>
                    <td><p><?php echo $row_user['NumBoards']; ?></p></td>
                    <td><p><?php echo $row_user['TimeStamp']; ?></p></td>
                    <?php if($row_user['Status']==1){ ?>
                    <td><p><a href="../blockuser.php?id=<?php echo $row_user['UserId']; ?>&setval=<?php echo 0; ?>">
                                        <i class="fa fa-ban" aria-hidden="true"></i><?php } ?></a></p></td>
                    <?php if($row_user['Status']==0){ ?>
                    <td style="background-color: white" ><p><a href="../blockuser.php?id=<?php echo $row_user['UserId']; ?>&setval=<?php echo 1; ?>">
                                        <i class="fa fa-unlock-alt" aria-hidden="true"></i><?php } ?></a></p></td>
                    
                </tr>

 <?php  } 
?>
            
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
   <!--  <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Pinstagram 2017</small>
        </div>
      </div>
    </footer> -->
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
            <a class="btn btn-primary" href="login.html">Logout</a>
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
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