<?php
include '../connection/conn.php';
session_start();
$userid = $_SESSION['myid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
$j=0;
$name=$_POST["Boardnm"];
//echo "Hi $name";
$cnt=count($_FILES["file"]["name"]);


$sql = "INSERT INTO Board (BoardName,NumPin,UserId)
VALUES ('$name',$cnt,$userid)";

if ($conn->query($sql) === TRUE) 
{
    echo "New record created successfully<br>";
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

for($i=0;$i < count($_FILES["file"]["name"]); $i++)
{
$sql="SELECT * FROM BoardPins";
$result = $conn->query($sql);
$tf=$result->num_rows+1;
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$targ=$target_dir.$tf.".".$imageFileType;
echo "$targ";
$filename=($_FILES["file"]["name"][$i]);
echo "Filename is $filename<br>";
if(isset($_POST["submit"])) 
{

    $check = getimagesize($_FILES["file"]["tmp_name"][$i]);
    if($check !== false) 
{
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
/*if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}*/
if ($_FILES["file"]["size"][$i] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
{
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
$j=$j+1;
if ($uploadOk == 0) 
{
    echo "Sorry, your file was not uploaded.<br>";
} 
else 
{
    if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $targ)) {
        echo "The file ". basename( $_FILES["file"]["name"][$i]). " has been uploaded.<br>";
    } else {
        echo "Sorry, there was an error uploading your file.<br>";
    }
}

$sql = "INSERT INTO BoardPins (Pic) 
VALUES ('$targ')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "SELECT PinId FROM BoardPins WHERE Pic='$targ'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
      $pid=$row["PinId"];
    }
} else {
    echo "0 results<br>";
}

$sql = "SELECT BoardId FROM Board WHERE BoardName='$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $bid=$row["BoardId"];
    }
} 
else 
{
    echo "0 results<br>";
}
$sql = "INSERT INTO FollowBoard(BoardId,PinId) 
VALUES ('$bid','$pid')";

if ($conn->query($sql) === TRUE) 
{
    echo "New record created successfully<br>";
    header('location: ../render/render.php');
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error."<br>";
}
}
}
?>
