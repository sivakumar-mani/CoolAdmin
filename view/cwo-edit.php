<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
    $compcode = $_REQUEST['compid'];
    if(isset($compcode) and $compcode!=""){
        $row	=	$db->getAllRecords('complaint_register','*',' AND comp_code="'.$compcode.'"');  
        $workorderData	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');    
       
    }else {
        $row	=	$db->getAllRecords('complaint_register','*',' AND comp_code="'.$compcode.'"');  
        $workorderData	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');    
    }

    $employeeData = $db->getAllRecords('employee','*');


    if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
    $cwoCount	=	$db->getQueryCount('complaint_work_order','cwo_id');
    // echo "count" . $empCount[0]['total'];
 if($cwoCount[0]['total']==0){
     echo   $cwo_code = "CWO1";
    } else {
        $cwocompCount	=	$db->getQueryCount('complaint_work_order','*',' AND comp_code="'.$compcode.'"');
        if($cwocompCount[0]['total']==0){          
            require_once('../model/complaint_work_order_class.php'); 
            $dbcon = new complaintWorkOrder();
                $hid = $dbcon->getmaxid() +1;
            echo  $cwo_code = "CWO" . $hid;
        }else {
            $crow	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');  
            echo $cwo_code =$crow[0]['cwo_code'];
        }
    }
    $stringText  = $emp_code;
    $emp = explode(" ", $stringText);
    echo $emp[0]; //red 
    echo $techname = $emp[1]." ". $emp[2]; //yellow
 
    $ctdate=date('d-m-Y H:i:s');

			$data	=	array(
							'cwo_code'=>$cwo_code,
                            'emp_code'=> $emp[0],
                            'tech_name'=> $techname,
							'comp_code'=>$compcode,							
                            'cwo_date'=>$cwo_date,
                            'cwo_timedate'=> $ctdate,
                            'cwo_amount'=>$cwo_amount,
                            'cwo_status'=>$cwo_status,
                            'cwo_material_given'=>$cwo_material_given,
                            'cwo_remedies'=>$cwo_remedies
							);

                            $insert	=	$db->insert('complaint_work_order',$data);

			if($insert){

                // header('location:'.$_SERVER['PHP_SELF'].'?comp_id='.$_REQUEST['compid'].'');
                $cdata	=	array(

                    'comp_status'=>$cwo_status,
                    );

                    $update	=	$db->update('complaint_register',$cdata,array('comp_code'=>$compcode));

                        if($update){

                            header('location:complaint-edit.php?compid='.$compcode);
                            exit;

                        }
           

			        }else{

                header('location:'.$_SERVER['PHP_SELF'].'?compid='.$compcode.'"');

				exit;

			}

	

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
                                    <h2 class="title-1">Update Complaint work order</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-edit"></i> <strong>Update Complaint work
                                    order</strong></div>

                            <div class="card-body">

                                <?php

if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User name is mandatory field!</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User email is mandatory field!</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User phone is mandatory field!</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){

    echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete a user and then try again <strong>We set limit for security reasons!</strong></div>';

}

?>


                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between w-100 border-bottom pb-2">
                                        <div>
                                            <span> Complaint Number :</span> <span
                                                class="ft-s-16 ft-w-600 ft-c-red"><?php echo $compcode; ?>
                                            </span>
                                        </div>

                                        <div>
                                            <span> Complaint Date and Time :</span><span
                                                class="ft-s-16 ft-w-600 ft-c-red">
                                                <?php echo isset($row[0]['comp_datetime'])?$row[0]['comp_datetime']:''; ?>
                                            </span>
                                        </div>
                                        <div>
                                            <span> Complaint status :</span><span class="ft-s-16 ft-w-600 ft-c-red">
                                                <?php echo isset($row[0]['comp_status'])?$row[0]['comp_status']:''; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between text-left ">
                                        <div class="col-sm-5 mt-3">
                                            <label><strong>From</strong></label>
                                            <div class="ml-5 ft-c-black">
                                                <p><?php echo isset($row[0]['comp_name'])?$row[0]['comp_name']:''; ?>
                                                </p>
                                                <p><?php echo isset($row[0]['comp_bankname'])?$row[0]['comp_bankname']:''; ?>
                                                </p>
                                                <p><?php echo isset($row[0]['comp_branch'])?$row[0]['comp_branch']:''; ?>
                                                </p>
                                                <p><?php echo isset($row[0]['comp_baddress'])?$row[0]['comp_baddress']:''; ?>
                                                </p>
                                                <p>Mobile #:
                                                    <?php echo isset($row[0]['comp_number'])?$row[0]['comp_number']:''; ?>
                                                </p>
                                                <p>email :
                                                    <?php echo isset($row[0]['comp_email'])?$row[0]['comp_email']:''; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 mt-3">
                                            <label><strong></strong></label>
                                            <div class="ft-c-black">
                                                <p><span class="ft-c-gray  d-block">Subject: </span>
                                                    <?php echo isset($row[0]['comp_subject'])?$row[0]['comp_subject']:''; ?>
                                                </p>
                                                <p class="pt-2"><span class="ft-c-gray d-block">Message: </span>
                                                    Lorem Ipsum has been the industry's standard dummy text ever
                                                    since the 1500s, when an unknown printer took a galley of type
                                                    and scrambled it to make a type
                                                    ...<?php echo isset($row[0]['comp_msg'])?$row[0]['comp_msg']:''; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                 $cwo1compCount	=	$db->getQueryCount('complaint_work_order','*',' AND comp_code="'.$compcode.'"');
                                  if($cwo1compCount[0]['total']==0) { ?>
                            <div class="card-footer">
                                <div class="col-sm-12 d-flex w-100 justify-content-end">
                                    <!-- <button type="reset" class="btn btn-dark">Add Material</button> -->

                                    <button data-toggle="modal" data-target="#assign" type="submit"
                                        class="btn btn-primary ml-5">Assign Complaint Work Order</button>

                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="row ">

                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="title-1">Complaint Work Order Details</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                            <th>id</th>
                                                <th>Date</th>
                                                <th>Work Order #</th>
                                                <th>Techinican Name</th>
                                                <th class="text-right">Wages</th>
                                                <th class="text-right">Material Given</th>
                                                <th class="text-right">Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  foreach($workorderData as $val){ ?>
                                            <tr>
                                            <td><?php echo  $val['cwo_id']; ?></td>
                                                <td><?php echo  date('d-m-Y',strtotime($val['cwo_date'])); ?></td>
                                                <td><?php echo  $val['cwo_code']; ?></td>
                                                <td><?php echo  $val['tech_name']." - " . $val['emp_code'] ; ?></td>
                                                <td><?php echo  $val['cwo_amount']; ?></td>
                                                <td><?php echo  $val['cwo_material_given']; ?></td>
                                                <td><?php echo  $val['cwo_status']; ?></td>
                                                <td> <a href="" data-toggle="modal" data-target="#editupdate" class="editbtn"> <i class="fa fa-edit"></i> </a></td>
                                            </tr>

                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end">
                                        <?php
                                 $cwo1compCount	=	$db->getQueryCount('complaint_work_order','*',' AND comp_code="'.$compcode.'"');
                                  if($cwo1compCount[0]['total']!=0) { ?>
                                        <button data-toggle="modal" data-target="#update" type="submit"
                                            class="btn btn-success ml-5">Update Complaint Work Order</button>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                            <!-- <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Top countries</h2>
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                                <tbody>
                                                    <tr>
                                                        <td>United States</td>
                                                        <td class="text-right">$119,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Australia</td>
                                                        <td class="text-right">$70,261.65</td>
                                                    </tr>
                                                    <tr>
                                                        <td>United Kingdom</td>
                                                        <td class="text-right">$46,399.22</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Turkey</td>
                                                        <td class="text-right">$35,364.90</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Germany</td>
                                                        <td class="text-right">$20,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>France</td>
                                                        <td class="text-right">$10,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Australia</td>
                                                        <td class="text-right">$5,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Italy</td>
                                                        <td class="text-right">$1639.32</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <div class="clearfix"></div>



                        <!-- END FOOTER CONTENT-->
                        <?php require_once('../common/footer.php');  ?>
                        <!-- END FOOTER CONTAINER-->
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>


    <!-- Assugn the compliant firststart modal window-->
    <form name="myForm" id="needs-validation" action="" method="post" required>
        <!-- start modal window-->
        <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update complaints</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group data-pos">
                                    <label>Select the Technician</label>
                                    <input type="text" list="docs" class="tel form-control" name="emp_code"
                                        id="emp_code"
                                        value="<?php echo isset($_REQUEST['emp_code'])?$_REQUEST['emp_code']:''?>"
                                        placeholder="Enter transaction Number">
                                    <!-- <input type="text"  class="form-control" /> -->
                                    <datalist id="docs">
                                        <?php  foreach($employeeData as $val){ ?>
                                        <option>
                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                        </option>
                                        <?php  } ?>
                                    </datalist>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="cwo_date" id="cwo_date" class="form-control"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="cwo_amount" id="cwo_amount" class="form-control"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Complaint Status</label>
                                    <select class="form-control" id="cwo_status" name="cwo_status" required>
                                        <option value="Assigned">Assigned</option>
                                        <!-- <option value="Completed">Completed</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Reopened">Reopened</option>
                                        <option value="Work Inprogress">Work Inprogress</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Material Given</label>
                                    <select class="form-control" id="cwo_material_given" name="cwo_material_given"
                                        required>
                                        <option value="">Select Material Provided</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"> <label>Remedies / Reason /Remark</label>
                                    <textarea class="form-control demoInputBox" id="cwo_remedies" name="cwo_remedies"
                                        rows="3" required></textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i
                                class="fa fa-fw fa-plus-circle"></i> Add Record</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END PAGE CONTAINER-->

    <!-- Assugn the compliant firststart modal window-->
    <?php 
           if($cwo1compCount[0]['total']!=0) { 
         $uprow	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');  
        
        }

        ?>
    <form name="myForm" id="needs-validation" action="" method="post" required>
        <!-- start modal window-->
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update complaints1</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group data-pos">
                                    <label>Select the Technician</label>
                                    <input type="text" list="docs" class="tel form-control" name="emp_code"
                                        id="emp_code"
                                        value="<?php echo  $uprow[0]['emp_code']." ". $uprow[0]['tech_name'];?>"
                                        placeholder="Enter transaction Number">
                                    <!-- <input type="text"  class="form-control" /> -->
                                    <datalist id="docs">
                                        <?php  foreach($employeeData as $val){ ?>
                                        <option>
                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                        </option>
                                        <?php  } ?>
                                    </datalist>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="cwo_date" id="cwo_date" class="form-control"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="cwo_amount" id="cwo_amount" class="form-control"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Complaint Status</label>
                                    <select class="form-control" id="cwo_status" name="cwo_status" required>
                                        <option>Select</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Reassigned">Reassigned</option>
                                        <option value="Reopened">Reopened</option>
                                        <option value="Work Inprogress">Work Inprogress</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Material Given</label>
                                    <select class="form-control" id="cwo_material_given" name="cwo_material_given"
                                        required>
                                        <option value="">Select Material Provided</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"> <label>Remedies / Reason /Remark</label>
                                    <textarea class="form-control demoInputBox" id="cwo_remedies" name="cwo_remedies"
                                        rows="3" required></textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i
                                class="fa fa-fw fa-plus-circle"></i> Update Complaint Status</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END PAGE CONTAINER-->
    <!-- Assugn the compliant firststart modal window-->
    <?php 
           if($cwo1compCount[0]['total']!=0) { 
         $uprow	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');  
        
        }

        ?>
    <form name="myForm" id="needs-validation" action="" method="post" required>
        <!-- start modal window-->
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update complaints1</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group data-pos">
                                    <label>Select the Technician</label>
                                    <input type="text" list="docs" class="tel form-control" name="emp_code"
                                        id="emp_code"
                                        value="<?php echo  $uprow[0]['emp_code']." ". $uprow[0]['tech_name'];?>"
                                        placeholder="Enter transaction Number">
                                    <!-- <input type="text"  class="form-control" /> -->
                                    <datalist id="docs">
                                        <?php  foreach($employeeData as $val){ ?>
                                        <option>
                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                        </option>
                                        <?php  } ?>
                                    </datalist>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="cwo_date" id="cwo_date" class="form-control"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="cwo_amount" id="cwo_amount" class="form-control"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Complaint Status</label>
                                    <select class="form-control" id="cwo_status" name="cwo_status" required>
                                        <option>Select</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Reassigned">Reassigned</option>
                                        <option value="Reopened">Reopened</option>
                                        <option value="Work Inprogress">Work Inprogress</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Material Given</label>
                                    <select class="form-control" id="cwo_material_given" name="cwo_material_given"
                                        required>
                                        <option value="">Select Material Provided</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"> <label>Remedies / Reason /Remark</label>
                                    <textarea class="form-control demoInputBox" id="cwo_remedies" name="cwo_remedies"
                                        rows="3" required></textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i
                                class="fa fa-fw fa-plus-circle"></i> Update Complaint Status</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END PAGE CONTAINER-->
    <!-- Assugn the compliant firststart modal window-->
    <?php 
           if($cwo1compCount[0]['total']!=0) { 
         $uprow	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');  
        
        }

        if(isset($_REQUEST['editsubmit']) and $_REQUEST['editsubmit']!=""){
            extract($_REQUEST);
            $cwoCount	=	$db->getQueryCount('complaint_work_order','cwo_id');
            // echo "count" . $empCount[0]['total'];
         if($cwoCount[0]['total']==0){
             echo   $cwo_code = "CWO1";
            } else {
                $cwocompCount	=	$db->getQueryCount('complaint_work_order','*',' AND comp_code="'.$compcode.'"');
                if($cwocompCount[0]['total']==0){          
                    require_once('../model/complaint_work_order_class.php'); 
                    $dbcon = new complaintWorkOrder();
                        $hid = $dbcon->getmaxid() +1;
                    echo  $cwo_code = "CWO" . $hid;
                }else {
                    $crow	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');  
                    echo $cwo_code =$crow[0]['cwo_code'];
                }
            }
            $stringText  = $emp_code;
            $emp = explode(" ", $stringText);
            echo $emp[0]; //red 
            echo $techname = $emp[1]." ". $emp[2]; //yellow
         
            $ctdate=date('d-m-Y H:i:s');
        
                    $data	=	array(
                                    'cwo_code'=>$cwo_code,
                                    'emp_code'=> $emp[0],
                                    'tech_name'=> $techname,
                                    'comp_code'=>$compcode,							
                                    'cwo_date'=>$cwo_date,
                                    'cwo_timedate'=> $ctdate,
                                    'cwo_amount'=>$cwo_amount,
                                    'cwo_status'=>$cwo_status,
                                    'cwo_material_given'=>$cwo_material_given,
                                    'cwo_remedies'=>$cwo_remedies
                                    );
        
                                    $update	=	$db->update('complaint_work_order',$data,array('cwo_id'=>$uprow[0]['cwo_id'] ));
        
                                    if($update){
    
                                        // header('location:'.$_SERVER['PHP_SELF'].'?comp_id='.$_REQUEST['compid'].'');
                                        $cdata	=	array(
                        
                                            'comp_status'=>$cwo_status,
                                            );
                        
                                            $update	=	$db->update('complaint_register',$cdata,array('comp_code'=>$compcode));
                        
                                                if($update){
                        
                                                    header('location:complaint-edit.php?compid='.$compcode);
                                                    exit;
                        
                                                }
                                   
                        
                                            }else{
                        
                                        header('location:'.$_SERVER['PHP_SELF'].'?compid='.$compcode.'"');
                        
                                        exit;
                        
                                    }
            
        
                }

        ?>

    <!-- END PAGE CONTAINER-->

    <div class="modal fade" id="editupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update complaints</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="form-group">
                            <label> Id </label>
                            <input type="text" name="cwo_id" id="cwo_id" class="form-control" placeholder="Enter First Name">
                            </div>
                                <div class="form-group data-pos">
                                    <label>Technician</label>
                                    <input type="text" list="docs" class="tel form-control" name="emp_code"
                                        id="emp_code"
                                        
                                        placeholder="Enter transaction Number">
                                    <!-- <input type="text"  class="form-control" /> -->
                                    <datalist id="docs">
                                        <?php  foreach($employeeData as $val){ ?>
                                        <option>
                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                        </option>
                                        <?php  } ?>
                                    </datalist>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="cwodate" id="cwodate" class="form-control"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="cwo_amount" id="cwo_amount" class="form-control"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Complaint Status</label>
                                    <select class="form-control" id="cwo_status" name="cwo_status" required>
                                        <option>Select</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Reassigned">Reassigned</option>
                                        <option value="Reopened">Reopened</option>
                                        <option value="Work Inprogress">Work Inprogress</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Material Given</label>
                                    <select class="form-control" id="cwo_material_given" name="cwo_material_given"
                                        required>
                                        <option value="">Select Material Provided</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"> <label>Remedies / Reason /Remark</label>
                                    <textarea class="form-control demoInputBox" id="cwo_remedies" name="cwo_remedies"
                                        rows="3" required></textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i
                                class="fa fa-fw fa-plus-circle"></i> Update Complaint Status</button>
                    </div>
                </div>
            </div>
    </div>



    <?php require_once('../common/page-bottom.php');  ?>
    <script>
        $(document).ready(function () {
         
            $('.editbtn').on('click', function () {
              
                // $('#editmodal').modal("toggle");
                // alert();
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#cwo_id').val(data[0]);
                $('#cwodate').val(data[1]); 
                #('#emp_code').val(data[2])  ;    
                         
            });
        });
    </script>
</body>

</html>
<!-- end document-->