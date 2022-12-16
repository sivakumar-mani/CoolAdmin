<?php 

include_once('../config/config.php');
require_once('../common/page-top.php'); 
// include_once('../config/dbconfig.php');
// $db = new dbconfig();

// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
  
//     require_once('../model/dashboard_function.php'); 
//     $dbcon = new dashboard();
//     $availablebalance = $dbcon->available_balance();

//     require_once('../model/account_class.php'); 
//     $dbcon = new accounts();



// $credit_total = $dbcon->total_credit();
// $debit_total = $dbcon-> total_debit();
$credit_total =0;
$debit_total =0;



?>
<?php

$condition	=	'';
if(isset($_REQUEST['ac_trans_details']) and $_REQUEST['ac_trans_details']!=""){
    $condition	.=	' AND ac_trans_details LIKE "%'.$_REQUEST['ac_trans_details'].'%" ';
}
if(isset($_REQUEST['trans_name']) and $_REQUEST['trans_name']!=""){
    $condition	.=	' AND trans_name LIKE "%'.$_REQUEST['trans_name'].'%" ';
}
if(isset($_REQUEST['ac_amount']) and $_REQUEST['ac_amount']!=""){
    $condition	.=	' AND ac_amount LIKE "%'.$_REQUEST['ac_amount'].'%" ';
}

if(isset($_REQUEST['ac_trans_no']) and $_REQUEST['ac_trans_no']!=""){
    $condition	.=	' AND ac_trans_no LIKE "'.$_REQUEST['ac_trans_no'].'" ';
}

if(isset($_REQUEST['ac_trans_mode']) and $_REQUEST['ac_trans_mode']!=""){
    $condition	.=	' AND ac_trans_mode LIKE "%'.$_REQUEST['ac_trans_mode'].'%" ';
}

if((isset($_REQUEST['fromdate']) and $_REQUEST['fromdate']!="") && (isset($_REQUEST['todate']) and $_REQUEST['todate']!="")){
    $condition	.=	' AND ac_trans_date BETWEEN "'.$_REQUEST['fromdate'].'" AND "'.$_REQUEST['todate'].'" ';
}


// if((isset($_REQUEST['fromdate']) and $_REQUEST['fromdate']!="") || (isset($_REQUEST['todate']) and $_REQUEST['todate']!="")){
//     $condition	.=	' AND ac_trans_date LIKE "'.$_REQUEST['fromdate'].'"  ';
// }

// ------------- Debit total statement -----------

$qry = "SELECT SUM(ac_amount) AS count FROM account_ledger WHERE ac_trans_type='Debit'  ".$condition."";

$res = $dbcon->connection->query($qry);
$total = 0;
$rec =  $res->fetch_assoc();
$total = $rec['count'];

// ------------- Credit  total statement -----------


 //Main queries
 $pages->default_ipp	=	5;
 $sql 	= $db->getRecFrmQry("SELECT * FROM account_ledger WHERE 1 ".$condition."");
 $pages->items_total	=	count($sql);
 $pages->mid_range	=	9;
 $pages->paginate(); 
$accountData	=   $db->getRecFrmQry("SELECT * FROM account_ledger WHERE 1 ".$condition." ORDER BY ac_trans_id DESC ".$pages->limit."");

// $qry1 = "SELECT SUM(ac_amount) AS total  FROM account_ledger WHERE ac_trans_type='Credit' ".$pages->limit."";

$qry1 = "SELECT SUM(ac_amount) AS total FROM account_ledger WHERE ac_trans_type='Credit' ".$pages->limit."";

$res1 = $dbcon->connection->query($qry1);
$ctotal = 0;
$rec1 =  $res1->fetch_assoc();
$ctotal = $rec1['total'];

?>

<body class="animsition">

    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php require_once('../common/header.php');  ?>
        <!-- END HEADER MOBILE-->
        <!-- MENU SIDEBAR-->
        <?php require_once('../common/sidebar.php');  ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->

            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1 pb-3">Accounts Ledger</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-search"></i> <strong>Search</strong> <a
                                    href="../view/account-add-transaction.php" class="float-right btn btn-dark btn-sm"><i
                                        class="fa fa-fw fa-plus-circle"></i> Add Transaction</a></div>

                            <div class="card-body">

                            <?php require_once('../common/message.php');  ?>

                                <div class="col-sm-12">
                                    <form method="get">

                                        <div class="row">

                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Transanction Details</label>

                                                    <input type="text" name="ac_trans_details" id="ac_trans_details"
                                                        class="form-control"
                                                        value="<?php echo isset($_REQUEST['ac_trans_details'])?$_REQUEST['ac_trans_details']:''?>"
                                                        placeholder="Transanction Details">

                                                </div>

                                            </div>
                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Amount</label>

                                                    <input type="text" class="tel form-control" name="ac_amount"
                                                        id="ac_amount"
                                                        value="<?php echo isset($_REQUEST['ac_amount'])?$_REQUEST['ac_amount']:''?>"
                                                        placeholder="Enter amount">

                                                </div>

                                            </div>
                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Bank / App Name</label>

                                                    <input type="text" name="trans_name" id="trans_name"
                                                        class="form-control"
                                                        value="<?php echo isset($_REQUEST['trans_name'])?$_REQUEST['trans_name']:''?>"
                                                        placeholder="Enter Bank / App Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Transancation No</label>

                                                    <input type="text" class="tel form-control" name="ac_trans_no"
                                                        id="ac_trans_no"
                                                        value="<?php echo isset($_REQUEST['ac_trans_no'])?$_REQUEST['ac_trans_no']:''?>"
                                                        placeholder="Enter transaction Number">

                                                </div>

                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="comp_number">Transaction Type</label>
                                                    <input type="text" list="docs" class="tel form-control"
                                                        name="ac_trans_mode" id="ac_trans_mode"
                                                        value="<?php echo isset($_REQUEST['ac_trans_mode'])?$_REQUEST['ac_trans_mode']:''?>"
                                                        placeholder="Enter transaction Type">
                                                    <!-- <input type="text"  class="form-control" /> -->
                                                    <datalist id="docs">
                                                        <option>Net Banking</option>
                                                        <option>Cash</option>
                                                        <option>CHEQUE</option>
                                                        <option>Merchant App</option>
                                                        <option>Others</option>
                                                    </datalist>

                                                </div>
                                            </div>
                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>From Date</label>

                                                    <input type="date" class="tel form-control" name="fromdate"
                                                        id="fromdate"
                                                        value="<?php echo isset($_REQUEST['fromdate'])?$_REQUEST['fromdate']:''?>"
                                                        placeholder="Select from Date">

                                                </div>

                                            </div>
                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>To date</label>

                                                    <input type="date" class="tel form-control" name="todate"
                                                        id="todate"
                                                        value="<?php echo isset($_REQUEST['todate'])?$_REQUEST['todate']:''?>"
                                                        placeholder="Select to Date">

                                                </div>

                                            </div>
                                            <div class="col-sm-3">
                                            <label>&nbsp;</label>
                                                <div class="form-group">

                                                   

                                                    <div class="d-flex justify-content-between w-100">

                                                        <button type="submit" name="submit" value="search" id="submit"
                                                            class="btn btn-primary"><i class="fa fa-fw fa-search"></i>
                                                            Search</button>

                                                        <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                            class="btn btn-danger"><i class="fa fa-fw fa-sync"></i>
                                                            Clear</a>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <div class="row marginTop">
                            <div class="col-sm-12 paddingLeft pagerfwt">
                                <?php if($pages->items_total > 0) { ?>
                                <?php echo $pages->display_pages();?>
                                <?php echo $pages->display_items_per_page();?>
                                <?php echo $pages->display_jump_menu(); ?>
                                <?php }?>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="mt-2 mb-3">

                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr class="bg-secondary text-white">
                                        <th colspan="2">Available Balance : Rs. <?php echo $availablebalance; ?></th>
                                       
                                        <th >Total Debit :Rs. <?php echo $debit_total; ?></th>
                                        <!-- <th >Total Debit :Rs. <?php echo $debit_total ." / ". $total; ?></th> -->
                                        <th colspan="2">Total Credit :Rs. <?php echo $credit_total  ." / ".  $ctotal; ?></th>
                                        <?php if( $_SESSION['adminlevel']==1 ) :?>
                                       
                                        <?php endif ?>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <!-- <th>Trans ID</th> -->
                                        <th>Date</th>
                                        <th>Transaction Description</th>
                                        <th>Transaction Particular</th>
                                        <th>Debit / Credit</th>
                                        <?php if( $_SESSION['adminlevel']==1 || $_SESSION['adminlevel']==0  ) :?>
                                        <th class="text-center" width="80">Action</th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($accountData)>0){
                                            $s	=	'';
                                            foreach($accountData as $val){
                                                $s++;
                                            
                                        ?>
                                    <tr>

                                        <!-- <td><?php echo $val['ac_trans_id'];?></td> -->
                                        <td width="120"><?php $acdate = date('d-m-Y', strtotime($val['ac_trans_date'])); echo $acdate;?></td>
                                        <td width="500"><?php echo $val['ac_trans_details'];?></td>
                                        <td> <span class="ft-bold ft-c-gray">Mode of Trans: </span> <?php echo $val['ac_trans_mode'];?><br>
                                        <span class="ft-bold ft-c-gray">Mode of Type: </span> <?php echo $val['trans_name']  ;?><br>
                                        <span class="ft-bold ft-c-gray">Trans Number: </span> <?php echo $val['ac_trans_no'] ;?>
                                        </td>
                                        <td align="right">
                                            
                                            <?php 
                if($val['ac_trans_type']=='Debit')
                    {
                        echo "<span class='ft-c-red'>". $val['ac_amount'] ."</span>";
                    }  
                if ($val['ac_trans_type'] =="Credit")
                    {
                        echo $val['ac_amount']; 
                    }?>
                                        </td>
                                      
                                        <td align="center" style="vertical-align:middle !important">
                                        <?php if( ($_SESSION['adminlevel']==1) &&  ( $val['ac_channel'] !='external') ) :?>
                                            <a href="account-edit-transaction.php?editId=<?php echo $val['ac_trans_id'];?>"
                                                class="text-primary ml-2 mr-2"><i class="fa fa-fw fa-edit"></i></a>
                                           <?php endif ?>
                                           <?php if( $_SESSION['adminlevel']==0 ) :?>       |
                                            <a href="../model/account-delete.php?delId=<?php echo $val['ac_trans_id'];?>"
                                                class="text-danger ml-2 mr-2"
                                                onClick="return confirm('Are you sure to delete this user?');"><i
                                                    class="fa fa-fw fa-trash"></i> </a>
                                                    <?php endif ?>
                                        </td>
                                    </tr>
                                    <?php 
            }
        }else{
        ?>
                                    <tr>
                                        <td colspan="5" align="center">No Record(s) Found!</td>
                                    </tr>
                                    <?php } ?>
                                    <tr class="bg-secondary text-white">
                                        <th colspan="2">Available Balance : Rs. <?php echo $availablebalance; ?></th>
                                       
                                        <th >Total Debit :Rs. <?php echo $total; ?></th>
                                        <th colspan="2">Total Credit :Rs. <?php echo $ctotal; ?></th>
                                        <?php if( $_SESSION['adminlevel']==1 ) :?>
                                       
                                        <?php endif ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--/.col-sm-12-->

                        <div class="clearfix"></div>

                        <div class="row marginTop">
                            <div class="col-sm-12 paddingLeft pagerfwt">
                                <?php if($pages->items_total > 0) { ?>
                                <?php echo $pages->display_pages();?>
                                <?php echo $pages->display_items_per_page();?>
                                <?php echo $pages->display_jump_menu(); ?>
                                <?php }?>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>



                        <!-- END FOOTER CONTENT-->
                        <?php require_once('../common/footer.php');  ?>
                        <!-- END FOOTER CONTAINER-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

    </div>

    <?php require_once('../common/page-bottom.php');  ?>
</body>

</html>
<!-- end document-->