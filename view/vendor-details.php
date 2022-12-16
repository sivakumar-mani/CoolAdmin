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





?>
<?php

$condition	=	'';
if(isset($_REQUEST['vendorid']) and $_REQUEST['vendorid']!=""){
    $condition	.=	' AND vendorid LIKE "'.$_REQUEST['vendorid'].'" ';
}
if(isset($_REQUEST['vendorname']) and $_REQUEST['vendorname']!=""){
    $condition	.=	' AND vendorname LIKE "%'.$_REQUEST['vendorname'].'%" ';
}

if(isset($_REQUEST['vendorcompanyname']) and $_REQUEST['vendorcompanyname']!=""){
    $condition	.=	' AND vendorcompanyname LIKE "%'.$_REQUEST['vendorcompanyname'].'%" ';
}
// if(isset($_REQUEST['comp_branch']) and $_REQUEST['comp_branch']!=""){
//     $condition	.=	' AND comp_branch LIKE "%'.$_REQUEST['comp_branch'].'%" ';
// }

// if(isset($_REQUEST['comp_status']) and $_REQUEST['comp_status']!=""){
//     $condition	.=	' AND comp_status LIKE "'.$_REQUEST['comp_status'].'" ';
// }

// if(isset($_REQUEST['ac_trans_mode']) and $_REQUEST['ac_trans_mode']!=""){
//     $condition	.=	' AND ac_trans_mode LIKE "%'.$_REQUEST['ac_trans_mode'].'%" ';
// }

// if((isset($_REQUEST['fromdate']) and $_REQUEST['fromdate']!="") && (isset($_REQUEST['todate']) and $_REQUEST['todate']!="")){
//     $condition	.=	' AND ac_trans_date BETWEEN "'.$_REQUEST['fromdate'].'" AND "'.$_REQUEST['todate'].'" ';
// }

// if(isset($_REQUEST['fromdate']) and $_REQUEST['fromdate']!=""){
//     $condition	.=	' AND ac_trans_date LIKE "'.$_REQUEST['fromdate'].'"  ';
// }

// ------------- Debit total statement -----------

// $qry = "SELECT SUM(ac_amount) AS count FROM complaint_register WHERE ac_trans_type='Debit'  ".$condition."";

// $res = $dbcon->connection->query($qry);
// $total = 0;
// $rec =  $res->fetch_assoc();
// $total = $rec['count'];

// ------------- Credit  total statement -----------
// $qry1 = "SELECT SUM(ac_amount) AS count  FROM complaint_register WHERE ac_trans_type='Credit' ".$condition."";

// $res1 = $dbcon->connection->query($qry1);
// $ctotal = 0;
// $rec1 =  $res1->fetch_assoc();
// $ctotal = $rec1['count'];

 //Main queries
 $pages->default_ipp	=	15;
 $sql 	= $db->getRecFrmQry("SELECT * FROM vendor_details WHERE 1 ".$condition."");
 $pages->items_total	=	count($sql);
 $pages->mid_range	=	9;
 $pages->paginate(); 
$vendorData	=   $db->getRecFrmQry("SELECT * FROM vendor_details WHERE 1 ".$condition." ORDER BY vendorcompanyname ASC ".$pages->limit."");

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
                                    <h2 class="title-1 pb-3">Vendor List</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-search"></i> <strong>Search</strong> <a
                                    href="../view/vendor-enroll.php" class="float-right btn btn-dark btn-sm"><i
                                        class="fa fa-fw fa-plus-circle"></i> Add Vendor Details</a></div>

                            <div class="card-body">

                                <?php
require_once('../common/message.php'); 

    ?>

                                <div class="col-sm-12">



                                    <form method="get">

                                        <div class="row pt-2 pb-2">

                                            <div class="col-sm-2">

                                                <div class="form-group">

                                                    <label>Vendor#</label>

                                                    <input type="text" name="vendorid" id="vendorid"
                                                        class="form-control"
                                                        value="<?php echo isset($_REQUEST['vendorid'])?$_REQUEST['vendorid']:''?>"
                                                        placeholder="Enter vendor number">

                                                </div>

                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input type="text" class="tel form-control" name="vendorcompanyname"
                                                        id="vendorcompanyname"
                                                        value="<?php echo isset($_REQUEST['vendorcompanyname'])?$_REQUEST['vendorcompanyname']:''?>"
                                                        placeholder="Search company name">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Vendor Name</label>
                                                    <input type="text" class="tel form-control" name="vendorname"
                                                        id="vendorname"
                                                        value="<?php echo isset($_REQUEST['vendorname'])?$_REQUEST['vendorname']:''?>"
                                                        placeholder="Enter vendor name">

                                                </div>

                                            </div>
                                        

                                            <div class="col-sm-3">
                                                <label></label>
                                                <div class="form-group row">


                                                    <button type="submit" name="submit" value="search" id="submit"
                                                        class="btn btn-primary"><i class="fa fa-fw fa-search"></i>
                                                        Search</button>

                                                    <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                        class="btn btn-danger ml-2"><i class="fa fa-fw fa-sync"></i>
                                                        Clear</a>

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

                                    <tr class="bg-primary text-white">
                                        <th>Vendor#</th>
                                        <th>Vendor Info </th>
                                        <th width="300">Address</th>
                                        <th>Vendor Details</th>
                                        <th class="text-center" colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($vendorData)>0){
                                            $s	=	'';
                                            foreach($vendorData as $val){
                                                $s++;
                                            
                                        ?>
                                    <tr>

                                        <td> <a href="vendor-edit.php?vid=<?php echo $val['vendorid'];?>"
                                                class="text-primary ml-2 mr-2"><?php echo $val['vendorid'];?></a></td>
                                        <td><span class="upperCase"> <?php echo $val['vendorcompanyname'];?></span><br>
                                        <span class="upperCase"><?php echo $val['vendorname'];?></span><br>
                                        </td>
                                        <td>
                                            <?php echo $val['vendoraddress'];?>,<br> 
                                            <?php echo $val['state'];?>,  
                                            <?php echo $val['city'];?>,<br> 
                                            Pincode: <?php echo $val['pincode'];?><br> 
                                            <?php echo $val['mobile'];?> &nbsp; &nbsp; <?php echo $val['mobile1'];?><br> 
                                            <?php echo $val['landline'];?><br> 
                                            <?php echo $val['emailid'];?>
                                        </td>
                                        <td>
                                        <span class="upperCase">GST #: <?php echo $val['gstno'] ;?></span> <br>
                                        <span class="upperCase">PAN # <?php echo $val['pan'] ;?></span> <br>
                                        </td>
                                        <td align="center" style="vertical-align:middle !important">
                                          <a href="purchased-invoice.php?vid=<?php echo $val['vendorid'];?>"
                                                class="p-2 btn-primary ">Add Purchased invoice Details</a></td>
                                                <td align="center" style="vertical-align:middle !important">
                                      
                                            <?php if( $_SESSION['adminlevel']>=1 ) :?>
                                            <a href="vendor-view.php?vid=<?php echo $val['vendorid'];?>"
                                                class="text-primary ml-2 mr-2"><i
                                                    class="fa fa-fw fa-eye"></i></a><br><br>
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
                                    <?php } ?>

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