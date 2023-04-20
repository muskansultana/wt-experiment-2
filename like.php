<?php
session_start();
    $name=$_POST['uid'];
    $url= $_POST['iid'];
    $host = 'localhost';
    $username = 'muskan';
    $password = 'muskan24';
    $dbname = 'muskan';
    $conn = mysqli_connect($host, $username, $password, $dbname);
    $res = mysqli_query($conn,"select * from likes where user_id='$name' and post_id='$url'");
    if(mysqli_num_rows($res)>0){
        $res=mysqli_query($conn,"select * from images where image='$url'");
        $l = mysqli_fetch_assoc($res);
        $x=$l['likes'];
        //$x=$x-1;
        $a=mysqli_query($conn,"UPDATE images SET likes='$x'-1 WHERE image='$url'");
        $b=mysqli_query($conn,"DELETE FROM likes WHERE user_id='$name' and post_id='$url'");
    }
    else
	{
        $res = mysqli_query($conn,"select * from images where image='$url'");
        $l = mysqli_fetch_assoc($res);
        $x=$l['likes'];
        //$x=$x+1;
        $a=mysqli_query($conn,"UPDATE images SET likes='$x'+1 WHERE image='$url'");
        $b=mysqli_query($conn,"INSERT INTO likes(user_id,post_id)VALUES('$name','$url')");
        
    }
    header("Location:facebook_form.php");
   
?>