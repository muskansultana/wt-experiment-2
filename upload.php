<?php
$conn = mysqli_connect("localhost", "muskan", "muskan24", "muskan");
if(isset($_POST['submit'])){
   $image = $_FILES['image']['name'];
   move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);
   $sql = "INSERT INTO images (image) VALUES ('$image')";
   mysqli_query($conn, $sql);
}
header('Location:facebook_form.php');
?>