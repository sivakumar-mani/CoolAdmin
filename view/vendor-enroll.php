<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }


    // if(isset($_POST['save'])){
        if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
            extract($_REQUEST);
        $vendorcompanyname = trim($_POST['vendorcompanyname']);
        $matchdata	=	$db->getQueryCount('vendor_details','*',' AND vendorcompanyname="'.$vendorcompanyname.'"');
        if($matchdata[0]['total']==0){
		$vendorCount	=	$db->getQueryCount('vendor_details','vid');

        if($vendorCount[0]['total']==0){
            echo   $vendorid = "VND1";
           } else {
            require_once('../model/vendor_class.php'); 
            $dbcon = new vendor();
                 $hid = $dbcon->getmaxid() +1;
            echo  $vendorid = "VND" . $hid;
           }
           $data	=	array(
            'vendorid'=>$vendorid,
            'vendorcompanyname'=>trim($_POST['vendorcompanyname']),
            'vendorname'=>trim($_POST['vendorname']),
            'vendoraddress'=>trim($_POST['vendoraddress']),				
            'city'=>trim($_POST['city']),
            'state'=>trim($_POST['state']),
            'pincode'=>trim($_POST['pincode']),
            'gstno'=>trim($_POST['gstno']),
            'pan'=>trim($_POST['pan']),
            'licenceno'=>trim($_POST['licenceno']),
            'mobile'=>trim($_POST['mobile']),
            'mobile1'=>trim($_POST['mobile1']),
            'landline'=>trim($_POST['landline']),
            'emailid'=>trim($_POST['emailid']),
            );

			$insert	=	$db->insert('vendor_details',$data);

        if($insert){
            header('location:vendor-details.php?msg=ras');
            exit;
        }else{
            header('location:vendor-details.php?msg=rna');
            exit;
		}
    }
    else {
        header('location:vendor-enroll.php?msg=matchvendor');
        exit;
    }
}


// if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){

// 	extract($_REQUEST);

   
//     require_once('../common/message.php'); 

// 		$userCount	=	$db->getQueryCount('vendor_details','vendorid   ');



// 			$data	=	array(

// 							'vendorid'=>trim($vendorid),
//                             'vendorname'=>trim($vendorname),
// 							'vendorcompanyname'=>trim($vendorcompanyname),	
//                             'vendoraddress'=>trim($vendoraddress),						
//                             'city'=>trim($city),
//                             'state'=>trim($state),
//                             'pincode'=>trim($pincode),
//                             'gstno'=>trim($gstno),
//                             'pan'=>trim($pan),
//                             'licenceno'=>trim($licenceno),
//                             'mobile'=>trim($mobile),
//                             'mobile1'=>trim($mobile1),
//                             'landline'=>trim($landline),
//                             'emailid'=>trim($emailid),
// 							);

// 			$insert	=	$db->insert('vendor_details',$data);

// 			if($insert){

// 				header('location:vendor-details.php?msg=ras');

// 				exit;

// 			}else{

// 				header('location:vendor-details.php?msg=rna');

// 				exit;

// 			}

	

// 	}


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
                                    <h2 class="title-1 pb-2">Add Vendor Details</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-plus"></i> <strong>Add</strong> </div>

                            <div class="card-body">

                                <?php  require_once('../common/message.php'); 

?>

                                <form method="post">
                                    <div class="col-sm-12">


                                        <div class="row mt-2 mb-2">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input type="text" name="vendorcompanyname" id="vendorcompanyname"
                                                        class="form-control" placeholder="Enter company name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vendor Name</label>
                                                    <input type="text" name="vendorname" id="vendorname"
                                                        class="form-control" placeholder="Enter vendor name" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-2 mb-2">

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control demoInputBox" id="vendoraddress"
                                                        name="vendoraddress" rows="2" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2 mb-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" name="city" id="city" class="form-control"
                                                        placeholder="Enter city" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" name="state" id="state" class="form-control"
                                                        placeholder="Enter state" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Pincode </label>
                                                    <input type="text" name="pincode" id="pincode" class="form-control"
                                                        placeholder="Enter state" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2 mb-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>GST NO</label>
                                                    <input type="gstno" name="gstno" id="city" class="form-control"
                                                        placeholder="Enter gst number">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>PAN No</label>
                                                    <input type="text" name="pan" id="pan" class="form-control"
                                                        placeholder="Enter PAN No" >
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Licence No</label>
                                                    <input type="text" name="licenceno" id="licenceno" class="form-control"
                                                        placeholder="Enter Licence No">
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row mt-2 mb-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Mobile No</label>
                                                    <input type="number" name="mobile" id="mobile" class="form-control"
                                                    laceholder="Enter Mobile Number" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                <label>Mobile No</label>
                                                    <input type="number" name="mobile1" id="mobile1" class="form-control"
                                                        placeholder="Enter Mobile Number" >
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Land Line No</label>
                                                    <input type="number" name="landline" id="landline" class="form-control"
                                                        placeholder="Enter Mobile Number">
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row mt-2 mb-2">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>eMail</label>
                                                    <input type="email" name="emailid" id="emailid" class="form-control"
                                                    laceholder="Enter email Id" required>
                                                </div>
                                            </div>                                                                               
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-footer d-flex justify-content-between">
                                                <a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i
                                                        class="fa fa-fw fa-sync"></i>
                                                    Clear</a>
                                                <a href="./vendor-details.php" class="btn btn-dark">Back</a>
                                                <!-- <button type="submit" name="submit" value="search" id="submit"
                                            class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>
                                            Add Record</button> -->
                                                <button type="submit" name="submit" value="Save" id="submit"
                                                    class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Add
                                                    Vendor</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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