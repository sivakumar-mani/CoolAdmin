<?php 

    
require_once('../config/dbconfig.php'); 
$dbcon = new dbconfig();

    class dashboard extends dbconfig
    {
        // total number of complaints
        function total_count()
        {
            global $dbcon;
            $sql ="select * from complaint_register";
            $count =mysqli_query($dbcon->connection, $sql);
            $result =mysqli_num_rows($count);
            return $result;
        }

         // total open status of complaints

        function open_status_count()
        {
            global $dbcon;
            $sqlA ="select * from complaint_register where comp_status = 'Open'";
            $countA =mysqli_query($dbcon->connection, $sqlA);
            $openstatuscount =mysqli_num_rows($countA);
            return $openstatuscount;
        }


         // total completed status of complaints

         function completed_status_count()
         {
             global $dbcon;
             $sqlB ="select * from complaint_register where comp_status = 'Completed'";
             $countB =	mysqli_query($dbcon->connection, $sqlB);
             $completedcount =mysqli_num_rows($countB); 
             return $completedcount;
         }

     
         // total assigned status of complaints
          function assigned_status_count()
          {
              global $dbcon;
              $sqlC ="select * from complaint_register where comp_status = 'Assigned'";
              $countC =	mysqli_query($dbcon->connection, $sqlC);
              $assignedcount =mysqli_num_rows($countC); 
              return $assignedcount;
          }

          function pending_status_count()
          {
              global $dbcon;
              $sqlC ="select * from complaint_register where comp_status = 'Pending'";
              $countC =	mysqli_query($dbcon->connection, $sqlC);
              $assignedcount =mysqli_num_rows($countC); 
              return $assignedcount;
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
            function today_debit()
            {
                global $dbcon;
                // $cdate = date("Y-m-d");
                $cdate = date("Y-m-d", strtotime("yesterday"));
                $sqla ="select sum(ac_amount) AS totaldebit FROM account_ledger where ac_trans_type = 'Debit' AND ac_trans_date = '$cdate'";
                $debit =	mysqli_query($dbcon->connection, $sqla);
                $recorddebit = $debit->fetch_array();
                $totaldebit1 = $recorddebit['totaldebit'];
                return  $totaldebit1;
            }

            function today_credit()
            {
                global $dbcon;
                // $cdate = date("Y-m-d");
                $cdate = date("Y-m-d", strtotime("yesterday"));
                $sqla1 ="select sum(ac_amount) AS totalcredit FROM account_ledger where ac_trans_type = 'Credit' AND ac_trans_date = '$cdate'";
                $cdebit =	mysqli_query($dbcon->connection, $sqla1);
                $recordcredit = $cdebit->fetch_array();
                $totaldebit2 = $recordcredit['totalcredit'];
                return  $totaldebit2;
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