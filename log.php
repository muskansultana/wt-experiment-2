<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $pass=$_POST['pass'];
        $fname=$_POST['fname'];

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'lalithaln';

        $conn = mysqli_connect($host, $username, $password, $dbname);
        $sql = "select * from signup where Email='$email' and Password='$pass'";
        $res = mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($res) > 0){
            $_SESSION['fname']=$fname;
            $_SESSION['email']=$email;
            header('Location:homepage.php');
        }
        else{
            echo "<script> alert('Invalid Credentials')</script>";
            header('Location:fb.html');
        }
}
?>