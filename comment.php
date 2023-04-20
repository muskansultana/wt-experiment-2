<?php
	session_start();
	$servername = "localhost";
				$uname = "muskan";
				$password = "muskan24";
				$dbname = "muskan";
				
				$conn = new mysqli($servername, $uname, $password, $dbname);
				
				if ($conn->connect_error) {
				  die("Connection failed: " . $conn->connect_error);
				}
$fi=$_POST["id"];
$em=$_POST["email"];
$cm=$_POST["cmt"];
echo $cm;
echo $em;
echo $fi;
if($cm=="")
{
    //header("Location:facebook_form.php");
}
mysqli_query($conn,"INSERT INTO comment(file,email,comment) VALUES('$fi','$em','$cm')");
//header("Location:facebook_form.php");*/
?>