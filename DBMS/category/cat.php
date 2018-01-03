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
    /*.img-circle {
        border-radius: 10%;
    }*/
    div.gallery {
    margin: 10px;
    
    float: left;
    width: 180px;
}

/*div.gallery:hover {
    border-style: dashed;
    border-width: 1px;
}

*/

div.gallery img {
    width: 100%;
    height: 100px;
}
.text{
position:relative;

z-index: 2;
font-size: 15pt;
color: WHITE;

}
/*.overlay{
	opacity: 0.8;

}
  
.imaage{
 position: relative;
    text-align: center;
    color: white;
}*/

input[type="checkbox"][id^="cb"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label img {
	
	border-radius: 10%;
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

label:before {
  

  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label:after{
	/*content: "";*/
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  box-shadow: 0 0 5px #333;
  /*z-index: -1;*/
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

			<center> <div class="catt" <h4> <font color="red" size="5">What are you interested in?<br>
						<font color="#404040" size="4" >Pick 5 (or more!) to discover new ideas</font></font> </h4>
			   <center><div  class="cat" style="overflow-y:scroll;" >
				
				<div class="gallery"><input type="checkbox"id="cb1" name="cat[]" value="Art" <?php if(array_search(1, $cid)!==FALSE){ echo 'checked';}?>> <label for="cb1"> <img class="img-circle" src="art2.jpg">  <div class="text" style="top:-70px; left:-45px;">Art</div> </div> </label>

				<div class="gallery"><input type="checkbox"id="cb2" name="cat[]" value="CarsAndMotorcycles"<?php if(array_search(2, $cid)!==FALSE){ echo 'checked';}?>>     <label for="cb2"><img class="img-circle" src="car.jpg"   > </label><div class="text" style="top:-70px; left:-10px;">Cars</div> </div> 

				<div class="gallery"><input type="checkbox"id="cb3" name="cat[]" value="Celebrities"<?php if(array_search(3, $cid)!==FALSE){ echo 'checked';}?>>     <label for="cb3"><img class="img-circle" src="celebs.jpg"   ></label><div class="text"  style="top:-70px; left:2px;">Celebrities</div> </div>

				<div class="gallery"><input type="checkbox"id="cb4" name="cat[]" value="Education"<?php if(array_search(4, $cid)!==FALSE){ echo 'checked';}?>>    <label for="cb4"> <img class="img-circle" src="edu.jpg"> </label><div class="text" style="top:-70px; left:2px;">Education</div> </div>

				<div class="gallery"><input type="checkbox"id="cb5" name="cat[]" value="FoodDrink"<?php if(array_search(5, $cid)!==FALSE){ echo 'checked';}?>>    <label for="cb5"> <img class="img-circle" src="food.jpg"  ></label> <div class="text"style="top:-70px; left:2px;" >Food And Drink </div> </div>

				<div class="gallery"><input type="checkbox"id="cb6" name="cat[]" value="Humour"<?php if(array_search(6, $cid)!==FALSE){ echo 'checked';}?>>      <label for="cb6"> <img class="img-circle" src="humour.jpg"   ></label><div class="text"style="top:-70px; left:2px;">Humour</div> </div>

				<div class="gallery"><input type="checkbox"id="cb7" name="cat[]" value="Outdoors"<?php if(array_search(7, $cid)!==FALSE){ echo 'checked';}?>>     <label for="cb7"><img class="img-circle" src="out.jpg"  ></label> <div class="text"style="top:-70px; left:2px;">Outdoors</div> </div>

				<div class="gallery"><input type="checkbox"id="cb8" name="cat[]" value="Photography"<?php if(array_search(8, $cid)!==FALSE){ echo 'checked';}?>>    <label for="cb8"> <img class="img-circle" src="photo1.jpg"  ></label><div class="text"style="top:-70px; left:2px;">Photography</div> </div>

				<div class="gallery"><input type="checkbox"id="cb9" name="cat[]" value="Quotes"<?php if(array_search(9, $cid)!==FALSE){ echo 'checked';}?>>     <label for="cb9"><img class="img-circle" src="quotes.jpg"  ></label><div class="text"style="top:-70px; left:2px;">Quotes</div> </div>

				<div class="gallery"><input type="checkbox"id="cb10"name="cat[]" value="Sports"<?php if(array_search(10, $cid)!==FALSE){ echo 'checked';}?>>    <label for="cb10"> <img class="img-circle" src="sports.jpg"   ></label><div class="text"style="top:-70px; left:2px;">Sports</div> </div>

				<div class="gallery"><input type="checkbox"id="cb11" name="cat[]" value="Tech"<?php if(array_search(11, $cid)!==FALSE){ echo 'checked';}?>>    <label for="cb11"> <img class="img-circle" src="tech.jpg"  ></label><div class="text"style="top:-70px; left:2px;">Technology</div> </div>

				<div class="gallery"><input type="checkbox"id="cb12" name="cat[]" value="Travel"<?php if(array_search(12, $cid)!==FALSE){ echo 'checked';}?>>    <label for="cb12"> <img class="img-circle" src="travel.jpg" ></label><div class="text"style="top:-70px; left:2px;">Travel</div> </div>

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

