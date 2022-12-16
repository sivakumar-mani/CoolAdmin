<?php 

    
require_once('../config/dbconfig.php'); 
$db = new dbconfig();

   
           // We don't have the password or email info stored in sessions so instead we can get the results from the database.
            $stmt = $db->connection->prepare('SELECT userid, userfname, userlname, useremail, userpassword FROM login_user WHERE userid = ?');
            // In this case we can use the account ID to get the account info.
            $stmt->bind_param('i', $_SESSION['userid']);
            $stmt->execute();
            $stmt->bind_result($userid,$fname, $lname, $email, $password);
            $stmt->fetch();
            $stmt->close();
       
?>