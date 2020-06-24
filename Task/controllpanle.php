<?php
session_start();
if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location:login.php");}


    if(isset ($_SESSION['username'])){

//print_r($_SESSION);
  
      
    if($_SERVER['REQUEST_METHOD']=='POST'){

    include('sqlconn.php');
    $username=$_POST['name'];
    $useremail=$_POST['useremail'];
    $userpassword=$_POST['userpassword'];

    
    $_SESSION['name']=$username;
    $_SESSION['useremail']=$useremail;
    $_SESSION['userpassword']=$userpassword;


    

    
	$password = md5($userpassword);
    $_SESSION['userpassword']=$userpassword;

    

    global  $errors;

    $errors   = array(); 

	if (empty($username)){
        array_push($errors, "Username is required"); 
	}
	if (empty($useremail)){
        array_push($errors, "Email is required"); 

	}
		
	if (empty($userpassword)){
        array_push($errors, "Password is required"); 


	}
    if (count($errors) == 0) {

	$statement = $mysqli->prepare("INSERT INTO user (username, email, password) VALUES(?, ?, ?)"); 
	$statement->bind_param('sss', $username, $useremail, $userpassword); 
	
	if($statement->execute()){
        $_SESSION['success']  = "INSERTED DATA SUCSESSFULLY";

        
    }
}
 
        
   }
}


else{
header("location:login.php");

}


?>


<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
     
  <form  action="controllpanle.php" method="post">
      <h1>INSERT USER</h1>
      <div class="icon">
        <i class="fas fa-user-circle"></i>
      </div>
      <div class="formcontainer">
      <div class="container">
        <label for="uname"><strong>Username</strong></label>
        <input type="text" placeholder="Enter Username" name="name" required>
        <label for="mail"><strong>E-mail</strong></label>
        <input type="text" placeholder="Enter E-mail" name="useremail" required>
        <label for="psw"><strong>Password</strong></label>
        <input type="password" placeholder="Enter Password" name="userpassword" required>
      </div>
      
      <button type="submit"><strong>INSERT NEW USER</strong></button>
    <div class="cc">
    <?php if (isset($_SESSION['success'])) : ?>
                <div class="error success" >
                    <h5>
                        <?php 
                            echo $_SESSION['success']; 
                            unset($_SESSION['success']);
                        ?>
                    </h5>
                </div>
            <?php endif ?>
        </div>
        </form>

        <form action="logout.php">
        <div class="ccc">
            <button type="submit" name="logout" ><strong>logout</strong></button>
            
            </div>
    </form>  

</script>
  </body>
</html>
<?php
