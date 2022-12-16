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

    // $employeeData =	$db->getAllRecords('complaint_register','*',' AND comp_code="'.$compcode.'"'); 

    $employeeData =	$db->getAllRecords('employee','*'); 

    $cwo_support_docs =	$db->getAllRecords('cwo_support_docs','*',' AND comp_code="'.$compcode.'"'); 

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

                            header('location:complaint-work-order.php?compid='.$compcode);
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
                                    <h2 class="title-1 pb-3">Update Complaint work order</h2>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header"><i class="fa fa-fw fa-edit"></i> <strong>Update Complaint work order</strong></div>

                            <div class="card-body">
                                <?php require_once('../common/message.php');  ?>
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
                                                <p class="pt-2"><span class="ft-c-gray d-block">Message: </span><?php echo isset($row[0]['comp_msg'])?$row[0]['comp_msg']:''; ?>
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
                                <h2 class="title-1 pb-3">Complaint Work Order Details</h2>
                                <div class="table-responsive table--no-card">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th>id</th>
                                                <th>Date</th>
                                                <th>Work Order #</th>
                                                <th>Techinican Name</th>
                                                <th >Wages</th>
                                                <th >Material Given</th>
                                                <th >Status</th>
                                                <th >Comments</th>                                              
                                                <th>Action</th>
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
                                                <td><div class="w-300"><?php echo  $val['cwo_remedies']; ?></div></td>                                             
                                                <!-- <td> <a href="" data-toggle="modal" data-target="#editupdate" class="editbtn"> <i class="fa fa-edit"></i> </a></td> -->
                                                <td> <?php if( $_SESSION['adminlevel']==1 ) :?>
                                                    <a href="work-order-edit.php?cwoid=<?php echo $val['cwo_id'];?>"
                                                        class="text-primary ml-2 mr-2"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>

                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                 
                                </div>
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

                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <h2 class="title-1 pb-3">Supported Documents to Complaint Work Order Details</h2>
                                <div class="table-responsive table--no-card">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr class="bg-success text-white">
                                                <th>id</th>
                                                <th>Doc Received Date</th>
                                                <th>Doc Sender Namer</th>
                                                <th>Doc Uplodaed Date</th>
                                                <th>Doc Uploaded By</th>                                              
                                                <th >Doc Name</th>
                                                <th>Remark</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  foreach($cwo_support_docs as $val){ ?>
                                            <tr>
                                                <td><?php echo  $val['attach_id']; ?></td>                                              
                                                <td><?php echo  date('d-m-Y',strtotime($val['doc_received_date'])); ?></td>
                                                <td><?php echo  $val['send_staff_name']; ?></td>                                         
                                                <td><?php echo  date('d-m-Y',strtotime($val['doc_updated_date'])); ?></td>
                                                <td><?php echo  $val['uploded_staff_name']; ?></td>
                                                <td><?php echo  $val['docs_img_name']; ?>
                                                <a href="<?php echo  $val['docs_img_path']."/".$val['docs_img_name']; ?>" download>
                                                <i
                                                            class="fa fa-fw fa-download"></i>
</a>
                                            </td>
                                                <td><div class="w-300"><?php echo  $val['attach_comments']; ?></div></td>                                       
                                                <!-- <td> <a href="" data-toggle="modal" data-target="#editupdate" class="editbtn"> <i class="fa fa-edit"></i> </a></td> -->
                                                <td> <?php if( $_SESSION['adminlevel']==1 ) :?>
                                                    <a href="complaint-attach-docs-edit.php?attachid=<?php echo $val['attach_id'];?>"
                                                        class="text-primary ml-2 mr-2"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>

                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                 
                                </div>
                                <div class="d-flex justify-content-end">
                                        <?php
                                 $cwo1compCount	=	$db->getQueryCount('complaint_work_order','*',' AND comp_code="'.$compcode.'"');
                                  if($cwo1compCount[0]['total']!=0) { ?>
                                
                                <a href="complaint-attach-docs.php?comp_code=<?php echo $compcode;?>" 
                                                        class="btn btn-primary">Attach Documents</a>
                                        <?php } ?>
                                    </div>
                            </div>                           
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-12 mt-4">
                                        <div class="row">
                                            <div class="d-flex justify-content-center w-100">
                                                <a href="./complaint-register.php" class="btn btn-dark w-25">Back</a>

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
                                    <label>Assign to Technician</label>
                                    <select class="tel form-control"  name="emp_code"
                                        id="emp_code">
                                        <option type="hidden">  </option>
                                    <?php  foreach($employeeData as $val){ ?>
                                        <option value=" <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>">
                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                        </option>
                                        <?php  } ?>
                                    </select>
                                    <!-- <input type="text" list="docs" class="tel form-control" name="emp_code"
                                        id="emp_code"
                                        value="<?php echo isset($_REQUEST['emp_code'])?$_REQUEST['emp_code']:''?>"
                                        placeholder="Enter transaction Number">
                            
                                    <datalist id="docs">
                                        <?php  foreach($employeeData as $val){ ?>
                                        <option>
                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                        </option>
                                        <?php  } ?>
                                    </datalist> -->
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
                        <h5 class="modal-title" id="exampleModalLabel">Update complaints</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Update the Technician</label>
                                    <select class="tel form-control"  name="emp_code"
                                        id="emp_code">
                                        <option type="hidden">  </option>
                                    <?php  foreach($employeeData as $val){ ?>
                                        <option value=" <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>">
                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                        </option>
                                        <?php  } ?>
                                    </select>
                                    <!-- <input type="text" list="docs" class="tel form-control" name="emp_code"
                                        id="emp_code"
                                        value="<?php echo  $workorderData[0]['emp_code']." ". $workorderData[0]['tech_name'];?>"
                                        placeholder="Enter transaction Number">
                                   
                                    <datalist id="docs">
                                        <?php  foreach($employeeData as $val){ ?>
                                        <option>
                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                        </option>
                                        <?php  } ?>
                                    </datalist> -->
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="cwo_date" id="cwo_date" class="form-control"  value="<?php echo  $workorderData[0]['cwo_date']?>"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="cwo_amount" id="cwo_amount" class="form-control"  value="<?php echo  $workorderData[0]['cwo_amount']?>"
                                        placeholder="Enter user name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Complaint Status</label>
                                    <select class="form-control" id="cwo_status" name="cwo_status" required>                                     
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
                                        <option value="<?php echo  $workorderData[0]['cwo_material_given']?>"><?php echo  $workorderData[0]['cwo_material_given']?></option>
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
                                        rows="3" required><?php echo  $workorderData[0]['cwo_remedies']?></textarea>
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
                        
                                                    header('location:ccomplaint-work-order.php?compid='.$compcode);
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Complaint Work Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <p id="demo">test</p>
                                <label>IDs: <?php  echo  $_REQUEST["demo"]; if (isset($_REQUEST["demo"])){
	echo  $_REQUEST["demo"];
                                    }
   	 ?></label>
                                <label>ID:</label> <input type="text" name="cwo_id1" id="cwo_id1" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group data-pos">
                                <label>Enter Technician Name</label>
                                <input type="text" list="docs" class="tel form-control" name="emp_code1" id="emp_code1"
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
                                <input type="text" name="cwdates" id="cwdates" class="form-control"
                                    placeholder="Enter user name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" name="cwo_amount1" id="cwo_amount1" class="form-control"
                                    placeholder="Enter user name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>Complaint Status</label>

                                <input type="text" list="dstatus" class="tel form-control" name="cwo_status1"
                                    id="cwo_status1" placeholder="Enter transaction Number">
                                <!-- <input type="text"  class="form-control" /> -->
                                <datalist id="dstatus">
                                    <option value="Completed">Completed</option>
                                    <option value="Hold">Hold</option>
                                    <option value="Reassigned">Reassigned</option>
                                    <option value="Reopened">Reopened</option>
                                    <option value="Work Inprogress">Work Inprogress</option>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Material Given</label>
                                <select class="form-control" id="cwo_material_given1" name="cwo_material_given1"
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
                                <textarea class="form-control demoInputBox" id="cwo_remedies1" name="cwo_remedies1"
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
    $(document).ready(function() {

        $('.editbtn').on('click', function() {

            // $('#editmodal').modal("toggle");
            // alert();
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            $('#cwo_id1').val(data[0]);
            $('#cwdates').val(data[1]);
            $('#emp_code1').val(data[3]);
            $('#cwo_amount1').val(data[4]);
            $('#cwo_material_given1').val(data[5]);
            $('#cwo_status1').val(data[6]);
            $('#cwo_remedies1').val(data[7]);
            $('#demo').html($('#cwdates').val(data[1]));
        });
    });
    </script>
</body>

</html>
<!-- end document-->