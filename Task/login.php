<?php
session_start();


?>




<!DOCTYPE html>
<html>
  <title></title>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

  </head>
  <body>
  <form action="index.php" method="POST">
      <h1>LOGIN ADMIN</h1>
      <div class="icon">
        <i class="fas fa-user-circle"></i>
      </div>
      <div class="formcontainer">
      <div class="container">
        <label for="uname"><strong>Username</strong></label>
        <input type="text" placeholder="Enter Username" name="username" required>
       
        <label for="psw"><strong>Password</strong></label>
        <input type="password" placeholder="Enter Password" name="password" required>
      </div>
      <button type="submit"><strong>LOGIN</strong></button>
      </div>
  </body>
</html>