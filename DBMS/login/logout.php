<?php

include '../connection/conn.php';

session_start();

$_SESSION['whoami'] = NULL;
$_SESSION['loggedin'] = 0;
$uid = $_SESSION['myid'];
 $logintime = $_SESSION["logintime"];



$timespent = "SELECT TIMEDIFF(current_timestamp(),'$logintime') as timespent";
$result_timespent=$conn->query($timespent);
$row_timespent = $result_timespent->fetch_assoc();

// $huakya = $row_timespent['timespent'];

// echo $huakya;
// echo gettype($huakya);
// echo 'string';
echo $uid;
// $add_time = "INSERT into TimeSpent (UserId,TotalTime) values ('$uid','$huakya')";
$add_time = "UPDATE TimeSpent set TimeSpent.TotalTime = ADDTIME(TimeSpent.TotalTime,(SELECT TIMEDIFF(current_timestamp(),'$logintime')))
WHERE UserId='$uid'";

$result_add_time = $conn->query($add_time);

$lastseen = "UPDATE User SET LastSeen = now() WHERE UserId = '$uid'";
$res_lastseen=$conn->query($lastseen)  ;

$online = "UPDATE User SET Online = 'Away' WHERE UserId = '$uid'";
$res_online=$conn->query($online)  ;
session_destroy();
header('location: ../index.php');


?>