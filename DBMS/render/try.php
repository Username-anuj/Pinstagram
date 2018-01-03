<?php
include '../connection/conn.php';
session_start();
$Pid=[];
$Cat=[];
$time=[];
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="js/modernizr.custom.js"></script>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title>Render</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="js/modernizr.custom.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/comp.css" />
	<style type="text/css">
		
		
		#topMenu {
			background-color:#222;
			overflow: auto;
			height: 100%;
		}

		#box {
			background-color:#111111;
			position:relative;
			/*margin:0 auto;*/
			padding:5px;
			width:100%;
		}

		.scroller {
			color:#ffffff;
			width:40px;
			text-align:center;
			cursor:pointer;
			display:none;
			padding:5px;
			margin-top:5px;
		}

		.scroller-right{
			position: relative;
			top:90px;
			float:right;
		}

		.scroller-left {
			position: relative;
			top:90px;
			float:left;
		}

		.wrapper {
			position:relative;
			margin:0 auto;
			overflow:hidden;
			padding:5px;
			height:50px;
		}

		.list {
			position:absolute;
			left:0px;
			top:0px;
			min-width:3000px;
			margin-left:12px;
			margin-top:0px;
		}


		.item{
			padding:10px;
			/*float:left;*/
			display:table-cell;
			margin:1px;
			position:relative;
			text-align:center;
			/*cursor:grab;
			cursor:-webkit-grab;*/
			color:#efefef;
			border: 1px dotted #111;
			vertical-align:middle;

		}
	</style>
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<base target="_parent">
<body>
	<?php //include '../navbar.php'; ?>
	<?php
	$sql="SELECT * from SponsorPins where Status=1 AND Seen=1";
	$result=$conn->query($sql);
	if ($result->num_rows>0)
		{?>

		<div id="topMenu" style="height: 340px;">
			<div id="box" style="height: 330px;">
				<div class="scroller scroller-left"><i class="icon-chevron-left icon-3x"></i></div>
				<div class="scroller scroller-right"><i class="icon-chevron-right icon-3x"></i></div>
				<div class="wrapper" style="height: 330px;">
					<div class="list" style="height: 330px;">

						<?php while($row=$result->fetch_assoc())
						{
							$Pid=$row["PinId"];
							$Pic=$row["Pic"];
							$Title=$row["Name"];
							$Description=$row["Description"];
							$owner=$row["UserId"];
							?>
							<a href="visits.php?pid=<?php echo $Pid?>&userid=<?php echo $owner?>">
								<div class="item">
									<img src="<?php echo "../pinupload/".$Pic?>" alt="Los Angeles" style="height:225px; width: 225px;"><br>
									<h4><?php echo $Title?></h3><br>
										<p><?php echo $Description?></p>
									</div>

								</a>



								<?php
							}?>
						
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
			var hidWidth;
			var scrollBarWidths = 40;

			var widthOfList = function(){
				var itemsWidth = 0;
				$('.item').each(function(){
					var itemWidth = $(this).outerWidth();
					itemsWidth+=itemWidth;
				});
  //alert(itemsWidth);
  return itemsWidth;
};

var widthOfHidden = function(){
	return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
};

var getLeftPosi = function(){
  //return $('.item:first-child').position().left;
  return $('.list').position().left;
};

var reAdjust = function(){
	if (($('.wrapper').outerWidth()) < widthOfList()) {
		$('.scroller-right').show();
	}
	else {
		$('.scroller-right').hide();
   	/*
    var leftPos = $('.item:first-child').position().left;
	$('.item').animate({left:"-="+leftPos+"px"},'slow');
	*/
}

if (getLeftPosi()<0) {
	$('.scroller-left').show();
}
else {
	$('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
	$('.scroller-left').hide();
}
}

reAdjust();

$(window).on('resize',function(e){  
	reAdjust();
});

$('.scroller-right').click(function() {

	$('.scroller-left').fadeIn('slow');
	$('.scroller-right').fadeOut('slow');

	$('.list').animate({left:"+="+widthOfHidden()+"px"},'slow',function(){
  	//reAdjust();
  });  	
});

$('.scroller-left').click(function() {
  	//var leftPos = $('.item:first-child').position().left;
	//$('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
  	//$('.scroller-left').hide();

  	$('.scroller-right').fadeIn('slow');
  	$('.scroller-left').fadeOut('slow');

  	$('.list').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){

  	});

  });    
</script>


</body>
</html>