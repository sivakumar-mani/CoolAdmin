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
                                    <h2 class="title-1">View Vendor Details</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-fw fa-eye"></i> <strong>Vendor Profile</strong>
                            </div>

                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-end">
                                                <h4 class="ft-s-16 ft-w-600 ft-c-black mt-2">
                                                </h4>
                                            </div>

                                            <div class="row ml-3 mr-3">
                                                <div class="col-sm-6">
                                                    <div class="row column-gap">
                                                        <h5>Vendor #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['vendorid'])?$row[0]['vendorid']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <span class="ft-c-blue"><?php  echo isset($row[0]['vendorcompanyname'])?$row[0]['vendorcompanyname']:''; ?></span>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <span>Properitor : <?php  echo isset($row[0]['vendorname'])?$row[0]['vendorname']:''; ?></span>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <span> <?php  echo isset($row[0]['vendoraddress'])?$row[0]['vendoraddress']:''; ?></span>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <span> <?php  echo isset($row[0]['city'])?$row[0]['city']:''; ?>, <?php  echo isset($row[0]['state'])?$row[0]['state']:''; ?></span>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <span> Pincode : <?php  echo isset($row[0]['pincode'])?$row[0]['pincode']:''; ?>.</span>
                                                    </div>
                                                </div>
                                         
                                            <div class="col-sm-6">
                                                    <div class="row column-gap">
                                                        <h5>GST #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['gstno'])?$row[0]['gstno']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <h5>PAN #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['pan'])?$row[0]['pan']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <h5>licenceno #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['licenceno'])?$row[0]['licenceno']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <h5>licenceno #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['licenceno'])?$row[0]['licenceno']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <h5>Mobile #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['mobile'])?$row[0]['mobile']:''; ?>, <?php  echo isset($row[0]['mobile1'])?$row[0]['mobile1']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <h5>Landline #: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['landline'])?$row[0]['landline']:''; ?>, <?php  echo isset($row[0]['mobile1'])?$row[0]['mobile1']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                    <div class="row column-gap">
                                                    <h5>Email ID: <span
                                                                class="ft-c-blue"><?php  echo isset($row[0]['emailid'])?$row[0]['emailid']:''; ?></span>
                                                        </h5>
                                                    </div>
                                                </div>
                                                </div>
                                    
                
                                

                                    </div>
                            </div>
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