<?php
include '../connection/conn.php';
session_start();
$Pid=[];
$Cat=[];
$time=[];
?>
<!DOCTYPE html>
	<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
	<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
	<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
	<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
    <head>
        <title>Elastislide - A Responsive Image Carousel</title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
        <meta name="keywords" content="carousel, jquery, responsive, fluid, elastic, resize, thumbnail, slider" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo1.css" />
		<link rel="stylesheet" type="text/css" href="css/elastislide.css" />
		<link rel="stylesheet" type="text/css" href="css/custom.css" />
		<script src="js/modernizr.custom.17475.js"></script>
    </head>
    <base target="_parent">
    <body>
    <?php //include '../navbar.php'; ?>
	<?php
	$sql="SELECT * from SponsorPins where Status=1 AND Seen=1";
	$result=$conn->query($sql);
	if ($result->num_rows>0)
		{?>
		<div class="container demo-3">
		 <div class="main">
		 <div class="fixed-bar">
		
					<!-- Elastislide Carousel -->
					<ul id="carousel" class="elastislide-list">
					 <?php while($row=$result->fetch_assoc())
						{
							$Pid=$row["PinId"];
							$Pic=$row["Pic"];
							$Title=$row["Name"];
							$Description=$row["Description"];
							$owner=$row["UserId"];
							?>
						<li><a href="visits.php?pid=<?php echo $Pid?>&userid=<?php echo $owner?>"><img height= "200px" width="200px" src="<?php echo "../pinupload/".$Pic?>" alt="image01" /></a></li>
						<?php
							}?>
					</ul>
					
					<!-- End Elastislide Carousel -->
				</div>

				</div>
				<?php } ?>
		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel' ).elastislide( {
				minItems : 2
			} );
			
		</script>
    </body>
</html>