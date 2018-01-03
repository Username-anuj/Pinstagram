<?php
include '../connection/conn.php';
session_start();
// include '../navbar.php';

$userid = $_SESSION['myid'];
$n=0;
$sql="SELECT * FROM User WHERE UserID='$userid'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
if($row["Type"]==2)
{
    $n=1;
}
else
{
    $n=0;
}
echo "n: ".$n."<br>";
echo $userid;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name=$_POST["Pinnm"];
    $desc=$_POST["desc"];
    $cat=$_POST["categories"]; 
    $canbuy=$_POST["CanBuy"];  
    $stock=$_POST["Stock"];
    $price=$_POST["Price"];  
    $download=$_POST["download"];

    echo "n: ".$n."<br>";


    if($n==0)
    {

        echo $canbuy;
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
            echo "Hi";
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targ)) 
            {
                $sql = "SELECT CatId FROM Categories WHERE CatName='$cat'";
                $result = $conn->query($sql);
                echo "Hi";

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $cid=$row["CatId"];
                    }
                }
                else
                {
                    echo "Error ".$sql;
                }
                if($canbuy==1)
                {
                    $sql = "INSERT INTO Pin (Pic,Name,Description,Likes,UserId,CatId,CanBuy,Stock,Price,Download) 
                    VALUES ('$targ','$name','$desc',0,$userid,'$cid','$canbuy','$stock','$price','$download')";
                }
                else
                {
                    $sql = "INSERT INTO Pin (Pic,Name,Description,Likes,UserId,CatId,CanBuy,Stock,Price,Download) 
                    VALUES ('$targ','$name','$desc',0,$userid,'$cid','$canbuy',0,0,'$download')";
                }

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
                else
                {
                    echo "Error ".$sql;
                }

                $sql = "INSERT INTO $cat (PinId) 
                VALUES ('$pid')";

                if ($conn->query($sql) === TRUE) 
                {
                    header('location: ../render/render.php');
                } 
                else
                {
                    echo "Error ".$sql;
                }

            } 


        }
    }
    else if($n==1)
    {

        echo $canbuy;
        $sql="SELECT * FROM SponsorPins";
        $result = $conn->query($sql);
        $tf=$result->num_rows+1;
        $sql="SELECT * FROM SponsorPins WHERE UserId='$userid' AND Seen=1";
        $result = $conn->query($sql);
        if($result->num_rows>5)
        {
            $se=0;
        }
        else
        {
            $se=1;
        }
        echo $se. "se";
        $target_dir = "sponsoruploads/";
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
            echo "Hi";
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targ)) 
            {
                if($se==1)
                {
                    $sql = "INSERT INTO SponsorPins (Pic,Name,Description,UserId,NumVisits,Status) 
                    VALUES ('$targ','$name','$desc',$userid,0,0)";
                }
                else
                {
                    $sql = "INSERT INTO SponsorPins (Pic,Name,Description,UserId,NumVisits,Status,Seen) 
                    VALUES ('$targ','$name','$desc',$userid,0,0,0)";

                }



                if ($conn->query($sql) === TRUE) {
                    if($se==1)
                    {

                        header('location: ../render/render.php');
                    }
                    else
                    {
                        $_SESSION['message']="You have exceeded your limit of the number of Ads.";
                        header('location: pin.php');
                    }
                } 

            } 

        }
        else
        {
            echo "Errior";
        }
    }



}
?>
