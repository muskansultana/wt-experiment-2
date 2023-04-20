<?php
 session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=width-device">
        <link rel="stylesheet" href="fb.css">
        
        <title>Mini Facebook</title>
    </head>
    <body>
        <nav>
            
            <div class="nav-left">
                <img src="fbword.jpg" alt="logo" width="300">
             <ul>
                 
                <li><img src="notification.png"></li>
                <li><img src="inbox.png"></li>
                <li><img src="watch.png"></li>
             </ul>
            </div>
            
            <div class="nav-right">

                <div class="search-box">
                    <img src="search.png" >
                    <input type="text" placeholder="search">
                </div>

                <div class="nav-user-icon online" onclick="settingsMenuToggle()">
                    <img src="profile.jpg">
                    <p>ONLINE</p>
                </div>

            </div>
            <div class="settings-menu">
                <div id="dark-btn">
                    <span></span>
                </div>
                <div class="settings-inner-menu">
                  <div class="user-profile">
                  <img src="profile.jpg">
                <div>
                    <p>MUSKAN SULTANA</p>
                    <a href="#">See your profile</a>

                </div>
            </div>
            <hr>
            <div class="user-profile">
            <img src="comments.png">
            <div>
                <p>Give Feedback</p>
                <a href="#">Help us to improve the new design</a>

             </div>
             </div>
             <hr>
               <div class="settings-links">
                   <img src="settings.png" class="setings-icon">
                   <a href="#">Settings and privacy  <img src="arrow.png" width="10px"></a>

               </div>
               <div class="settings-links">
                <img src="help.png" class="setings-icon">
                <a href="#">Help & Support  <img src="arrow.png" width="10px"></a>

            </div>
            <div class="settings-links">
                <img src="logout.png" class="setings-icon">
                <a href="destroy.php">Logout <img src="arrow.png" width="10px"></a>

            </div>

            </div>
            </div>
        </nav>
        <div class="container">
           
            <div class="left-sidebar">
                <div class="imp-links">
                <a href="#"><img src="news.png">Latest News</a>

                <a href="#"><img src="friends.png">Friends</a>


                <a href="#"><img src="marketplace.png">marketplace</a>

                <a href="#"><img src="watch.png">watch</a>
                <a href="#"><img src="upload2.png">file to upload</a>
                <form method="post" action="upload.php" enctype="multipart/form-data">
                    <input type="file" name="image" required>
                    <button type="submit" name="submit">Upload</button>
                </form>
                <a href="#">See more</a>
                </div>
            <div class="shortcut-links">
                <p>Your Shortcuts</p>
                <a href="#"><img src="feed2.jpeg">Website developer</a>
                <a href="#"><img src="shortcut2.jpeg">Website design course</a>
                <a href="#"><img src="shortcut4.jpeg">Full Stack Development</a>  
            </div>
        </div>
            <div class="main-content">
                <?php
                $servername = "localhost";
				$uname = "muskan";
				$password = "muskan24";
				$dbname = "muskan";
				
				$conn = new mysqli($servername, $uname, $password, $dbname);
				
				if ($conn->connect_error) {
				  die("Connection failed: " . $conn->connect_error);
				}
				$sql = "SELECT * FROM images";
	            $result = mysqli_query($conn, $sql);
	             if (mysqli_num_rows($result) > 0) {
                   while($row = mysqli_fetch_assoc($result)) {
					echo "<form class='post-row' method='post' action='like.php' style='padding-top:2px;'>";
                    echo "<div>";
					//echo  "<h2>".$_SESSION['user_name']."</h2>";
					//echo "<p style='color:grey;font-size:15px;'>".$row['comment']."</p>";
					echo "<div style='width: 500px;'>";
	                echo "<img src='uploads/" . $row['image'] . "' alt='post'>";
					echo "<hr style='height:1px;border-width:0;background-color:lightgrey'>";
					echo "</div>";
					echo "<div class='actions'>";
					echo "<button type='submit' name='iid'  style='font:size 5px;' value=".$row['image'].">Like:<span id='out'>".$row['likes']."</span></button>";
                    echo "</form>";
                    echo "<form method='post'>";
                    echo "<input class='comment' type='text' name='cmt'>";
                    echo "<input type='hidden' value=".$row['image']." name='id' >";
                    echo "<input type='hidden' value=".$_SESSION['admin_name']." name='email'>";
					echo "<input type='submit' name='submit1'value='comment'>";
                    echo "</form>";
					echo "<a href='#'>Share</a>";
					echo "<span>".$row["time"]."</span>";
                    echo "</div>";
                    echo "<br><br>";
                    echo "<div>";
                    $image=$row['image'];
                    $comment= "select * from comment where file='$image'";
                    $res=mysqli_query($conn,$comment);
                    echo "<h3>Comments:</h3>";
                    while($oc=mysqli_fetch_array($res))
                    {
                        echo "<p>".$oc['email']." commented: ".$oc['comment']."</p>";
                    }
					echo "<hr style='height:1px;border-width:0;background-color:lightgrey;'>";
                    
                    echo"</div>";
                    echo "</div>";
					
	               }
                   
					} else {
					echo "No images found.";
					}
                    if(isset($_POST['submit1'])){
                        $fi=$_POST["id"];
                        $em=$_POST["email"];
                        $cm=$_POST["cmt"];
                        if($cm!="")
                        {
                            mysqli_query($conn,"INSERT INTO comment(file,email,comment) VALUES('$fi','$em','$cm')");
                            
                            
                        }
                        
                    }


				mysqli_close($conn);
							?>
                             <button type="button" class="load-more-btn">Load More</button>
            </button>
            </div>
            <style>
                .post-row {
    width:500px;
    border:2px solid grey;
    box-shadow: 50px;
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
    margin-top: 2px;
}
.post-row img{
    width:350px;
    margin-left:75px;
}
.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 3px;
    padding-bottom: 3px;
    padding-left: 10px;
}

.actions a {
    color: #3b5998;
    text-decoration: none;
    margin-right: 10px;
}

.actions a:hover {
    text-decoration: underline;
}

.actions span {
    font-size: 14px;
    color: #666;
}
            </style>
            <div class="right-sidebar">

                <div class="sidebar-title">

                    <h4>Events</h4>

                    <a href="#">See All</a>
                </div>


                 <div class="event">

                        <div class="left-event">

                          <h3>18</h3>
                           <span>March</span>
                         </div><br/>
                     <div class="right-event">
                    <h4>Social Media</h4>

                    
                    <p><i class="fas fa-map-marker-alt"></i>wilsonTech Park</p>

                    <a href="#">More Info</a>
                       </div>
                       </div>
                       <div class="event">
                     <div class="left-event">
                    <h3>22</h3>
                    <span>June</span>
                </div>
                <div class="right-event">
                    <h4>Mobile Marketing</h4>
                    <p><i class="fas fa-map-marker-alt"></i>wilsonTech Park</p>
                </div>
              </div>
            <img src="feed2.jpeg" class="sidebar-ads">

            <div class="sidebar-title">

                <h4>Conversation</h4>

                <a href="#">Hide chat</a>

             </div>
            <p>Jackson Aston</p><br>
            <p>vinay kumar</p><br>
            <p> likitha</p><br>      
      <div class="divfooter">
          <p>Copyright 2022 -Daphne Ruth #YouTubeChannel</p>
      </div>     
      <script src="fb.js"></script>
    </body>
</html>