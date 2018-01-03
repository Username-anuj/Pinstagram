<!--NavBar Start-->
<?php $userid = $_SESSION['myid']; ?>

<nav class="navbar navbar-inverse" style=" background-color: #000033!important;
    border-color: #E7E7E7!important;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="../index.php">Pinstagram</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
         <?php if($_SESSION['loggedin'] != 1){ ?>
         <li><a href="../index.php">Home</a></li>
         <li><?php include('../search/index.php');?></li>
         <li><a href="../signup/signup.php">SIGN UP</a></li>
         <li><a href="../login/login.php">LOG IN </a></li>
         <?php } ?>
         <?php if($_SESSION['loggedin']==1){ ?>
        <!--  <li><a href="../index.php">Home</a></li> -->
         <li><?php include('../search/index.php');?></li>
         </ul>
         <ul class="nav navbar-nav navbar-right">
       <?php 
         $sql_seen="SELECT * from Notification where UserId='$userid' AND Seen=0";
         $result_seen=$conn->query($sql_seen);
         $no=$result_seen->num_rows;
         ?>
         <li <?php if(!empty($no)){echo 'style="background:#ff0066;"';}?> class="dropdown"><a class="dropdown-toggle" <?php if(!empty($no)){echo 'style="color:white;"';} ?>data-toggle="dropdown" href="#"><b><i class="fa fa-bell" aria-hidden="true"></i> <?php if(!empty($no)){echo '('.$no.')';}?></b><span class="caret"></span></a>
          <ul class="dropdown-menu">
          <hr style="color: blue;">
            <?php 
    
            $sql_nav="SELECT * from Notification where UserId='$userid' ORDER BY Time DESC LIMIT 15";
            $result_nav=$conn->query($sql_nav);
            while($row_nav=$result_nav->fetch_assoc())
            {
              $pid_nav=$row_nav["PinId"];
              $uid_nav=$row_nav["UserId2"];
              $desc_nav=$row_nav["Description"];
              $seen_nav=$row_nav["Seen"];
              ?>
              <li style="background:<?php if($seen_nav==0){echo '#00a3cc';}else{echo 'white';}?>;"><a href="<?php if($uid_nav==0){echo '../showpin/viewpin.php?pid='.$pid_nav.'&seen='.$seen_nav;}else if($pid_nav==0){echo '../otherprofile/othprofile.php?id='.$uid_nav.'&seen='.$seen_nav;}?>" style="vertical-align: middle"><?php echo $desc_nav?></a></li><hr style="padding:0px; margin:0px">
              <?php
            }
            ?>
          </ul>
        </li>
        <li><a href="../profile/pro.php"><i class="fa fa-user" title="Go to Profile" aria-hidden="true"></i>
</a></li>
    
          <li><a href="../pinupload/pin.php"><i class="fa fa-upload" title="Upload Pin" aria-hidden="true"></i></a></li>
          <li><a href="../boards/board.php"><i class="fa fa-plus-square" title="Create Board" aria-hidden="true"></i></a></li>
          <?php
          $sql="SELECT * FROM User WHERE UserID='$userid'";
          $result=$conn->query($sql);
          $row=$result->fetch_assoc();
          if($row["Type"]==2)
            {?>
    
          <li><a href="../render/managepins.php">Manage Pins</a></li>
    
          <?php }
          else
            {?>
    <!-- 
          
          <li><a href="../category/cat.php">Follow Cats</a></li>
          <li><a href="../render/render.php">Render</a></li> -->
    
          <?php }?>
          <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-bars" title="Browse Categories" aria-hidden="true"></i>

        <span class="caret"></span></a>
        <ul class="dropdown-menu">
           <?php 
    
            $sql_cat="SELECT * from Categories";
            $result_cat=$conn->query($sql_cat);
            while($row_cat=$result_cat->fetch_assoc())
            {
              $cat_nav=$row_cat["CatName"];
              $cat_idd=$row_cat["CatId"];
              
             
              ?>
              <li ><a href="../showcat/catpage.php?cid=<?php echo $cat_idd ?>"><?php echo $cat_nav?></a></li>
              <?php
            }
            ?>
        </ul>
      </li>
          <li><a href="../login/logout.php"><i class="fa fa-sign-out" title="Logout" aria-hidden="true"></i> </a></li>
          
    
          <?php
        }
        ?>
      </ul>


</div>
</nav>

<!-- Navbar End -->