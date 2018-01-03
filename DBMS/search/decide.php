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
</head>
<body>
<?php
  include '../connection/conn.php';
  session_start();
  $searchcategory=$_GET['searchcategory'];
  echo $searchcategory;
  $searchquery = $_GET['searchquery'];
  echo $searchquery;

  if($searchcategory=='User')
  {
    echo 'string';
    $searched_user_id = "SELECT * from User where UserName = '".$searchquery."'";
    $result_user = $conn->query($searched_user_id);
    $row_user = $result_user->fetch_assoc();
    $uid = $row_user['UserId'];
    header("location: ../otherprofile/othprofile.php?id=".$uid);

  }
  if($searchcategory=='Pins')
  {
    echo 'string';
    $searched_pin_id = "SELECT * from Pin where Description = '".$searchquery."'";
    $result_pin = $conn->query($searched_pin_id);
    $row_pin = $result_pin->fetch_assoc();
    $pid = $row_pin['PinId'];
    header("location: ../showpin/viewpin.php?pid=".$pid);

  }
  if($searchcategory=='Category')
  {
    echo 'string';
    $searched_category_id = "SELECT * from Categories where CatName = '".$searchquery."'";
    $result_category = $conn->query($searched_category_id);
    $row_category = $result_category->fetch_assoc();
    $cid = $row_category['CatId'];
    header("location: ../showcat/catpage.php?cid=".$cid);

  }
  ?>
</ol>
</body>
</html>
