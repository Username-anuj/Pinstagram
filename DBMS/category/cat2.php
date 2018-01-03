<?php
include '../connection/conn.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> Follow Category</title>
	<style>
div.cat {
     width: 100%;
     height: 500px;
    background-color: white;
    color: red;
    margin: 10px 0 10px 0;
    padding: 100px;
    border: 2px solid;
    padding: 10px;
    border-color: white;
    border-radius: 25px
}
div.catt {
     width: 50%;
     height: 90%
    background-color: white;
    color: red;
    margin: 10px 0 10px 0;
    padding: 100px;
    border: 2px solid;
    padding: 10px;
    border-color: black;
    border-radius: 25px
}
.submit {
    background-color: red;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
    .img-circle {
        border-radius: 10%;
    }
    div.gallery {
    margin: 10px;
    
    float: left;
    width: 180px;
}

div.gallery:hover {
    border: 1px solid #777;
}

div.gallery img {
    width: 100%;
    height: 100px;
}
  

</style>
</head>
<body>
	<?php
		//PHP script for showing messages
	if ($_SESSION['message']!=null) {
		echo $_SESSION['message'];
		$_SESSION['message'] = null;
	}
	$i=1;
	$userid=$_SESSION['myid'];
	//echo $userid;
	$sql="SELECT * FROM FollowCat WHERE UserId='$userid'";
	$result=$conn->query($sql);
	if($result->num_rows==0)
	{
		$cid[1]=0;
	}
	else if ($result->num_rows>0)
	{
		while($row=$result->fetch_assoc())
		{
			$cid[$i]=$row["CatId"];
			$i=$i+1;
		}
	}
	?>

	<div id="main">
		<div id="form">
			<form action="followcat.php" method="post" enctype="multipart/form-data">

			<center><div class="catt" <h4> <font color="red" size="5">What are you interested in?<br>
						<font color="#404040" size="4" >Pick 5 (or more!) to discover new ideas</font></font> </h4>
			   <center><div  class="cat" style="overflow-y:scroll;" >
				
				<div class="gallery"><input type="checkbox" name="cat[]" value="Art" style="display:none" <?php if(array_search(1, $cid)!==FALSE){ echo 'checked';}?>> Art<br><img class="img-circle" src="art2.jpg"   > </div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="CarsAndMotorcycles"<?php if(array_search(2, $cid)!==FALSE){ echo 'checked';}?>> Cars  <br><img class="img-circle" src="car.jpg"   ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="Celebrities"<?php if(array_search(3, $cid)!==FALSE){ echo 'checked';}?>> Celebrities <br><img class="img-circle" src="celebs.jpg"   ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="Education"<?php if(array_search(4, $cid)!==FALSE){ echo 'checked';}?>> Education <br><img class="img-circle" src="edu.jpg"   ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="FoodDrink"<?php if(array_search(5, $cid)!==FALSE){ echo 'checked';}?>> Food And Drink <br><img class="img-circle" src="food.jpg"  ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="Humour"<?php if(array_search(6, $cid)!==FALSE){ echo 'checked';}?>> Humour <br><img class="img-circle" src="humour.jpg"   ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="Outdoors"<?php if(array_search(7, $cid)!==FALSE){ echo 'checked';}?>> Outdoors <br><img class="img-circle" src="out.jpg"  ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="Photography"<?php if(array_search(8, $cid)!==FALSE){ echo 'checked';}?>> Photography <br><img class="img-circle" src="photo1.jpg"  ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="Quotes"<?php if(array_search(9, $cid)!==FALSE){ echo 'checked';}?>> Quotes <br><img class="img-circle" src="quotes.jpg"  ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="Sports"<?php if(array_search(10, $cid)!==FALSE){ echo 'checked';}?>> Sports <br><img class="img-circle" src="sports.jpg"   ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="Tech"<?php if(array_search(11, $cid)!==FALSE){ echo 'checked';}?>> Tech <br><img class="img-circle" src="tech.jpg"  ></div>
				<div class="gallery"><input type="checkbox" name="cat[]" value="Travel"<?php if(array_search(12, $cid)!==FALSE){ echo 'checked';}?>> Travel <br><img class="img-circle" src="travel.jpg" ></div>
				</div>
				</center>
				<center><input type="submit" class="submit" name="submit" value="submit"> </center>
            </div>
            </center>
			</form>
		</div>
	</div>

</body>
</html>

