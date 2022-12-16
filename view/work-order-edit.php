<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }

    if(isset($_REQUEST['cwoid']) and $_REQUEST['cwoid']!=""){
        $row	=	$db->getAllRecords('complaint_work_order','*',' AND cwo_id="'.$_REQUEST['cwoid'].'"'); 
       
    }
    $employeeData = $db->getAllRecords('employee','*');
    $compcode = $row[0]['comp_code'];

    
    ?>
<?php


if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){

    extract($_REQUEST);
    
        

    $empCount	=	$db->getQueryCount('employee','emp_id');
    // echo "count" . $empCount[0]['total'];
//  if($empCount[0]['total']==0){
//      echo   $emp_code = "EMP1";
//     } else {
//      require_once('../model/employee_class.php'); 
//      $dbcon = new employee();
//           $hid = $dbcon->getmaxid() +1;
//      echo  $emp_code = "EMP" . $hid;
//     }

    
   
    $stringText  = $emp_code;
    $emp = explode(" ", $stringText);
    echo $emp[0]; //red 
    echo $sendername = $emp[1]." ".$emp[2]; 

    $stringText  = $emp_code;
    $emp1 = explode(" ", $stringText);
    echo $emp1[0]; //red 
    echo $techname = $emp1[1]." ".$emp[2]; 

    // $ctdate=date('d-m-Y H:i:s');
 
   
    $data	=	array(
        'emp_code'=> $emp[0],
        'tech_name'=> $techname,					
        'cwo_date'=>$cwo_date,
        // 'cwo_timedate'=> $ctdate,
        'cwo_amount'=>$cwo_amount,
        'cwo_status'=>$cwo_status,
        'cwo_material_given'=>$cwo_material_given,
        'cwo_remedies'=>$cwo_remedies
        );

        
       
        $update	=	$db->update('complaint_work_order',$data,array('cwo_id'=> $_REQUEST['cwoid']));
        $errors= array();
        
      
        if($update){
            
            header('location:complaint-work-order.php?compid='.$compcode);

            exit;

        }else{

            header('location:complaint-work-order.php?compid='.$compcode);

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
                                    <h2 class="title-1 pb-3">Complaint Work Order Edit</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="card-body">

                            <?php require_once('../common/message.php');  ?>
                              
                                    <form action="" method="POST" enctype="multipart/form-data">
                      
                                  
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group data-pos">
                                    <label>Assign to Technician</label>
                                    <select class="tel form-control"  name="emp_code"
                                        id="emp_code">
                                        <option><?php echo  $row[0]['emp_code']." ".$row[0]['tech_name'];?>  </option>
                                        <?php  foreach($employeeData as $val){ ?>
                                                        <option>
                                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                                        </option>
                                                        <?php  } ?>
                                    </select>
                            
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="cwo_date" id="cwo_date" class="form-control"
                                        placeholder="Enter user name" value="<?php echo  $row[0]['cwo_date']?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="cwo_amount" id="cwo_amount" class="form-control"
                                        placeholder="Enter user name" value="<?php echo  $row[0]['cwo_amount'];?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Complaint Status</label>
                                    <select class="form-control" id="cwo_status" name="cwo_status" required>
                                        <?php if ($row[0]['cwo_status'] =="Assigned" ) :?>
 <option value="Assigned">Assigned</option>
                                        
 <?php endif ?>
 <?php if ($row[0]['cwo_status'] !="Assigned" ) :?>
                                        <option value="Completed">Completed</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Reopened">Reopened</option>
                                        <option value="Work Inprogress">Work Inprogress</option>
                                        <?php endif ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Material Given</label>
                                    <select class="form-control" id="cwo_material_given" name="cwo_material_given"
                                        required>
                                        <option value="<?php echo  $row[0]['cwo_material_given'];?>"><?php echo  $row[0]['cwo_material_given'];?></option>
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
                                        rows="3" required><?php echo  $row[0]['cwo_remedies'];?></textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                    <div class="d-flex justify-content-between w-100">
                    <a href="complaint-work-order.php?compid=<?php echo $compcode;?>" class="btn btn-dark w-40">Back</a>
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i
                                class="fa fa-fw fa-plus-circle"></i> Update Record</button>
                    </div>
                    </div>
                </div>
            
                                </form>



                               
                       
                    <?php require_once('../common/footer.php');  ?>
                    <!-- END MAIN CONTENT-->
                    <!-- END PAGE CONTAINER-->
                </div>

            </div>

            <?php require_once('../common/page-bottom.php');  ?>
           
</body>

</html>
<!-- end document-->