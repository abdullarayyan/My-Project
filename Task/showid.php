<?PHP
 session_start();
 global $id;

 interface dbconn{

     public function getuser();

 }
 class userid implements dbconn{
     public function getuser(){
     include('sqlconn.php');
     global $id,$user;
     $result = $mysqli->query("SELECT * FROM user WHERE id>='20' ");
     $sql = "SELECT id, username, email FROM user where id>='100'";
     $result = $mysqli->query($sql);
     
     if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
         echo '<table style="width:1%">' .  '<tr>'.
        '<th>id</th>'.'<th>'. $row["id"].'</th>'.

        '<th>name-</th>'.'<th>'. $row["username"].'</th>'.

        '<th>email-</th>'.'<th>'. $row["email"].'</th>'.

         '</tr>'.'</table>'
         ;
       }
     } else {
       echo "0 results";
     }
     }
    }

     $userid=new userid();
     $userid->getuser();
     //print_r($userid);

?>