<?php 

    
include('../config/dbconfig.php');
require_once("perpage.php");
$dbcon = new dbconfig();


    class accounts extends dbconfig
    {
       
        // View Database Record
        public function account_view_record()
        {
            $perPage = 10; 
            $page = 1;
            if(isset($_POST['page'])){
                $page = $_POST['page'];
            }
            $start = ($page-1)*$perPage;
            if($start < 0) $start = 0;
            global $dbcon;
            $query = "select * from account_ledger  limit " . $start . "," . $perPage;
            $result = mysqli_query($dbcon->connection,$query);
            $condition	=	'';
      
              
                if(isset($_POST['transtype']) and $_POST['transtype']!=""){
                    $transtype = trim($_POST['transtype']);
                    $condition	.=	' AND ac_trans_mode LIKE "%'.$transtype.'%" ';
                    $query1 = "SELECT * FROM account_ledger  WHERE ac_trans_mode like '%$transtype%'";
                    $result = mysqli_query($dbcon->connection,$query1);
                    
                }
                if(isset($_REQUEST['transname']) and $_REQUEST['transname']!=""){
                    $transname = trim($_POST['transname']);
                    $condition	.=	' AND trans_name LIKE "%'.$transmode.'%" ';
                    $query2 = "SELECT * FROM account_ledger  WHERE trans_name like '%$transname%'";
                    $result = mysqli_query($dbcon->connection,$query2);
                    
                }
                if(isset($_REQUEST['transdetail']) and $_REQUEST['transdetail']!=""){
                    $transdetail = trim($_POST['transdetail']);
                    $condition	.=	' AND ac_trans_details LIKE "%'.$transdetail.'%" ';
                    $query1= "SELECT * FROM account_ledger  WHERE ac_trans_details like '%$transdetail%'";
                    $result = mysqli_query($dbcon->connection,$query1);
                    
                }
                if(isset($_REQUEST['transamount']) and $_REQUEST['transamount']!=""){
                    $transamount = trim($_POST['transamount']);
                    $condition	.=	' AND ac_trans_details LIKE "%'.$transamount.'%" ';
                    $query1= "SELECT * FROM account_ledger  WHERE ac_amount ='$transamount'";
                    $result = mysqli_query($dbcon->connection,$query1);                    
                }
                
                if(isset($_REQUEST['fromdate']) and $_REQUEST['fromdate']!="" ){
                    $fdate=trim(strtotime($_POST['fromdate']));
                    $fromdate = mysqli_real_escape_string($dbcon->connection, date('Y-m-d', $fdate));
                    $tdate=trim(strtotime($_POST['todate']));
                    $todate = mysqli_real_escape_string($dbcon->connection, date('Y-m-d', $tdate));
                    $sql= "SELECT * FROM account_ledger  where ac_trans_date between '$fromdate' and '$todate'order by ac_trans_date";
                    $result = mysqli_query($dbcon->connection,$sql);   
                } 
        
                return $result;
          
        }

         // View Database Record
         public function account_search_record()
         {
             global $dbcon;            
             $condition	=	'';
             if(isset($_POST['submit'])){	
                if(isset($_REQUEST['username']) and $_REQUEST['username']!=""){
                    $username = trim($_POST['username']);
                    $condition	.=	' AND ac_trans_details LIKE "%'.$username.'%" ';
                    $query = "SELECT * FROM account_ledger  WHERE ac_trans_details like '%$username%'";
                    $result = mysqli_query($dbcon->connection,$query);
                    
                }
                return $result;
            }
         }

        // Get Particular Record
        public function account_get_record($id)
        {
            global $dbcon;
            $sql = "select * from employees where ID='$id'";
            $data = mysqli_query($dbcon->connection,$sql);
            return $data;

        }

       

      

    }




?>