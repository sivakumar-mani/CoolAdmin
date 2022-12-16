<?php 

    
require_once('../config/dbconfig.php'); 
$dbcon = new dbconfig();

    class purchased extends dbconfig
    {
        function getmaxid()
        {
            global $dbcon;          
$sql ="SELECT MAX(ipid) FROM purchased_items_inventory";
            $result = mysqli_query($dbcon->connection, $sql);
                    $row = mysqli_fetch_row($result);
                    $highest_id = $row[0];
            return  $highest_id;
        }
         
    }

?>