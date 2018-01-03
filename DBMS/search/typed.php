<?php

include '../connection/conn.php';
session_start();


$key = $_POST['search_query'];
// $password = $_POST['pwd'];

$query_pins=$conn->query("SELECT * from Pin where Description LIKE '%{$key}%'");
if($query_pins->num_rows==0){echo 'No records found';}
?>
<html>
<head>
  <title>Search Result</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="js/modernizr.custom.js"></script>
  <link rel="stylesheet" type="text/css" href="css/default.css" />
  <link rel="stylesheet" type="text/css" href="css/component.css" />

</head>
<body>
   <div class="container">
      <ul class="grid effect-6" id="grid">
       <?php
       while($row_pins=$query_pins->fetch_assoc())
       {
    	  // $array['Category'][$index_category] = $row_category['CatName'];
    	  // $index_category++;
         $array=array('label' => $row_pins['Description'],'category' => 'Pins');?>
         <li>
            <a href="../showpin/viewpin.php?pid=<?php echo $row_pins['PinId']?>">
                <div class="well">
                <img src="<?php echo "../pinupload/".$row_pins['Pic']?>" style="width:20em;"><br>
                    <center><br>
                        <br>
                        <b><?php echo $row_pin['Title']?></b><br><?php echo $row_pins['Description']?>
                    </center>
                </div>
            </a>
        </li>
        <?php
    		 // echo $array['category'];
    }
 // foreach ($array as $key => $value) {
 //     echo "Key: $key; Value: $value\n";
 // }
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
</body>
</html>
