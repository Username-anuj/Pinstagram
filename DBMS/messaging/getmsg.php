
<?php
    include '../connection/conn.php';
    session_start();
    $me = $_SESSION['myid'];
    $other = $_GET['uid'];
    // $n=$_GET['n'];
    // echo $me;
    // echo $other;
    $sql_sent="SELECT * FROM chats WHERE (Sender='$me' AND Receiver='$other') OR (Sender='$other' AND Receiver='$me') Order By TimeSent";
    $result_sent = $conn->query($sql_sent);
    $user = $conn->query("call user_info($other,'*')");
    $conn->next_result();
    $user_row = $user->fetch_assoc();


    while($row_sent=$result_sent->fetch_assoc())

    {
        if((int)$row_sent['Sender']==$other)
        {

echo '<li class="left clearfix">
    <span class="chat-img pull-left">
        <img src="../images/dp/'.$user_row['Dp'].'" alt="User Avatar" style="height: 30px;width: 30px;border-radius:50%;" class="centered-and-cropped" />
    </span>
    <div class="chat-body clearfix">
        <div class="header">
            <strong class="primary-font">'.$user_row['UserName'].'</strong> <small class="pull-right text-muted">
            <span class="glyphicon glyphicon-time small">
</span>'.date('g:i A, j M',strtotime($row_sent['TimeSent'])).'</small>
        </div>
        <p><b>
            '.$row_sent['Message'].'
        </b></p>
    </div>
</li>';

    }

    if((int)$row_sent['Sender']==$me)
    {
echo
'<li class="right clearfix"><span class="chat-img pull-right">
    <img src="../images/dp/'.$_SESSION['profile_picture'].'" alt="User Avatar" style="height: 30px;width: 30px;border-radius:50%;" class="img-circle" />
</span>
<div class="chat-body clearfix">
    <div class="header">
        <small class="text-muted"><span class="glyphicon glyphicon-time small"></span>'.date('g:i A, j M',strtotime($row_sent['TimeSent'])).'</small>
        <strong class="pull-right primary-font">You</strong>
    </div>
    <p class=" pull-right clearfix">
        <b>'.$row_sent['Message'].'</b>
    </p>
</div>
</li>';

    }
}//While loop ends
?>