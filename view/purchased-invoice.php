<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
   
    if(isset($_REQUEST['vid']) and $_REQUEST['vid']!=""){
        $row	=	$db->getAllRecords('vendor_details','*',' AND vendorid="'.$_REQUEST['vid'].'"');   
    }
    ?>

<?php 
    $editFlag = false;
    $invoiceid ="";
    $invoicedate ="";
    $invoiceno ="";
    $paidamount ="";
    $billno ="";



    if(isset($_GET['ivid'])){
        $editFlag = true;
        $getdata	=	$db->getAllRecords('purchased_invoice','*',' AND ivid="'.$_REQUEST['ivid'].'"');
        $invoiceid = $getdata[0]['invoiceid'];
        $invoicedate = $getdata[0]['invoicedate'];
        $invoiceno = $getdata[0]['invoiceno'];
        $billno = $getdata[0]['billno'];
        // $ivid = $getdata[0]['ivid'];
        // // $itemid = $getdata[0]['itemid'];
    }



    if(isset($_POST['update'])){
        $vendorid = $row[0]['vendorid'];
        $invoiceid = $_GET['ivid'];
        // $matchdata	=	$db->getQueryCount('purchased_invoice','*',' AND invoiceno="'. $invoiceno.'"');
        // if($matchdata[0]['total']==0){
            $folder ="../assets/images/purchaseInvoice/";
            if(isset($_FILES['supportdocs']['name']) and $_FILES['supportdocs']['name']!=""){
                $file_name=$_FILES['supportdocs']['name'];
            }else {
             $file_name =$getdata[0]['docsname'];
            }
 
            $errors= array();        
         $file_size = $_FILES['supportdocs']['size'];
         $file_tmp = $_FILES['supportdocs']['tmp_name'];
         $file_type = $_FILES['supportdocs']['type'];
         $tmp = explode('.', $file_name);
         $file_ext=end($tmp);
         $newfilename = round(microtime(true)) . '.' . end($temp);
         $extensions= array("pdf","jpeg","jpg","png","doc","docx", "xls");
         
         if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
         }
         
         if($file_size > 2097152) {
            $errors[]='File size must be excately 2 MB';
         }
         
         if(empty($errors)==true) {
            move_uploaded_file($file_tmp,"../assets/images/purchaseInvoice/".$file_name);           
         }else{
            print_r($errors);
         }
        $ivid =$_GET['ivid'];
        $data	=	array(          
            'invoicedate'=>$_POST['invoicedate'],
            'invoiceno'=>trim($_POST['invoiceno']),
            'billno'=>trim($_POST['billno']),
            'docsname'=>$file_name,
            );
        $update	=	$db->update('purchased_invoice',$data,array('ivid'=>$invoiceid));

        if($update){
            header('location:purchased-invoice.php?vid='.$vendorid.'&msg=upok');
                exit;
            }else{
                header('location:purchased-invoice.php?vid='.$vendorid.'&msg=upnotok');
                exit;
            }
       
    }

    if(isset($_POST['save'])){
        $vendorid = $row[0]['vendorid'];
        $invoiceno = $_POST['invoiceno'];
        $matchdata	=	$db->getQueryCount('purchased_invoice','*',' AND invoiceno="'.$invoiceno.'"');
        if($matchdata[0]['total']==0){
		$invoiceCount	=	$db->getQueryCount('purchased_invoice','ivid');

        if($invoiceCount[0]['total']==0){
            echo   $invoiceid = "INV1";
           } else {
            require_once('../model/invoice_class.php'); 
            $dbcon = new invoice();
                 $hid = $dbcon->getmaxid() +1;
            echo  $invoiceid = "INV" . $hid;
           }

           $folder ="../assets/images/purchaseInvoice/";
           if(isset($_FILES['supportdocs']['name']) and $_FILES['supportdocs']['name']!=""){
               $file_name=$_FILES['supportdocs']['name'];
           }else {
            $file_name =Null;
           }

           $errors= array();        
        $file_size = $_FILES['supportdocs']['size'];
        $file_tmp = $_FILES['supportdocs']['tmp_name'];
        $file_type = $_FILES['supportdocs']['type'];
        $tmp = explode('.', $file_name);
        $file_ext=end($tmp);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $extensions= array("pdf","jpeg","jpg","png","doc","docx", "xls");
        
        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 2097152) {
           $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true) {
           move_uploaded_file($file_tmp,"../assets/images/purchaseInvoice/".$file_name);           
        }else{
           print_r($errors);
        }

        $vendorcompanyname = $row[0]['vendorcompanyname'];
			$data	=	array(
                'invoiceid'=>$invoiceid,
                'vendorid'=>$vendorid,
                'vendorcompanyname'=>$vendorcompanyname,               
                'invoicedate'=>$_POST['invoicedate'],
                'invoiceno'=>trim($_POST['invoiceno']),
                'billno'=>trim($_POST['billno']),
                'totalinvoiceamount'=>0,
                'totaldiscount'=>0,
                'totalgst'=>0,
                'docspath'=>$folder,
                'docsname'=>$file_name,
                
                );

			$insert	=	$db->insert('purchased_invoice',$data);

        if($insert){
            // header('location:purchased-invoice.php?msg=ras');
            header('location:purchased-invoice.php?vid='.$vendorid.'&msg=saveok');
          
            exit;
        }else{
            header('location:purchased-invoice.php?vid='.$vendorid.'msg=savenotok');
            exit;
		}
    }
    else {
        header('location:purchased-invoice.php?vid='.$vendorid.'&msg=matchinvoice');
        exit;
    }
	}

    $condition	=	'';
    if(isset($_GET['vid'])){
        $condition	.=	' AND vendorid LIKE "'.$_GET['vid'].'" ';
    }
    $pages->default_ipp	=	15;
    $sql 	= $db->getRecFrmQry("SELECT * FROM purchased_invoice WHERE 1 ".$condition."");
    $pages->items_total	=	count($sql);
    $pages->mid_range	=	9;
    $pages->paginate(); 
    


    
    $invData	=   $db->getRecFrmQry("SELECT * FROM purchased_invoice WHERE 1".$condition." ORDER BY invoiceid ASC ".$pages->limit."");

    $payData	=   $db->getRecFrmQry("SELECT * FROM purchase_payment WHERE 1".$condition." ORDER BY invoiceid ASC ".$pages->limit."");
    $invno = $_GET['vid'];
    $sql2 ="select  sum(ac_amount) AS paytotal  FROM purchase_payment WHERE vendorid = '$invno' ";
    $ptot =	mysqli_query($dbcon->connection, $sql2);
    $record2 = $ptot->fetch_array();
    $totpay = $record2['paytotal'];
   
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
                                    <h2 class="title-1">Add invoice Details</h2>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-0">
                            <div class="card-body p-0">
                                <?php  require_once('../common/message.php'); ?>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data">
                       
                                <div class="col-sm-12">
                            
                                    <div class="row mt-2">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Invoice Date</label>
                                                <input type="date" name="invoicedate" id="invoicedate"
                                                    value="<?php echo  $invoicedate; ?>" class="form-control"
                                                    placeholder="Enter the invoice Date" required>

                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Invoice Number</label>
                                                <input type="text" name="invoiceno" id="invoiceno"
                                                    value="<?php echo  $invoiceno; ?>" class="form-control"
                                                    placeholder="Enter the invoice Number" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Bill Number</label>
                                                <input type="text" name="billno" id="billno"
                                                    value="<?php echo  $billno; ?>" class="form-control"
                                                    placeholder="Enter Bill Number">

                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="comp_name">Attach Document</label>
                                                <input type="file" class="form-control" name="supportdocs"
                                                    id="supportdocs" class="mt-2">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div class="d-flex justify-content-between">

                                                <?php if ($editFlag == false):?>
                                                <button type="submit" name="save" value="save" id="save"
                                                    class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>
                                                    Add Invoice Details</button>
                                                <?php else: ?>
                                                <button type="submit" name="update" value="update" id="update"
                                                    class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>
                                                    Update Invoice Details</button>
                                                <?php endif ?>

                                                <!-- <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                        class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> -->
                                                </a>
                                                <!-- <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                        class="btn btn-danger ml-2"><i class="fa fa-fw fa-sync"></i>
                                                    </a> -->
                                            </div>
                                        </div>
                                    </div>
                                    </div>


                                   
                                </div>
                            </form>
                        </div>

                        <div class="card mb-0">

                            <div class="card-header"><i class="fa fa-fw fa-search"></i> <strong>Search Invoice
                                    Details</strong></div>

                            <div class="card-body">

                                <?php
require_once('../common/message.php'); 

?>

                                <div class="col-sm-12">



                                    <form method="get">
                                        <div class="row pt-2">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Invoce code</label>
                                                    <input type="text" name="invoiceno" id="invoiceno"
                                                        class="form-control"
                                                        value="<?php echo isset($_REQUEST['vendorid'])?$_REQUEST['vendorid']:''?>"
                                                        placeholder="Enter invoice code - INV">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Purchased Invoice Number</label>
                                                    <input type="text" class="tel form-control"
                                                        name="purchased_invoiceno" id="purchased_invoiceno"
                                                        value="<?php echo isset($_REQUEST['purchased_invoiceno'])?$_REQUEST['purchased_invoiceno']:''?>"
                                                        placeholder="Enter Purchased Invoice Number">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Purchased Bill Number</label>
                                                    <input type="text" class="tel form-control" name="purchased_billno"
                                                        id="purchased_billno"
                                                        value="<?php echo isset($_REQUEST['purchased_billno'])?$_REQUEST['purchased_billno']:''?>"
                                                        placeholder="Enter Bill Code">
                                                </div>
                                            </div>


                                            <div class="col-sm-3">
                                                <label></label>
                                                <div class="form-group d-flex justify-content-between">
                                                    <button type="submit" name="submit" value="search" id="submit"
                                                        class="btn btn-primary"><i class="fa fa-fw fa-search"></i>
                                                        Search
                                                    </button>

                                                    <!-- <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                        class="btn btn-danger ml-2"><i class="fa fa-fw fa-sync"></i>
                                                    </a> -->
                                                </div>
                                            </div>


                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1 pb-2 pt-3">Vendor Information and Purchased Invoice List</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card">

                            <div class="card-body >
                                <form action="" method=" POST" enctype="multipart/form-data">
                                <div class="row ">

                                    <div class="col-sm-12">


                                        <div class="row ml-3 mr-3">
                                            <div class="col-sm-2 mt-3">
                                                <div class="row ">
                                                    <h5>Vendor Number <br><span class="ft-c-blue ft-s-20">
                                                            <?php  echo isset($row[0]['vendorid'])?$row[0]['vendorid']:''; ?>
                                                        </span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-10">

                                                <div class="row mt-3">
                                                    <span class="ft-c-blue ft-s-20">
                                                        <?php  echo isset($row[0]['vendorcompanyname'])?$row[0]['vendorcompanyname']:''; ?>
                                                    </span>
                                                </div>
                                                <div class="row ">
                                                    <span>Properitor :
                                                        <?php  echo isset($row[0]['vendorname'])?$row[0]['vendorname']:''; ?></span>
                                                </div>
                                                <!-- <div class="row ">
                                                        <span>
                                                            <?php  echo isset($row[0]['vendoraddress'])?$row[0]['vendoraddress']:''; ?></span>
                                                    </div> -->
                                                <!-- <div class="row ">
                                                            <span>
                                                                <?php  echo isset($row[0]['city'])?$row[0]['city']:''; ?>,
                                                                <?php  echo isset($row[0]['state'])?$row[0]['state']:''; ?></span>
                                                        </div> -->
                                                <div class="row ">
                                                    <span> Pincode :
                                                        <?php  echo isset($row[0]['pincode'])?$row[0]['pincode']:''; ?>.</span>
                                                </div>
                                            </div>

                                            <!-- <div class="col-sm-6">
                                                    <div class="row ">
                                                        <h5>GST #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['gstno'])?$row[0]['gstno']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row ">
                                                        <h5>PAN #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['pan'])?$row[0]['pan']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row ">
                                                        <h5>licenceno #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['licenceno'])?$row[0]['licenceno']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row ">
                                                        <h5>licenceno #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['licenceno'])?$row[0]['licenceno']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row ">
                                                        <h5>Mobile #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['mobile'])?$row[0]['mobile']:''; ?>,
                                                                <?php  echo isset($row[0]['mobile1'])?$row[0]['mobile1']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row ">
                                                        <h5>Landline #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['landline'])?$row[0]['landline']:''; ?>,
                                                                <?php  echo isset($row[0]['mobile1'])?$row[0]['mobile1']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row ">
                                                        <h5>Email ID: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['emailid'])?$row[0]['emailid']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                </div> -->
                                        </div>




                                    </div>
                                </div>
                            </div>


                            <div class="clearfix"></div>



                            <div class="mt-2 mb-3">

                                <table class="table table-striped table-bordered">
                                    <thead>

                                        <tr class="bg-primary text-white">
                                            <th width="100">INV Code</th>
                                            <th>Invoice Details</th>
                                            <th>Invoice Amount Details</th>
                                            <th>Payment Details</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                if(count($invData)>0){
                    $s	=	'';
                    foreach($invData as $val){
                        $s++;
                        $getInv = $val['invoiceid'];

                        $sql2 ="select  sum(totalprice) AS totInvAmt,sum(discount) AS totdiscount   FROM purchased_items_inventory where invoiceid = '$getInv' ";
                        $tprice =	mysqli_query($dbcon->connection, $sql2);
                        $record2 = $tprice->fetch_array();
                        $totInvAmt = $record2['totInvAmt']; 
                        $totDiscount = $record2['totdiscount']; 

                        $sql3 ="select  sum(ac_amount) AS paidamount  FROM purchase_payment where invoiceid = '$getInv' ";
                        $paidInvAmount =	mysqli_query($dbcon->connection, $sql3);
                        $paidrecord2 = $paidInvAmount->fetch_array();
                        $totPaidAmount = $paidrecord2['paidamount']; 
                      
                ?>  
                                        <tr>

                                            <td>
                                            <a href="purchased-invoice.php?vid=<?php echo $val['vendorid'];?>&ivid=<?php echo $val['ivid'];?>"
                                                    class="text-primary ml-2 mr-2"><?php echo $val['invoiceid'];?></a>
                                            </td>
                                            <td>
                                                <label class="disable-select">Invoice No:
                                                </label><?php echo $val['invoiceno'];?><br>
                                                <label class="disable-select">Bill No:
                                                </label><?php echo $val['billno'];?><br>
                                                <label class="disable-select">Invoice Date: </label>
                                                <?php $invdate = date('d-m-Y', strtotime($val['invoicedate'])); echo  $invdate;?>
                                            </td>
                                            <td class="p-0" style="padding:0 !important">
                                                <table class="table p-0">
                                                    <tr>
                                                        <td><label class="disable-select">Invoice Amount: </label></td>
                                                        <td class="text-right"> <?php echo $totInvAmt;?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="disable-select">GST Amount: </label></td>
                                                        <td class="text-right"> <?php $totalgst=$totInvAmt/100*18;  echo $totalgst;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="disable-select">Discount Amount : </label>
                                                        </td>
                                                        <td class="text-right"> <?php echo $totDiscount;?></td>
                                                    </tr>
                                                    <tr>
                                                    <tr class="bg-c-gray pb-1">
                                                        <td><label class="disable-select ft-c-black">Total Billed Amount
                                                                : </label></td>
                                                        <td class="text-right ft-c-black">
                                                            <?php $tbamount = $totInvAmt + $totalgst ;
                                                             echo $tbamount;?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            
                                            <td class="p-0" style="padding:0 !important">
                                                <table class="table">
                                                    <tr>
                                                        <td><label class="disable-select">Paid Amount: </label></td>
                                                        <td class="text-right"> <?php echo $totPaidAmount;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="disable-select">Balance Amount: </label></td>
                                                        <td class="text-right"> <?php echo $tbamount - $totPaidAmount;?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                             


                                            <td align="center" style="vertical-align:middle !important">



                                                <?php if( $_SESSION['adminlevel']>=1 && $val['totalinvoiceamount'] !=0 ) :?>
                                                <!-- <a href="employee-view.php?empid=<?php echo $val['ivid'];?>"
                        class="text-primary ml-2 mr-2"><i
                            class="fa fa-fw fa-eye"></i></a><br><br> -->
                                               
                                                <a class="d-block btn btn-success"
                                                    href="purchase-payment.php?vid=<?php echo $val['vendorid'];?>&invid=<?php echo $val['invoiceid'];?>">Pay</a>
                                                <?php endif ?>

                                                <?php if( $_SESSION['adminlevel']>=1 ) :?>
                                                <!-- <a href="employee-view.php?empid=<?php echo $val['ivid'];?>"
                        class="text-primary ml-2 mr-2"><i
                            class="fa fa-fw fa-eye"></i></a><br><br> -->
                                               
                            <a class="d-block mt-2 btn btn-primary"
                                                    href="purchased-items-inventory.php?vid=<?php echo $val['vendorid'];?>&invid=<?php echo $val['invoiceid'];?>">Add
                                                    Items</a>
                                                <?php endif ?>
                                                <?php if( $_SESSION['adminlevel']>=1 && $val['docsname'] != Null ) :?> 

                                                    <a class="d-block mt-2 btn btn-success pr-2" href="<?php echo  $val['docspath']."/".$val['docsname']; ?>" download>Invoice Copy <i class="fa fa-fw fa-download"></i></a>
                            
                                                <?php endif ?>

                                                <?php if( $_SESSION['adminlevel']==0 ) :?>
                                                <a href="" class="text-danger ml-2 mr-2"
                                                    onClick="return confirm('Are you sure to delete this user?');"><i
                                                        class="fa fa-fw fa-trash"></i> </a>

                                            </td>
                                            <?php endif ?>

                                        </tr>
                                        <tr class="bg-dark">
                                            <td colspan="5"></td>
                                        </tr>
                                        <?php 
}
}else{
?>
                                        <tr>
                                            <td colspan="5" align="center">No Record(s) Found!</td>
                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
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
                                    <a href="./vendor-details.php" class="btn btn-dark w-25">Back</a>

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