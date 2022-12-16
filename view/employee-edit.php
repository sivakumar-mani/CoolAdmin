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

    $folder ="../assets/images/employee/";
    if(isset($_FILES['dpimage']['name']) and $_FILES['dpimage']['name']!=""){
        $file_name=$_FILES['dpimage']['name'];
    }else {
        $file_name=$row[0]['emp_profile_img_name'];
    }
   

 
   
    $data	=	array(

        // 'emp_code'=>$emp_code,
        'emp_fname'=>$emp_fname,
        'emp_lname'=>$emp_lname,						
        'emp_marital_status'=>$emp_marital_status,
        'emp_sname'=>$emp_sname,
        'emp_dob'=>$emp_dob,
        'emp_doj'=>$emp_doj,
        'emp_dor'=>$emp_doj,
        'blood_group'=>$blood_group,
        'emp_mobileno'=>$emp_mobileno,
        'emp_amobileno'=>$emp_amobileno,
        'emp_paddress'=>$emp_paddress,
        'emp_taddress'=>$emp_taddress,
        'emp_salary'=>$emp_salary,
        'emp_office_email'=>$emp_office_email,
        'emp_bank_details'=>$emp_bank_details,
        'emp_office_notes'=>$emp_office_notes,
        'emp_dept'=>$emp_dept,
        'emp_status'=>$emp_status,
        'emp_qualification'=>$emp_qualification,
        'emp_profile_img_path'=>$folder,
        'emp_profile_img_name'=>$file_name,
        'emp_aadhar'=>$emp_aadhar,
        'emp_desig'=>$emp_desig,
        );

        
       
        $update	=	$db->update('employee',$data,array('emp_id'=>$empid));
        $errors= array();
        
        $file_size = $_FILES['dpimage']['size'];
        $file_tmp = $_FILES['dpimage']['tmp_name'];
        $file_type = $_FILES['dpimage']['type'];
        $tmp = explode('.', $file_name);
        $file_ext=end($tmp);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 2097152) {
           $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true) {
           move_uploaded_file($file_tmp,"../assets/images/employee/".$file_name);
           
        }else{
           print_r($errors);
        }
  
        if($update){
            
            header('location:employee-list.php?msg=ras');

            exit;

        }else{

            header('location:employee-list.php?msg=rna');

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
                                    <h2 class="title-1 pb-3">Enroll Employee</h2>
                                </div>
                            </div>
                        </div>
                      


                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-edit"></i> <strong>Edit Employee details</strong> </div>

                            <div class="card-body">

                            <?php require_once('../common/message.php');  ?>
                                <div class="col-sm-12">
                                    <?php 
                                    	
                                    ?>
                           <form action = "" method = "POST" enctype = "multipart/form-data">
                            <div class="row mb-3">
                           <div class="col-sm-4">
                                            <span class="ft-s-16 ft-w-600 ft-c-red"> Employee Number :<?php echo isset($row[0]['emp_code'])?$row[0]['emp_code']:''; ?> </span> 
                                            </div>
                                  
                                            </div>
                                        <div class="row justify-content-between text-left ">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">First Name <sup>*</sup></label>
                                                    <input type="text" class="form-control " id="emp_fname" value="<?php echo isset($row[0]['emp_fname'])?$row[0]['emp_fname']:''; ?>"
                                                        name="emp_fname" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Last Name <sup>*</sup></label>
                                                    <input type="text" class="form-control " id="emp_lname" value="<?php echo isset($row[0]['emp_lname'])?$row[0]['emp_lname']:''; ?>"
                                                        name="emp_lname" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Spouse / Mother Name <sup>*</sup></label>
                                                    <input type="text" class="form-control " id="emp_sname" value="<?php echo isset($row[0]['emp_sname'])?$row[0]['emp_sname']:''; ?>"
                                                        name="emp_sname" required>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between text-left mt-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_subject">Marital Status <sup>*</sup></label>
                                                    <select class="form-control " id="emp_marital_status" required
                                                        name="emp_marital_status" onfocusout="myFunction()" >
                                                        <option value="<?php echo isset($row[0]['emp_marital_status'])?$row[0]['emp_marital_status']:''; ?>"><?php echo isset($row[0]['emp_marital_status'])?$row[0]['emp_marital_status']:''; ?></option>
                                                        <option value="Married">Married</option>
                                                        <option value="Single">Single</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Date of Birth <sup>*</sup></label>
                                                    <input type="date" class="form-control " id="emp_dob" value="<?php echo isset($row[0]['emp_dob'])?$row[0]['emp_dob']:''; ?>"
                                                        name="emp_dob" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Primary Mobile Number <sup>*</sup></label>
                                                    <input type="text" class="form-control " id="emp_mobileno" value="<?php echo isset($row[0]['emp_mobileno'])?$row[0]['emp_mobileno']:''; ?>"
                                                        name="emp_mobileno"required >
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row justify-content-between text-left mt-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Alternate Mobile Number</label>
                                                    <input type="text" class="form-control " id="emp_amobileno" value="<?php echo isset($row[0]['emp_amobileno'])?$row[0]['emp_amobileno']:''; ?>"
                                                        name="emp_amobileno" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Qualification</label>
                                                    <input type="text" class="form-control " id="emp_qualification" value="<?php echo isset($row[0]['emp_qualification'])?$row[0]['emp_qualification']:''; ?>"
                                                        name="emp_qualification" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Aadhar Number</label>
                                                    <input type="text" class="form-control " id="emp_aadhar" value="<?php echo isset($row[0]['emp_aadhar'])?$row[0]['emp_aadhar']:''; ?>"
                                                        name="emp_aadhar" required>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between text-left mt-2">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="comp_email">Temperary address <sup>*</sup></label>
                                                        <textarea class="form-control " id="emp_taddress"
                                                            name="emp_taddress" rows="5" required><?php echo isset($row[0]['emp_taddress'])?$row[0]['emp_taddress']:''; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="comp_email">Permanent address <sup>*</sup></label>
                                                        <textarea class="form-control " id="emp_paddress"
                                                            name="emp_paddress" rows="5" required><?php echo isset($row[0]['emp_paddress'])?$row[0]['emp_paddress']:''; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="clearfix"></div>

                                        <div class="page-header mb-2">
                                            <h3> Please Fill Employee Office Details</h3>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="row justify-content-between text-left mt-2">
                                        <div class="col-sm-4">
                                        <div class="form-group">
                                                    <label for="comp_name">Profile Picture</label>
                                                    <div id="preview"><img src="<?php echo isset($row[0]['emp_profile_img_path'])?$row[0]['emp_profile_img_path']:''; ?><?php echo isset($row[0]['emp_profile_img_name'])?$row[0]['emp_profile_img_name']:''; ?>"></div>
                                                    <input type="file" name="dpimage" id="dpimage"  class="mt-2" value="<?php echo isset($row[0]['emp_profile_img_name'])?$row[0]['emp_profile_img_name']:''; ?>">
                                                </div>
                                        </div>
                                        <div class="col-sm-8">
                                        <div class="row justify-content-between text-left mt-2">
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                                    <label for="comp_name">Date of Joining <sup>*</sup></label>
                                                    <input type="date" class="form-control " id="emp_doj" name="emp_doj" value="<?php echo isset($row[0]['emp_doj'])?$row[0]['emp_doj']:''; ?>"
                                                    required >
                                                </div>
                                                <div class="form-group">
                                                    <label for="comp_subject">Department <sup>*</sup></label>
                                                    <select class="form-control " id="emp_dept" name="emp_dept"
                                                        onfocusout="myFunction()" required>
                                                        <option value="<?php echo isset($row[0]['emp_dept'])?$row[0]['emp_dept']:''; ?>"><?php echo isset($row[0]['emp_dept'])?$row[0]['emp_dept']:''; ?></option>
                                                        <option value="Office">Office</option>
                                                        <option value="Technical">Technical</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comp_name">Office email id <sup>*</sup></label>
                                                    <input type="text" class="form-control " id="emp_office_email" value="<?php echo isset($row[0]['emp_office_email'])?$row[0]['emp_office_email']:''; ?>"
                                                        name="emp_office_email" required>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="comp_name">Blood Group</label>
                                                        <input type="text" class="form-control " id="blood_group" value="<?php echo isset($row[0]['blood_group'])?$row[0]['blood_group']:''; ?>"
                                                        name="blood_group">
                                                    
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label for="comp_subject">Job Status <sup>*</sup></label>
                                                    <select class="form-control " id="emp_status" name="emp_status"
                                                        onfocusout="myFunction()">
                                                        <option value="<?php echo isset($row[0]['emp_status'])?$row[0]['emp_status']:''; ?>"><?php echo isset($row[0]['emp_status'])?$row[0]['emp_status']:''; ?></option>
                                                        <option value="Working" >
                                                           
                                                                <?php if($row[0]['emp_status']=='Resigned') :?>Working <?php endif ?>
                                                        </option>
                                                        <option value="Resigned" >
                                                            <?php if($row[0]['emp_status']=='Working') :?>Resigned <?php endif ?>
                                                        </option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                                    <label for="comp_name">Designation <sup>*</sup></label>
                                                    <input type="text" class="form-control " id="emp_desig" name="emp_desig" value="<?php echo isset($row[0]['emp_desig'])?$row[0]['emp_desig']:''; ?>"
                                                    required >
                                                </div>
                                        <div class="form-group">
                                                    <label for="comp_name">Salary<sup>*</sup></label>
                                                    <input type="text" class="form-control " id="emp_salary" value="<?php echo isset($row[0]['emp_salary'])?$row[0]['emp_salary']:''; ?>"
                                                        name="emp_salary" >
                                                    
                                                </div>
                                                  
                                                <div class="form-group mt-3">
                                                    <label for="comp_email">Salary Account Details<sup>*</sup></label>
                                                    <textarea class="form-control " id="emp_bank_details" name="emp_bank_details"
                                                        rows="3" ><?php echo isset($row[0]['emp_bank_details'])?$row[0]['emp_bank_details']:''; ?></textarea>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="comp_email">Office Notes</sup></label>
                                                    <textarea class="form-control " id="emp_office_notes" name="emp_office_notes" rows="3"
                                                        ><?php echo isset($row[0]['emp_office_notes'])?$row[0]['emp_office_notes']:''; ?></textarea>
                                                </div>
                                                
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                     
                                   


                                     
                                                <div class="col-sm-12">
                                                    <div class="row mt-3">
                                                        <div class="d-flex justify-content-between w-100">
                                                            <a href="./employee-list.php" class="btn btn-dark w-40">Back</a>
                                                            <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Update Employee Record</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                 
                        

                            <div class="clearfix"></div>



                            <!-- END FOOTER CONTENT-->
                         
                            <!-- END FOOTER CONTAINER-->
                      
                    </div>
                </div>
            </div>
            <?php require_once('../common/footer.php');  ?>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <?php require_once('../common/page-bottom.php');  ?>
    <script>
    function imagePreview(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                $('#preview').html('<img src="' + event.target.result + '" width="200" height="auto"/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    $("#dpimage").change(function() {
        imagePreview(this);
    });

    </script>
</body>

</html>
<!-- end document-->