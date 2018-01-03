<?php
include("../connection/conn.php");
session_start();
if($_SESSION['loggedin']==1 && $_SESSION['usertype']==1)
{
// $_SESSION['pagename'] = "index.php";
// if($_SESSION['iamroot'] == 1)
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Pinstagram | View Pins</title>
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
		$(function() {
		// for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		// save the latest tab; use cookies if you like 'em better:
		localStorage.setItem('lastTab', $(this).attr('href'));
		});
		// go to the latest tab, if it exists:
		var lastTab = localStorage.getItem('lastTab');
		if (lastTab) {
		$('[href="' + lastTab + '"]').tab('show');
		}
		});
		});
		</script>
	</head>
	<body>
		<h1>Manage Pins</h1>
		<div class="container-fluid" style="margin: 20px">
		  <div class="dropdown">
		  <p>Too much data? Add some filters :)</p>
		    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort Pins By
		    <span class="caret"></span></button>
		    <ul class="dropdown-menu">
		      <li class="dropdown-header">Manage Pins</li>
		      <li><a href="root_pins.php?sortpinsby=TimeStamp&orderpins=DESC">Newest</a></li>
		      <li><a href="root_pins.php?sortpinsby=TimeStamp">Oldest</a></li>
		      <li><a href="root_pins.php?sortpinsbyuser=yes">User</a></li>
		      <li><a href="root_pins.php?sortpinsbycat=yes">Category</a></li>
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
		                    <th>Pin Id</th>
		                    <th>Source</th>
		                    <th>Name</th>
		                    <!-- <th>Description</th> -->
		                    <th>Uploaded By</th>
		                    <th>Category</th>
		                    <th>Likes</th>
		                    <th>Shares</th>
		                    <th>Score</th>
		                    <th>Report</th>
		                    <th>Manage</th>
		                </tr>
		                <?php
		                $orderpinsby = $_GET['sortpinsby'];
		                $orderpins = $_GET['orderpins'];

		                $query_pins = "SELECT * FROM Pin order by $orderpinsby $orderpins";
		                
		                if($_GET['sortpinsbyuser']=="yes"){
		                ?>
		                Username:
		                <form action="root_pins.php" method="GET">
			                <input type="text" name="uname">
			                <input type="hidden" name="sortpinsbyuser" value="yes">
			                <input type="submit" name="submit" value="Get Pins" />
		                </form>
		                <?php
		                $uname = $_GET['uname'];
		                if($uname!==NULL)
		                { 
			                echo '<br><br>Uploaded By: <b>'.$uname.'<b><br><br>';
			            ?>
			            <form action="root_pins.php" method="GET">
			            Display top
			            	<input type="number" name="limit">
			            	Popular Pins
			            	<input type="hidden" name="sortpinsbyuser" value="yes">
			            	<input type="hidden" name="uname" value="<?php echo $uname ?>">
			            	<input type="submit" name="go" value="Go" />
			            </form>
			            <?php
			            	$limittt = (int)$_GET['limit'];
			                $search_user = "SELECT * from User where UserName ='$uname'"; 
			                $result_search_user = $conn->query($search_user);
			                $row_search_user = $result_search_user->fetch_assoc();
			                $uploaded_by_searched_user =  $row_search_user['UserId'];
			                if(isset($_GET['go']))
			                {
			                	$query_pins = "SELECT * FROM Pin where UserId='$uploaded_by_searched_user' order by Score DESC limit $limittt";
			                }
			                else 
			                {
			                	$query_pins = "SELECT * FROM Pin where UserId='$uploaded_by_searched_user'";
			                }

		            	}
		                }

		                if($_GET['sortpinsbycat']=="yes"){
		                ?>
		                Search pins by category:
		                <form action="root_pins.php" method="GET">
			                <input type="text" name="catname">
			                <input type="hidden" name="sortpinsbycat" value="yes">
			                <input type="submit" name="submit" value="Get Pins" />
		                </form>
		                <?php
		                $catname = $_GET['catname'];
		                echo '<br><br>Pins from : <b>'.$catname.'<b><br><br>';

		                $search_cat = "SELECT * from Categories where CatName ='$catname'"; 
		                $result_search_cat = $conn->query($search_cat);
		                // print_r($result_search_user);
		                $row_search_cat = $result_search_cat->fetch_assoc();
		                $pins_from_searched_cat =  $row_search_cat['CatId'];
		                // echo 'string';
		                // echo gettype($uid);

		                $query_pins = "SELECT * FROM Pin where CatId='$pins_from_searched_cat'";
		                }	
		                $result_pins = $conn->query($query_pins);
		                while($row_pins = $result_pins->fetch_assoc()){
		                ?>
		                <tr bgcolor="<?php if($row_pins['Status']==0){echo "red";}else{ echo "white"; } ?>">
		                    <td><?php echo $row_pins['PinId']; ?></td>
		                    <td><?php echo $row_pins['Pic']; ?></td>
		                    <td><?php echo $row_pins['Name']; ?></td>
		                    <!-- <td><?php //echo $row_pins['Description']; ?></td> -->
		                    <td>
		                        <?php
		                        $uploaded_by = "SELECT * from User where UserId = '".$row_pins['UserId']."'";
		                        $result_uploaded_by = $conn->query($uploaded_by);
		                        $row_uploaded_by=$result_uploaded_by->fetch_assoc();
		                        echo $row_uploaded_by['UserName'];
		                        ?>
		                    </td>
		                    <td>
		                        <?php
		                        $cat_name = "SELECT * from Categories where CatId = '".$row_pins['CatId']."'";
		                        $result_cat_name = $conn->query($cat_name);
		                        $row_cat_name = $result_cat_name->fetch_assoc();
		                        echo $row_cat_name['CatName'];
		                        ?>
		                    </td>
		                    <td><?php echo $row_pins['Likes']; ?></td>
		                    <td><?php echo $row_pins['Share']; ?></td>
		                    <td><?php echo $row_pins['Score']; ?></td>
		                    <td><?php echo $row_pins['NumReport']; ?></td>
		                    <!-- <td><?php //echo $row_pins['TimeStamp']; ?></td> -->
		                    <?php if($row_pins['Status']==1){ ?>
		                    <td><a href="blockpin.php?id=<?php echo $row_pins['PinId']; ?>&setval=<?php echo 0; ?>">
		                    <i class="fa fa-ban" aria-hidden="true"></i><?php } ?></a></td>
		                    <?php if($row_pins['Status']==0){ ?>
		                    <td style="background-color: white" ><a href="blockpin.php?id=<?php echo $row_pins['PinId']; ?>&setval=<?php echo 1; ?>">
		                    <i class="fa fa-unlock-alt" aria-hidden="true"></i><?php } ?></a></td>
		                </tr>
		                <?php } ?>
		            </table>
		        </div>
		        <!-- <div class="col-md-2"></div> -->
		    </div>
		</div>
	</body>
</html>
<?php }
else {
echo '<h1>Gotcha, thief!</h1>';
echo "<a href='../login/login.php'><button>Log in first</button></a>";
}
?>