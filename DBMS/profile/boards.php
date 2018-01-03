<html>
<head>
  <title>
    Pinstagram|   </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="js/modernizr.custom.js"></script>
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>

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
      img{
        border-radius: 20px;
      }
      .centered-and-cropped{
      object-fit: cover;
    }
    </style>

  </head>
  <body style="background: white; color: black;font-family: Garamond;">
   <?php
   include '../connection/conn.php';
   session_start();
   $boardId=$_GET['boardId'];
   include '../navbar.php';
   $sql="SELECT * FROM Board WHERE BoardId='$boardId'";
   $result=$conn->query($sql);
   $row=$result->fetch_assoc();
   ?>
   <?php
   $pin_id_query = "SELECT * from FollowBoard WHERE BoardId = '".$boardId."' ";
   $result_pin_id_query = $conn->query($pin_id_query);
   $num=$result_pin_id_query->num_rows;
   ?>
   <div class="container-fluid">
    <div class="row" style="height: 250px;">
      <div class="col-xs-7">
        <div class="pull-left">
          <h1 style="position: absolute; left: 150px; top: 60px; font: 400 50px/1.3 'Berkshire Swash', Helvetica, sans-serif;"> <strong> <?php echo $row['BoardName'];?> </strong></h1>
          <h5 style=" position: absolute;left:180px; top: 140px; color: #707070"><?php echo $num." Pins"?></h5>
        </div>
          <!-- <div class="pull-right" style="margin-top: 20px">
            <a href="editprofile.php"> <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a><br>
            <a href="../login/logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> </a><br>
          </div> -->


        </div>
        <div style="position: absolute; top: 100px; right: 100px; height: 200px;">

          <img style="height: 220px;width: 220px;border-radius: 50%;" class="centered-and-cropped" src="../images/dp/<?php echo $_SESSION['profile_picture'];?>">

        </div>

      </div>

      <div class="container">
        <ul class="grid effect-6" id="grid">
          <?php
          while($row_pin_id_query = $result_pin_id_query->fetch_assoc())
          {
            ?>
            <?php
            $board_pin_query = "SELECT * FROM BoardPins WHERE PinId = '".$row_pin_id_query['PinId']."'";
            $result_board_pin_query = $conn->query($board_pin_query);
            $row_board_pin_query = $result_board_pin_query->fetch_assoc();
            ?>
            <li style="padding: 0px; margin: 0px;">
              <a href="viewboardpin.php?pid=<?php echo $row_board_pin_query['PinId']?>">
               <div class="well"> <center>
                 <img src="../boards/<?php echo $row_board_pin_query['Pic'] ?>" style="width: 20em;" >
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
</body>
</html>
