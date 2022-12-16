<?php 

    
require_once('../config/dbconfig.php'); 
$dbcon = new dbconfig();

    class accounts extends dbconfig
    {
        function total_debit()
        {
            global $dbcon;
          

            $sqla ="select sum(ac_amount) AS totaldebit FROM account_ledger where ac_trans_type = 'Debit'";
            $debit =	mysqli_query($dbcon->connection, $sqla);
            $recorddebit = $debit->fetch_array();
            $totaldebit = $recorddebit['totaldebit'];
            return  $totaldebit;
        }
        function total_credit()
        {
            global $dbcon;
            $sql ="select sum(ac_amount) AS totalcredit FROM account_ledger where ac_trans_type = 'Credit'";
            $credit =	mysqli_query($dbcon->connection, $sql);
            $record = $credit->fetch_array();
            $totalcredit = $record['totalcredit'];

          
            return  $totalcredit;
        }

             // total balance form account ledger table status of complaints
        function available_balance()
            {
                global $dbcon;
                $sql ="select sum(ac_amount) AS totalcredit FROM account_ledger where ac_trans_type = 'Credit'";
                $credit =	mysqli_query($dbcon->connection, $sql);
                $record = $credit->fetch_array();
                $totalcredit = $record['totalcredit'];

                $sqla ="select sum(ac_amount) AS totaldebit FROM account_ledger where ac_trans_type = 'Debit'";
                $debit =	mysqli_query($dbcon->connection, $sqla);
                $recorddebit = $debit->fetch_array();
                $totaldebit = $recorddebit['totaldebit'];
               
                $totalbalance = $totalcredit- $totaldebit;
                return  $totalbalance;
            }

            // total working employees
        function total_employee()
        {
            global $dbcon;
            $sql ="select * from employee where emp_status = 'Working'";
            $totemp =mysqli_query($dbcon->connection, $sql);
            $totalemp =mysqli_num_rows($totemp);
            return $totalemp;
        }

          // total ressigned employees
          function total_ressigned_employee()
          {
              global $dbcon;
              $sql ="select * from employee where emp_status = 'Resigned'";
              $totemp =mysqli_query($dbcon->connection, $sql);
              $totalresignemp =mysqli_num_rows($totemp);
              return $totalresignemp;
          }

            
    }

?>