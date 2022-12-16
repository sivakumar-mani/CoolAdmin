<?php 

    
require_once('../config/dbconfig.php'); 
$dbcon = new dbconfig();

    class category extends dbconfig
    {
        function getmaxid()
        {
            global $dbcon;          
$sql ="SELECT MAX(catid) FROM category";
            $result = mysqli_query($dbcon->connection, $sql);
                    $row = mysqli_fetch_row($result);
                    $highest_id = $row[0];
            return  $highest_id;
        }
         
    }

?>