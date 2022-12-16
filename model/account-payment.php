<?php 

    
require_once('../config/dbconfig.php'); 
$dbcon = new dbconfig();

    class accountPayment extends dbconfig
    {
        function getmaxid()
        {
            global $dbcon;          
$sql ="SELECT MAX(ac_trans_id) FROM account_ledger";
            $result = mysqli_query($dbcon->connection, $sql);
                    $row = mysqli_fetch_row($result);
                    $highest_id = $row[0];
            return  $highest_id;
        }
         
    }

?>