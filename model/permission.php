<?php 

    
require_once('../config/dbconfig.php'); 
$dbcon = new dbconfig();

    class permission extends dbconfig
    {
        function permits()
        {
            global $dbcon;
          

            $sql ="select * FROM user_permission";
            $dept =	mysqli_query($dbcon->connection, $sql);
            $all = $dept->fetch_array();
            return  $all;
        }
    }

?>