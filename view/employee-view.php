<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
    require_once('../model/permission_declare.php'); 
// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }

    if(isset($_REQUEST['empid']) and $_REQUEST['empid']!=""){
        $row	=	$db->getAllRecords('employee','*',' AND emp_id="'.$_REQUEST['empid'].'"');   
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
                                    <h2 class="title-1 pb-3">View Employee Profile</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-fw fa-eye"></i> <strong>Employee Profile</strong>
                            </div>

                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="dp-frame">
                                                <img
                                                    src="<?php echo isset($row[0]['emp_profile_img_path'])?$row[0]['emp_profile_img_path']:''; ?><?php echo isset($row[0]['emp_profile_img_name'])?$row[0]['emp_profile_img_name']:''; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-end">
                                                <h4 class="ft-s-16 ft-w-600 ft-c-black mt-2">
                                                </h4>
                                            </div>
                                            <div class="row">
                                                <h1 class="mt-3">
                                                    <?php echo ucfirst(isset($row[0]['emp_fname'])?$row[0]['emp_fname']:''); ?>&nbsp;&nbsp;<?php echo ucfirst(isset($row[0]['emp_lname'])?$row[0]['emp_lname']:''); ?>
                                                </h1>
                                            </div>
                                            <div class="row">
                                                <div class="form-group mt-2">

                                                    <h3>Employee #:
                                                        <span
                                                            class="ft-c-blue"><?php  echo isset($row[0]['emp_code'])?$row[0]['emp_code']:''; ?></span>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group mt-2">

                                                    <h4>Designation:
                                                        <span
                                                            class="ft-c-blue"><?php  echo isset($row[0]['emp_desig'])?$row[0]['emp_desig']:''; ?></span>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group mt-1">

                                                    <h4>Status:
                                                        <span> <?php if($row[0]['emp_status']=="Working"){?></span>

                                                        <span
                                                            class="ft-c-green"><?php  echo isset($row[0]['emp_status'])?$row[0]['emp_status']:''; ?></span>
                                                        <label class="ft-c-gray ml-3"> Date of Join: </label>
                                                        <span class="ft-bold ft-c-black "><?php 
                                            $result = date('d-m-Y', strtotime($row[0]['emp_doj']));
                                            // $coldate =strtotime($row[0]['emp_dob']);
                                            // $colsdate = mysqli_real_escape_string($db,date('d-m-Y' , $coldate));
                                            echo $result; ?>
                                                            <?php }else{   ?>
                                                            <span
                                                                class="ft-c-red"><?php  echo isset($row[0]['emp_status'])?$row[0]['emp_status']:''; ?></span>

                                                            <label class="ft-c-gray ml-3"> Date of Resigned: </label>
                                                            <span class="ft-bold ft-c-black "><?php 
                                            $result = date('d-m-Y', strtotime($row[0]['emp_dor']));
                                            // $coldate =strtotime($row[0]['emp_dob']);
                                            // $colsdate = mysqli_real_escape_string($db,date('d-m-Y' , $coldate));
                                            echo $result; }?></span>


                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>


                            <div class="clearfix"></div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="page-header mb-2">
                                            <h3>Employee profile Details</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="row justify-content-between text-left mt-2">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="ft-c-gray"> Maritial Status</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_marital_status']; ?>
                                            </p>

                                        </div>
                                        <div class="form-group">
                                            <?php  if($row[0]['emp_marital_status']=="married"){?>

                                            <label class="ft-c-gray"> Spouse name</label>
                                            <?php }else{   ?>
                                            <label class="ft-c-gray">Mother name:</label><?php   }?>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_sname']; ?></p>
                                        </div>

                                        <div class="form-group">
                                            <label class="ft-c-gray"> Date of Birth</label>
                                            <p class="ft-bold ft-c-black"><?php 
                                            $result = date('d-m-Y', strtotime($row[0]['emp_dob']));
                                            // $coldate =strtotime($row[0]['emp_dob']);
                                            // $colsdate = mysqli_real_escape_string($db,date('d-m-Y' , $coldate));
                                            echo $result; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="ft-c-gray"> Mobile Number</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_mobileno']; ?>&nbsp; /
                                                &nbsp;<?php echo $row[0]['emp_amobileno']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="ft-c-gray"> Aadhar Number</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_aadhar']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="ft-c-gray"> Email id</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_office_email']; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                            <label class="ft-c-gray"> Blood Group</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['blood_group']; ?>
                                            </p>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="ft-c-gray"> Qualification</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_qualification']; ?>
                                            </p>

                                        </div>
                                        <div class="form-group">
                                            <label class="ft-c-gray"> Department</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_dept']; ?></p>
                                        </div>

                                        <div class="form-group">
                                            <label class="ft-c-gray"> Salary</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_salary']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="ft-c-gray">Bank Details</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_bank_details']; ?></p>
                                        </div>
                                      
                                    </div>
                                    <div class="col-sm-4">
                                         
                                    <div class="form-group">
                                            <label class="ft-c-gray">Temperary Address</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_taddress']; ?></p>
                                        </div>
                                    <div class="form-group">
                                            <label class="ft-c-gray">Permanent Address</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_paddress']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="ft-c-gray"> Office Comments</label>
                                            <p class="ft-bold ft-c-black"><?php echo $row[0]['emp_office_notes']; ?></p>
                                        </div>
                                    </div>


                         

                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-12">
                                        <div class="row">
                                            <div class="d-flex justify-content-center w-100">
                                                <a href="./employee-list.php" class="btn btn-dark w-25">Back</a>

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