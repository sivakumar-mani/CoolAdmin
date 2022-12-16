<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
    require_once('../model/account_class.php'); 
// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
   
    if(isset($_REQUEST['vid']) and $_REQUEST['vid']!=""){
        $row	=	$db->getAllRecords('vendor_details','*',' AND vendorid="'.$_REQUEST['vid'].'"');   
    }

    if(isset($_GET['invid'])){
        $pinvData	=	$db->getAllRecords('purchased_invoice','*',' AND invoiceid="'.$_GET['invid'].'"');   
    }
    if(isset($_GET['invid']) && isset($_GET['vid'])){
        $paytData	=	$db->getAllRecords('purchase_payment','*',' AND invoiceid="'.$_GET['invid'].'" AND vendorid="'.$_GET['vid'].'"');   
    }

   
    if(isset($_GET['invid'])){
        $invno = $_GET['invid'];
    $sql ="select sum(totalprice) AS totalinvoice FROM purchased_items_inventory where invoiceid = '$invno' ";
    $tinvoice =	mysqli_query($dbcon->connection, $sql);
    $record = $tinvoice->fetch_array();
    $totalinvoice = $record['totalinvoice'];
   

    $sql1 ="select  sum(cgst + sgst) AS totgst  FROM purchased_items_inventory where invoiceid = '$invno' ";
    $credit =	mysqli_query($dbcon->connection, $sql1);
    $record1 = $credit->fetch_array();
    $totalgst = $record1['totgst'];

    $sql2 ="select  sum(discount) AS totdiscount  FROM purchased_items_inventory where invoiceid = '$invno' ";
    $tdiscount =	mysqli_query($dbcon->connection, $sql2);
    $record2 = $tdiscount->fetch_array();
    $totaldiscount = $record2['totdiscount'];
}
    ?>

<?php 
    $editFlag = false;
    $transdate="";
    $transmode="";
    $transname="";
    $transno="";
    $transamount="";
    $getInvoice =$invno;
    $vendorulid=$_GET['vid'];

    if(isset($_GET['ppid'])){
        $editFlag = true;
        $getdata	=	$db->getAllRecords('purchase_payment','*',' AND ppid="'.$_REQUEST['ppid'].'"');
        $transdate   = $getdata[0]['trans_date'];
        $transmode = $getdata[0]['trans_mode'];
        $transname = $getdata[0]['trans_name'];
        $transno = $getdata[0]['ac_trans_no'];
        $transamount = $getdata[0]['ac_amount'];
        $geActTranId = $getdata[0]['ac_trans_id'];
        // $ivid = $getdata[0]['ivid'];
        // // $itemid = $getdata[0]['itemid'];
    }



    if(isset($_POST['update'])){
        $vendorid = $row[0]['vendorid'];
        $ppid = $_GET['ppid'];
        $invid = $_GET['invid'];
      
        $data	=	array( 
                'trans_date'=>$_POST['transdate'],
                'trans_mode'=>trim($_POST['transmode']),                
                'trans_name'=>trim($_POST['transname']),
                'ac_trans_no'=>trim($_POST['transno']),               
                'ac_amount'=>trim($_POST['transamount']),
            );

          
            $data1	=	array( 
                'ac_trans_date'=>$_POST['transdate'],
                'ac_trans_mode'=>trim($_POST['transmode']),                
                'trans_name'=>trim($_POST['transname']),
                'ac_trans_no'=>trim($_POST['transno']),               
                'ac_amount'=>trim($_POST['transamount']),
            );

            
        $update	=	$db->update('purchase_payment',$data,array('ppid'=>$ppid));
        $update	=	$db->update('account_ledger',$data1,array('ac_trans_id'=>$geActTranId));

        if($update){
            header('location:purchase-payment.php?invid='.$invid.'&vid='. $vendorid.'&msg=upok');
                exit;
            }else{
                header('location:purchase-payment.php?invid='.$invid.'&vid='. $vendorid.'&msg=upnook');
                exit;
            }
       
    }

    if(isset($_POST['save'])){
        $vendorid = $_GET['vid'];
        $invid = $_GET['invid'];

        $ac_trans_details = "Payment made to "."<strong> ".$row[0]['vendorcompanyname']. "</strong> :" .$vendorid. " for the invoice code:" .$invid." ". " and invoice number: ".isset($pinvData[0]['invoiceno']) . "Bill Numbwer: " .isset($pinvData[0]['bill']);

        $data1	=	array(
            'ac_trans_date'=>$_POST['transdate'],
            'ac_trans_type'=>'Debit',
            'ac_trans_mode'=>trim($_POST['transmode']),                
            'trans_name'=>trim($_POST['transname']),
            'ac_trans_details'=>$ac_trans_details,
            'ac_trans_no'=>trim($_POST['transno']),
            'ac_channel'=>'external',                       
            'ac_amount'=>trim($_POST['transamount']),
            );
            $insert	=	$db->insert('account_ledger',$data1);


        $dbcon = new accounts();
        $maxAcTransId = $dbcon->acGetMaxid();

		$ppCount	=	$db->getQueryCount('purchase_payment','ppid');      
        if($ppCount[0]['total']==0){
            echo   $ppid = "PPI1";            
           } else {
            require_once('../model/purchase-payment.php'); 
            $dbcon = new purchasedPayment();
                 $hid = $dbcon->getmaxid() +1;
            echo  $purchaseid = "PPI" . $hid;
           }

        //    require_once('../model/account-payment.php'); 
        //    $dbcon = new accountPayment();
        //         $achid = $dbcon->getmaxid() +1;
        //    echo  $achid;

      
    
			$data	=	array(
                'invoiceid'=>$invid,
                'vendorid'=>$vendorid,            
                'ac_trans_id'=>$maxAcTransId,
                'trans_date'=>$_POST['transdate'],
                'trans_type'=>'Debit',
                'trans_mode'=>trim($_POST['transmode']),                
                'trans_name'=>trim($_POST['transname']),
                'ac_trans_no'=>trim($_POST['transno']),               
                'ac_amount'=>trim($_POST['transamount']),
                );

               
           
                    $data2	=	array(
                        'paidamount'=>$pinvData[0]['paidamount'] + trim($_POST['transamount']),
                        );
                       
			$insert	=	$db->insert('purchase_payment',$data);
          
         
           
        if($insert){
     
            header('location:purchase-payment.php?invid='.$invid.'&vid='. $vendorid.'&msg=saveok');
          
            exit;
        }else{
            header('location:purchase-payment.php?invid='.$invid.'&vid='. $vendorid.'&msg=saveok');
            exit;
		}
    // }
    // else {
    //     header('location:purchased-invoice.php?vid='.$vendorid.'&msg=matchinvoice');
    //     exit;
    // }
	}


   
?>

<body class="animsition">

    <div class="page-wrapper piv">

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
                                    <h2 class="title-1 pb-2">Add Payment Details</h2>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-0">
                            <div class="card-body p-0">
                                <?php  require_once('../common/message.php'); ?>
                            </div>

                            <form method="post">
                                <div class="col-sm-12 bg-light">
                                    <div class="row mt-2 mb-2">

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Transanction Date</label>
                                                <input type="date" name="transdate" id="transdate" class="form-control"
                                                value="<?php echo  $transdate; ?>"   placeholder="Enter user name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Transaction Mode</label>
                                                <select class="form-control" id="transmode" name="transmode" required>
                                                    <option value="<?php echo  $transmode; ?>"><?php echo  $transmode; ?></option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Merchant App">Merchant App</option>
                                                    <option value="Net Banking">Net Banking</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Bank Name / App Name</label>
                                                <input type="text" name="transname" id="transname" class="form-control"
                                                value="<?php echo  $transname; ?>"   placeholder="Enter Bank Name / App Name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2 mb-2">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Transanction / Cheque / Cash Voucher No</label>
                                                <input type="text" name="transno" id="transno" class="form-control"
                                                value="<?php echo  $transno; ?>"  placeholder="Enter Transanction number" required>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Transanction Amount</label>
                                                <input type="text" name="transamount" id="transamount"
                                                value="<?php echo  $transamount; ?>"   class="form-control" placeholder="Enter Transanction Amount"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="d-flex justify-content-end">

                                                    <?php if ($editFlag == false):?>
                                                    <button type="submit" name="save" value="save" id="save"
                                                        class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>
                                                        Add</button>
                                                    <?php else: ?>
                                                    <button type="submit" name="update" value="update" id="update"
                                                        class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>
                                                        Update</button>
                                                    <?php endif ?>

                                                    <a href="purchase-payment.php?vid=<?php echo $vendorulid;?>&invid=<?php echo $getInvoice;?>"
                                                class="btn btn-danger ml-2 mr-2"><i class="fa fa-fw fa-sync"></i></a>
                                                    <!-- <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                        class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> -->
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <h2 class="title-1 pt-2 pb-2 bg-dark ft-c-white pl-2"> Invoice Payment Details</h2>
                        <div class="card mb-0">

                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">


                                    <div class="col-sm-12">
                                        <div class="row pt-3 pb-3">
                                            ` <div class="col">
                                                <h6>Vendor Number: <span
                                                        class="ft-c-blue"><?php  echo isset($row[0]['vendorid'])?$row[0]['vendorid']:''; ?></span>
                                                </h6>
                                                <h3 class="ft-c-blue upperCase pt-1 pb-1">
                                                    <?php  echo isset($row[0]['vendorcompanyname'])?$row[0]['vendorcompanyname']:''; ?>
                                                </h3>
                                                <h4>Properitor: <span
                                                        class="ft-c-blue"><?php  echo isset($row[0]['vendorname'])?$row[0]['vendorname']:''; ?></span>
                                                </h4>
                                                <p><?php  echo isset($row[0]['vendoraddress'])?$row[0]['vendoraddress']:''; ?>
                                                </p>
                                                <p><?php  echo isset($row[0]['city'])?$row[0]['city']:''; ?> ,
                                                    <?php  echo isset($row[0]['state'])?$row[0]['state']:''; ?> ,
                                                    Pincode -
                                                    <?php  echo isset($row[0]['pincode'])?$row[0]['pincode']:''; ?> .
                                                </p>
                                                <p>
                                                    Mobile No : <span
                                                        class="ft-c-blue"><?php  echo isset($row[0]['mobile'])?$row[0]['mobile']:''; ?>,
                                                        <?php  echo isset($row[0]['mobile1'])?$row[0]['mobile1']:''; ?></span>
                                                </p>
                                                <p>
                                                    eMail : <span
                                                        class="ft-c-blue"><?php  echo isset($row[0]['emailid'])?$row[0]['emailid']:''; ?></span>
                                                </p>


                                            </div>
                                            <div class="col box-ralign text-right">
                                                <p class="mr-auto">
                                                <p>
                                                <h1>INVOICE PAYMENT</h1>
                                                <p class="pay-title">
                                                <p>
                                                    <br>
                                                <h4>Invoice Date : <span
                                                        class="ft-c-blue"><?php $idate =date('d-m-yy', strtotime($pinvData[0]['invoicedate'])); echo $idate; ?></span>
                                                </h4>
                                                <h4 class="pt-2"> Invoice Number : <span
                                                        class="ft-c-blue"><?php  echo isset($pinvData[0]['invoiceno'])?$pinvData[0]['invoiceno']:''; ?></span>
                                                </h4>
                                                <h4 class="pt-2"> Bill Number : <span
                                                        class="ft-c-blue"><?php  echo isset($pinvData[0]['billno'])?$pinvData[0]['billno']:''; ?></span>
                                                </h4>
                                                <span class="ft-c-red">Invoice Number -
                                                    <?php  echo $_GET['invid']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="mb-3">

                            <table class="table table-striped table-bordered">
                                <thead>

                                    <tr class="bg-primary text-white">
                                        <th width="50">S.No </th>
                                        <th width="120">Date</th>
                                        <th width="600">Payment Details</th>
                                        <th>Amount</th>                                       
                                        <th class="text-center" width="50">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                if(count($paytData)>0){
                    $s	=	'';
                  
                    $ttoltal=0;
                    foreach($paytData as $val){
                        $s++;
                       
                ?>
                                    <tr>

                                        <td class="text-center"><?php echo $s;?></td>
                                       
                                        <td class="text-center"><?php $tdate = date('d-m-yy', strtotime($val['trans_date'])); echo $tdate;?></td>
                                        <td> <?php echo $val['trans_type'] . " " ." ". " ".$val['trans_mode'].   " "." "." ".$val['trans_name'] ." ". " ". " ". $val['ac_trans_no'] ;?></td>
                                      
                                        <td class="text-right">
                                        <?php $ttoltal += $val['ac_amount']; echo number_format($val['ac_amount'],2, '.',',');?>
                                        </td>
                                       

                                        <td align="center">



                                            <?php if( $_SESSION['adminlevel']>=1 ) :?>
                                            <!-- <a href="employee-view.php?empid=<?php echo $val['ivid'];?>"
                        class="text-primary ml-2 mr-2"><i
                            class="fa fa-fw fa-eye"></i></a><br><br> -->
                                            <a href="purchase-payment.php?vid=<?php echo $val['vendorid'];?>&invid=<?php echo $getInvoice;?>&ppid=<?php echo $val['ppid'];?>"
                                                class="text-primary ml-2 mr-2"><i class="fa fa-fw fa-edit"></i></a>

                                            <?php endif ?>
                                            <?php if( $_SESSION['adminlevel']==0 ) :?>
                                            <a href="" class="text-danger ml-2 mr-2"
                                                onClick="return confirm('Are you sure to delete this user?');"><i
                                                    class="fa fa-fw fa-trash"></i> </a>

                                        </td>
                                        <?php endif ?>

                                    </tr>

                                    <?php 
}
}else{
?>
                                    <tr>
                                        <td colspan="5" align="center">No Record(s) Found!</td>
                                    </tr>
                                    <?php   }?>
                                    <tr class="bg-transparent">
                                        <td colspan="2" class=""></td>
                                        <td colspan="1" class="bg-l-gray text-right"><span class="sum-text">Total</span>
                                        </td>
                                        <td colspan="1" class="bg-l-gray text-right ft-bld ft-s-16">
                                            <?php  if (isset($ttoltal)) { 
                                                echo number_format($ttoltal,2,'.',',');
                                                } ?></td>
                                        <td></td>
                                    </tr>
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="clearfix"></div>




                    <!--/.col-sm-12-->

                    <div class="clearfix"></div>

                    <div class="row marginTop">
                        <div class="col-sm-12 pl-5 pr-5 mb-5 paddingLeft pagerfwt">
                            <?php if($pages->items_total > 0) { ?>
                            <?php echo $pages->display_pages();?>
                            <?php echo $pages->display_items_per_page();?>
                            <?php echo $pages->display_jump_menu(); ?>
                            <?php }?>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="d-flex justify-content-center w-100">
                        <a href="purchased-invoice.php?vid=<?php echo $row[0]['vendorid'];?>" class="btn btn-dark w-25">Back</a>

                        </div>
                    </div>
                </div>

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