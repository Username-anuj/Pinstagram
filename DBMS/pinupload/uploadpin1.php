<?php
include '../connection/conn.php';
session_start();

$userid = $_SESSION['myid'];
echo $userid;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name=$_POST["Pinnm"];
    $desc=$_POST["desc"];
    $cat=$_POST["categories"];    

    $sql="SELECT * FROM Pin";
    $result = $conn->query($sql);
    $tf=$result->num_rows+1;
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $targ=$target_dir.$tf.".".$imageFileType;
    $filename=($_FILES["file"]["name"]);

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
    {
        $uploadOk = 0;
    }
    if ($uploadOk == 1) 
    {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targ)) {
            $sql = "SELECT CatId FROM Categories WHERE CatName='$cat'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $cid=$row["CatId"];
                }
            }

            $sql = "INSERT INTO Pin (Pic,Name,Description,Likes,UserId,CatId) 
            VALUES ('$targ','$name','$desc',0,$userid,'$cid')";

            $run=$conn->query($sql);
            $sql = "SELECT PinId FROM Pin WHERE Pic='$targ'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $pid=$row["PinId"];
                }
            } 

            $sql = "INSERT INTO $cat (PinId) 
            VALUES ('$pid')";

            if ($conn->query($sql) === TRUE) 
            {
                header('location: ../render/render.php');
            } 

        } 


    }



}
?>
