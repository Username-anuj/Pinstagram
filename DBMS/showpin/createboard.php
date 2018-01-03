<?php
include '../connection/conn.php';
session_start();
$pid=$_POST['pid'];

$userid = $_SESSION['myid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $j=0;
    $name=$_POST["Boardnm"];
    echo $name;
    $sql = "INSERT INTO Board (BoardName, NumPin,UserId) VALUES ('$name',1,$userid)";
    if($conn->query($sql))
    {

    }
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $sql = "SELECT BoardId FROM Board WHERE BoardName='$name'";
    $result = $conn->query($sql);
    print_r($result);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            echo "Hi <br>";
            print_r($row);

            $boardid=$row["BoardId"];
        }
    }
    $sql="SELECT * FROM Board WHERE UserId='$userid'";
    $result=$conn->query($sql);
    $no=$result->num_rows;

    $sql = "UPDATE User SET NumBoards='$no' WHERE UserId='$userid'";
    $result=$conn->query($sql);


    $sql="SELECT * FROM Pin WHERE PinId='$pid'";
$result=$conn->query($sql);

while($row=$result->fetch_assoc())
{
    $pic=$row["Pic"];
}


    $sql="SELECT * FROM BoardPins";
    $result = $conn->query($sql);
    $tf=$result->num_rows+1;
    $target_dir = "uploads/";
    $target_file = $target_dir.$pic;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $targ=$target_dir.$tf;
    echo $targ;
    if ($uploadOk == 1) 
    {
        if (copy('../pinupload/'.$pic, '../boards/'.$targ)) 
        {
        // echo "Hi";

            $sql = "INSERT INTO BoardPins (Pic) 
            VALUES ('$targ')";

            $run=$conn->query($sql);
            $sql = "SELECT PinId FROM BoardPins WHERE Pic='$targ'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $pinid=$row["PinId"];
                }
            } 

            $sql="INSERT INTO FollowBoard (BoardId, PinId) VALUES ($boardid, $pinid)";
        // $run=$conn->query($sql);


            if ($conn->query($sql) === TRUE) 
            {
                header('location: viewpin.php?pid='.$pid);
            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        }
        else
        {
            echo "error";
        }
    }
}
    
    
    ?>