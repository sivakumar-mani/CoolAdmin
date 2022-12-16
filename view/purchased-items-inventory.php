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

    if(isset($_GET['invid'])){
        $pinvData	=	$db->getAllRecords('purchased_invoice','*',' AND invoiceid="'.$_GET['invid'].'"');   
    }
    if(isset($_GET['invid']) && isset($_GET['vid'])){
        $pinventData	=	$db->getAllRecords('purchased_items_inventory','*',' AND invoiceid="'.$_GET['invid'].'" AND vendorid="'.$_GET['vid'].'"');   
    }

   
    if(isset($_GET['invid'])){
        $invno = $_GET['invid'];
    $sql ="select sum(totalprice) AS totalinvoice FROM purchased_items_inventory where invoiceid = '$invno' ";
    $tinvoice =	mysqli_query($dbcon->connection, $sql);
    $record = $tinvoice->fetch_array();
    $totalinvoice = $record['totalinvoice'];
   

    // $sql1 ="select  sum(cgst + sgst) AS totgst  FROM purchased_items_inventory where invoiceid = '$invno' ";
    // $credit =	mysqli_query($dbcon->connection, $sql1);
    // $record1 = $credit->fetch_array();
    // $totalgst = $record1['totgst'];

    $sql2 ="select  sum(discount) AS totdiscount  FROM purchased_items_inventory where invoiceid = '$invno' ";
    $tdiscount =	mysqli_query($dbcon->connection, $sql2);
    $record2 = $tdiscount->fetch_array();
    $totaldiscount = $record2['totdiscount'];
}
    ?>

<?php 
   $editFlag = false;
    $invoiceid ="";
    $brandsname ="";
    $invoiceno ="";
    
    $serialnumber="";
    $itemname="";
    $categoryname="";
    $categoryname="";
    $mrp ="";
    $quantity="";
    $discount="";


    if(isset($_GET['pid'])){
        $editFlag = true;
        $getdata	=	$db->getAllRecords(' purchased_items_inventory','*',' AND 	pid="'.$_REQUEST['pid'].'"');
        $brandsname = $getdata[0]['brandsname'];
        $itemname = $getdata[0]['itemname'];
        $categoryname = $getdata[0]['categoryname'];
        $mrp = $getdata[0]['mrp'];
        $quantity = $getdata[0]['quantity'];
        $discount = $getdata[0]['discount'];
        $serialnumber = $getdata[0]['serialnumber'];
       
    }



    if(isset($_POST['update'])){
        $vendorid = $row[0]['vendorid'];
        $invid = $_GET['invid'];
        $pid =$_GET['pid'];
        $data	=	array(          
            'brandsname'=>$_POST['brandsname'],
            'itemname'=>trim($_POST['itemname']),
            'categoryname'=>trim($_POST['categoryname']),
            'mrp'=>trim($_POST['mrp']),
            'quantity'=>trim($_POST['quantity']),
            'discount'=>trim($_POST['discount']),
            'serialnumber'=>trim($_POST['serialnumber']),
            'totalprice'=>trim($_POST['mrp']) * trim($_POST['quantity']),
            );
        $update	=	$db->update('purchased_items_inventory',$data,array('pid'=>$pid));

        if($update){
            header('location:purchased-items-inventory.php?invid='.$invid.'&vid='. $vendorid.'&msg=upok');
                exit;
            }else{
                header('location:purchased-items-inventory.php?invid='.$invid.'&vid='. $vendorid.'&msg=upok');
                exit;
            }
       
    }

    if(isset($_POST['save'])){
        $vendorid = $_GET['vid'];
        $invid = $_GET['invid'];
        
		$purchaseCount	=	$db->getQueryCount('purchased_items_inventory','pid');
       

        if($purchaseCount[0]['total']==0){
            echo   $purchaseid = "PIN1";
            
           } else {
            require_once('../model/purchased-items-inventory.php'); 
            $dbcon = new purchasedIventory();
                 $hid = $dbcon->getmaxid() +1;
            echo  $purchaseid = "PIN" . $hid;
           }
           $stockCount	=	$db->getQueryCount('stock_inventory','sid');
           if($stockCount[0]['total']==0){
            echo   $stockcode = "SKU1";            
           } else {
            require_once('../model/stock_class.php'); 
            $dbcon = new stock();
                 $hid = $dbcon->getmaxid() +1;
            echo  $stockcode = "SKU" . $hid;
           }
            $totalprice = (trim($_POST['mrp']) * trim($_POST['quantity'])) ;
            $cgst =  $totalprice/100 * 9;
            $sgst =  $totalprice/100 * 9;
            $tgst =      $cgst +   $sgst;
            $stockname = trim($_POST['brandsname'])." ".trim($_POST['itemname'])." ".trim($_POST['categoryname']);
			$data	=	array(
                'invoiceid'=>$invid,
                'vendorid'=>$vendorid,
                'purchaseid'=>$purchaseid,               
                'brandsname'=>trim($_POST['brandsname']),
                'itemname'=>trim($_POST['itemname']),
                'categoryname'=>trim($_POST['categoryname']),
                'serialnumber'=>trim($_POST['serialnumber']),                
                'mrp'=>trim($_POST['mrp']),
                'quantity'=>trim($_POST['quantity']),
                'discount'=>trim($_POST['discount']),
                'totalprice'=>$totalprice,
                'movement'=>'in',
                );

                $data1	=	array(
                    'totalinvoiceamount'=>$pinvData[0]['totalinvoiceamount']+ $totalprice,
                    'totalgst'=>$pinvData[0]['totalgst']+  $tgst,
                    'totaldiscount'=>$pinvData[0]['totaldiscount'] +  trim($_POST['discount']),
                    );

           

			$insert	=	$db->insert('purchased_items_inventory',$data);
            $update	=	$db->update('purchased_invoice',$data1,array('invoiceid'=>$invid));
            $matchdata	=	$db->getQueryCount('stock_inventory','*',' AND stockname="'.$stockname.'"');
            if($matchdata[0]['total']==0){
               $data2	=	array(
                   'stockcode'=>$stockcode,
                   'stockname'=>$stockname,
                   'quantity'=>trim($_POST['quantity']),
                   'status'=>'load',
                   'mrp'=>trim($_POST['mrp']),
                   );
                   $insert	=	$db->insert('stock_inventory',$data2);
            }else {
                $stockData ="select  *  FROM stock_inventory where stockname = '$stockname' ";
                $stockCheck =	mysqli_query($dbcon->connection, $stockData);
                $stockCheck1 = $stockCheck->fetch_array();
                $quantity = $stockCheck1['quantity'];
                $data3	=	array(                   
                    'quantity'=> $quantity+trim($_POST['quantity']),
                    'mrp'=>trim($_POST['mrp']),
                    );
                    $update	=	$db->update('stock_inventory',$data3,array('stockname'=>$stockname));
            }
        if($insert){
     
            header('location:purchased-items-inventory.php?invid='.$invid.'&vid='. $vendorid.'&msg=saveok');
          
            exit;
        }else{
            header('location:purchased-items-inventory.php?invid='.$invid.'&vid='. $vendorid.'&msg=saveok');
            exit;
		}
    // }
    // else {
    //     header('location:purchased-invoice.php?vid='.$vendorid.'&msg=matchinvoice');
    //     exit;
    // }
	}

    $condition	=	'';
    if(isset($_GET['invid'])){
        $condition	.=	' AND invoiceid LIKE "'.$_GET['invid'].'" ';
       
    }
    $pages->default_ipp	=	15;
    $sql 	= $db->getRecFrmQry("SELECT * FROM purchased_invoice WHERE 1 ".$condition."");
    $pages->items_total	=	count($sql);
    $pages->mid_range	=	9;
    $pages->paginate(); 

    $brandData	=   $db->getRecFrmQry("SELECT * FROM brands");
    $itemData	=   $db->getRecFrmQry("SELECT * FROM item");
    $categoryData	=   $db->getRecFrmQry("SELECT * FROM category");


    
$pivData	=   $db->getRecFrmQry("SELECT * FROM purchased_items_inventory WHERE 1".$condition." ORDER BY invoiceid ASC ".$pages->limit."");
  

   
   
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
                                    <h2 class="title-1 pb-2">Add Purchased items Details</h2>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-0">
                            <div class="card-body p-0">
                                <?php  require_once('../common/message.php'); ?>
                            </div>

                            <form method="post" enctype="multipart/form-data">
                                <div class="col-sm-12 bg-light">
                                    <div class="row mt-2 mb-2">
                                    <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Modal Number/ Code </label>

                                                <select class="form-control" name="categoryname" id="categoryname">
                                                    <option value="<?php echo  $categoryname; ?>"><?php echo  $categoryname; ?></option>
                                                    <?php  foreach($categoryData as $val){ ?>
                                                    <option value="<?php echo $val['categoryname'];?>">
                                                        <?php echo $val['categoryname'];?></option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">       
                                            <label>Brand Name</label>                              
                                                <select class="form-control" name="brandsname" id="brandsname">                                              
                                                    <option  value="<?php echo  $brandsname; ?>"><?php echo  $brandsname; ?></option>
                                                    <?php  foreach($brandData as $val){ ?>
                                                    <option value="<?php echo $val['brandsname'];?>">
                                                        <?php echo $val['brandsname'];?></option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Item Name <?php echo  $itemname; ?></label>
                                                <select class="form-control" name="itemname" id="itemname">
                                                <option value="<?php echo  $itemname; ?>"><?php echo  $itemname; ?></option>
                                                    <?php  foreach($itemData as $val){ ?>
                                                    <option value="<?php echo $val['itemname'];?>">
                                                        <?php echo $val['itemname'];?></option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                             
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>MRP Price</label>
                                                <input type="text" name="mrp" id="mrp" class="form-control" value="<?php echo  $mrp; ?>"
                                                    placeholder="Enter the item Name">

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="text" name="quantity" id="quantity" value="<?php echo  $quantity; ?>"
                                                    value="<?php echo  $paidamount; ?>" class="form-control"
                                                    placeholder="Enter the item Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <input type="text" name="discount" id="discount" value="<?php echo  $discount; ?>"
                                                    value="<?php echo  $paidamount; ?>" class="form-control"
                                                    placeholder="Enter the item Name">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label>Serial Number</label>
                                                <textarea class="form-control" name="serialnumber" id="serialnumber"
                                                    row="1" cols="90"><?php echo $serialnumber; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="d-flex justify-content-between">

                                                    <?php if ($editFlag == false):?>
                                                    <button type="submit" name="save" value="save" id="save"
                                                        class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>
                                                        Add</button>
                                                    <?php else: ?>
                                                    <button type="submit" name="update" value="update" id="update"
                                                        class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>
                                                        Update</button>
                                                    <?php endif ?>


                                                    <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                        class="btn btn-danger"><i class="fa fa-fw fa-sync"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <h2 class="title-1 pt-2 pb-2 bg-dark ft-c-white pl-2"> Purchased Invoice Details</h2>
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
                                                <p class="mr-auto"><p>
                                                <h1>INVOICE </h1>
                                                <p class="inv-title"><p>
                                                    <br>
                                                <h4> Date : <span
                                                        class="ft-c-blue"><?php $idate =date('d-m-yy', strtotime($pinvData[0]['invoicedate'])); echo $idate; ?></span>
                                                </h4>
                                                <h4 class="pt-2"> Invoice Number : <span
                                                        class="ft-c-blue"><?php  echo isset($pinvData[0]['invoiceno'])?$pinvData[0]['invoiceno']:''; ?></span>
                                                </h4>
                                                <h4 class="pt-2"> Bill Number : <span
                                                        class="ft-c-blue"><?php  echo isset($pinvData[0]['billno'])?$pinvData[0]['billno']:''; ?></span>
                                                </h4>
                                                <span class="ft-c-red">Invoice Number - <?php  echo $_GET['invid']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="mb-3">

                        <table class="table table-striped table-bordered">
                            <thead>

                                <tr class="bg-primary text-white">
                                    <th width="50">INV # </th>
                                    <th width="350">Item Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Discount</th>
                                    <th>Total Price</th>
                                    <th>GST</th>
                                    <th>Total</th>
                                    <th class="text-center" width ="50">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                if(count($pinventData)>0){
                    $s	=	'';
                    $tt = 0;
                    $ttoltal=0;
                    $totgst =0;
                    foreach($pinventData as $val){
                        $s++;
                       
                ?>
                                <tr>

                                    <td class="text-center"><?php echo $s;?></td>

                                    <td>                                        
                                    <?php 
                                  
                                     $itemdesc = $val['categoryname']."&nbsp;&nbsp;&nbsp;".$val['brandsname']."&nbsp;&nbsp;&nbsp;".$val['itemname'];
                                    echo $itemdesc;?></td>
                                    <td class="text-center"><?php echo $val['quantity'];?></td>
                                    <td class="text-right"> <?php echo $val['mrp'];?></td>
                                    <td class="text-right"> <?php echo $val['discount'];?></td>
                                    <td class="text-right"> <?php $totalprice = ($val['mrp'] * $val['quantity'])-$val['discount']; echo $totalprice;?></td>
                                    <td class="text-right">  <?php   
                                    $sumPrice = ($val['mrp'] * $val['quantity'] ) -$val['discount'];  
                                    $ttoltal += $totalprice;
                                    $calGst = ($sumPrice/100) * 18;  echo $calGst;
                                    $totgst +=  $calGst;

                                    ?>
                                    </td>

                                    <td class="text-right">  <?php 
                                    $itemTotal = $totalprice +$calGst; 
                                    
                                       echo number_format($itemTotal,2,'.',',');

                                    
                                    ?>
                                    
                                    </td>

                                    <td align="center">



                                        <?php if( $_SESSION['adminlevel']>=1 ) :?>
                                        <!-- <a href="employee-view.php?empid=<?php echo $val['ivid'];?>"
                        class="text-primary ml-2 mr-2"><i
                            class="fa fa-fw fa-eye"></i></a><br><br> -->
                                        <a href="purchased-items-inventory.php?vid=<?php echo $val['vendorid'];?>&invid=<?php echo $val['invoiceid'];?>&pid=<?php echo $val['pid'] ?>"
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
                                            <td colspan="5" class=""></td>
                                            <td colspan="2"class="bg-l-gray text-right"><span class="sum-text">Total</span></td>
                                            <td colspan="1" class="bg-l-gray text-right ft-bld ft-s-16"><?php if(isset($ttoltal)) {echo number_format($ttoltal,2,'.',',') ;} ?></td>
                                            <td></td>
                                </tr>
                                <tr class="bg-transparent"> 
                                            <td colspan="5"></td>
                                            <td colspan="2" class="bg-l-gray  text-right"><span class="sum-text">Total GST</span></td>
                                            <td colspan="1" class="bg-l-gray text-right ft-bld ft-s-16"><?php if(isset($totgst)) { echo number_format($totgst,2,'.',','); }?></td>
                                            <td></td>
                                </tr>
                                <tr class="bg-transparent"> 
                                            <td colspan="5"></td>
                                            <td colspan="2" class="bg-dark text-right ft-c-white"><span class="sum-text">Grand Total</span></td>
                                            <td colspan="1" class="bg-dark text-right ft-bld ft-s-16 ft-c-white"><span class="sum-text"><?php $gtot =0; if(isset($gtot ) &&  isset($ttoltal)){ $gtot = $ttoltal + $totgst; echo number_format($gtot,2,'.',',');} ?></span> </td>
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