<?php
    session_start();
    global $id,$username;
    $user= $_POST['username'];
    //$id  = $_POST['id'];  
    

abstract class checkuser{

    abstract public function check($usertype);
}


class admin extends checkuser{
   // public $id;
  // public $user;

     public function check($usertype){
        include('sqlconn.php');

        global $id,$user;
        $password=$_POST['password'];
        $_SESSION["username"] = $user;
            $this->id=$usertype;
            $result = $mysqli->query("SELECT id FROM user WHERE username = '$user' AND password = '$password' LIMIT 1");
            if ($result->num_rows != 0) {
                $row = $result->fetch_assoc();
                $id = $row['id'];
                if ($id ==0 ) {
                    echo '<li><a href="controllpanle.php"><i class="fas fa-plus"></i>Add New User</a></li>';
                    echo '<li><a href="showid.php"><i class="fas fa-eye"></i>Show id</a></li>';

                
                
                }

            }   
    }       
}  


class user extends checkuser{
 
 
      public function check($usertype){
         include('sqlconn.php');
 
         global $id,$user;
         $password=$_POST['password'];
         $_SESSION["username"] = $user;
             $this->id=$usertype;
             $m = $mysqli->query("SELECT id FROM user WHERE username = '$user' AND password = '$password' LIMIT 1");
             if ($m->num_rows != 0) {
                 $row = $m->fetch_assoc();
                 $id = $row['id'];
                if ($id !=0 ) {
                echo '<li><a href="#"><i class="fas fa-home"></i>welcome  User</a></li>';
            }
            }
       }
}

class loginuser{
    public $user;

    public function login($usertype){
    global $user;
    include('sqlconn.php');
    $_SESSION["username"] = $user;
        if($_SERVER['REQUEST_METHOD']=='POST'){

            if(empty($_POST['username'])){
                header('location:login.php?Empty=plz fill username');
            }else{
                $this->user=$usertype;
                $password=$_POST['password'];
                $_SESSION["username"] = $user;
                $_SESSION["password"] = $password;
                //$_SESSION["id"]       =$id;  
                $result = $mysqli->query("SELECT id, username, password FROM user WHERE username = '$user' AND password = '$password' LIMIT 1");
                 if ($result->num_rows != 0) {
                    $row = $result->fetch_assoc();
                    $id = $row['id'];
                    $username = $row['username'];
                    $password = $row['password'];}
                else{
                    header('location:login.php');
                    echo "<script>alert('invalid username or password, Try Again!')</script>";}
                }
       }else{header('location:login.php');}
    }
}
     


        echo "<pre>";


        $login=new loginuser();
        $login->login($user);


        //print_r($login);
        echo"</pre>";

        echo "<pre>";

        $admin=new admin();
        //$admin->check($id);
        //print_r($admin);

        echo"</pre>";

        echo "<pre>";
        $user1=new user();
        //$user1->check($id);
        //print_r($user1);
        echo"</pre>";

      


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

    <div class="sidebar" value="<?php  echo $username; ?>">
        <h2><?php  if (isset($_SESSION['username'])) {echo"".$user;} ?></h2>

        <ul>
        
        <?php  if (isset($_SESSION['username'])) {
                        $admin->check($id);
                       $user1->check($id);
                      // $userid->getuser();
           }  ?>
           

            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a></li>


        </ul> 

    </div>
    <div class="main_content">
        <div class="header"><?php  if (isset($_SESSION['username'])) {echo"You Are Welcome  "."  ".$user;} ?></div>  
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