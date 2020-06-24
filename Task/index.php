<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    include('sqlconn.php');
if(empty($_POST['username'])){
    header('location:login.php?Empty=plz fill username');

}else{
    $user= $_POST['username'];
    $password=$_POST['password'];
    $_SESSION["username"] = $user;
    $_SESSION["password"] = $password;
    //print_r($_SESSION);
    //$_SESSION['secsess']='You Are Welcome'.$user;
    $result = $mysqli->query("SELECT id, username, password FROM user WHERE username = '$user' AND password = '$password' LIMIT 1");
    if ($result->num_rows != 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $username = $row['username'];
        $password = $row['password'];
        if ($id == 0) {
       //     echo "logged in welcome admin"."<br>";
       // echo  "<a href='controllpanle.php'>add user</a>";
    }
        else {

            //echo "welcome user" .'<br>' .$username;
        }
    }
    else
    {
        header('location:login.php');

        echo "<script>alert('invalid username or password, Try Again!')</script>";

    }

}}else

{

  header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Side Navigation Bar</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" value="<?php echo $username; ?>">
        <h2><?php  if (isset($_SESSION['username'])) {echo"".$user;} ?></h2>
       
        <ul>
        <?php  if (isset($_SESSION['username'])) {
                    if ($id == 0) {
                       echo '<li><a href="controllpanle.php"><i class="fas fa-plus"></i>Add New User</a></li>';

                    }else{
                        echo '<li><a href="#"><i class="fas fa-home"></i>welcome  User</a></li>';
                       }

            } ?>

            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a></li>
         
        </ul> 
    </div>
    <div class="main_content">
        <div class="header"><?php  if (isset($_SESSION['username'])) {echo"You Are Welcome  "."<bre>".$user;} ?></div>  
        <div class="info">
    
        <div>       </div>
          
    </div>
    <div class="content">
		
			</div>
        </div>
     </div>
</div>

</body>
</html>