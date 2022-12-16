<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
    require_once('../model/permission_declare.php'); 
// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
    ?>
<?php
   if(isset($_FILES['dpimage'])){
      $errors= array();
      $file_name = $_FILES['dpimage']['name'];
      $file_size = $_FILES['dpimage']['size'];
      $file_tmp = $_FILES['dpimage']['tmp_name'];
      $file_type = $_FILES['dpimage']['type'];
      $tmp = explode('.', $file_name);
      $file_ext=end($tmp);
      $folder ="../assets/images/employee/";
    //   $newfilename = round(microtime(true)) . '.' . end($temp);
      $extensions= array("jpeg","jpg","png");
      
      if ( $file_name !="" ){
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
         $msg ="rest fsfsfsf";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
         $msg ="rest fsfsfsf";
      }
    }
      
      if(empty($errors)==true) {
        // $path = base_path().'/../httpdocs/images/';
         move_uploaded_file($file_tmp,$folder.$file_name);
         if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
            extract($_REQUEST);
            $empCount	=	$db->getQueryCount('employee','emp_id');
            // echo "count" . $empCount[0]['total'];
         if($empCount[0]['total']==0){
             echo   $emp_code = "EMP1";
            } else {
             require_once('../model/employee_class.php'); 
             $dbcon = new employee();
                  $hid = $dbcon->getmaxid() +1;
             echo  $emp_code = "EMP" . $hid;
            }
        
          
        
            $data	=	array(
        
                'emp_code'=>$emp_code,
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
        
                
               
        $insert	=	$db->insert('employee',$data);
        
        if($insert){
        
        header('location:employee-list.php?msg=ras');
        
        exit;
        
        }else{
        
        header('location:employee-list.php?msg=rna');
        
        exit;
        
        }
            
        
            }
      }else{
        header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
      }
   }
?>
<?php 


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

                            <div class="card-header"><i class="fa fa-fw fa-plus"></i> <strong>Add</strong> </div>

                            <div class="card-body">

                            <div class="col-sm-12">
                            <?php  require_once('../common/message.php'); ?>
                        </div>
                                <div class="col-sm-12">
                                    <?php 
                                    	
                                    ?>
                           <form action = "" method = "POST" enctype = "multipart/form-data">


                                        <div class="row justify-content-between text-left ">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">First Name <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_fname"
                                                        name="emp_fname" required>
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Last Name <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_lname"
                                                        name="emp_lname" required>
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Spouse / Mother Name <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_sname"
                                                        name="emp_sname" required>
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between text-left mt-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_subject">Marital Status <sup>*</sup></label>
                                                    <select class="form-control demoInputBox" id="emp_marital_status" required
                                                        name="emp_marital_status" onfocusout="myFunction()" >
                                                        <option value="">Select</option>
                                                        <option value="Married">Married</option>
                                                        <option value="single">single</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Date of Birth <sup>*</sup></label>
                                                    <input type="date" class="form-control demoInputBox" id="emp_dob"
                                                        name="emp_dob" required>
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Primary Mobile Number <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_mobileno"
                                                        name="emp_mobileno"required >
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row justify-content-between text-left mt-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Alternate Mobile Number</label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_amobileno"
                                                        name="emp_amobileno" required>
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Qualification</label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_qualification"
                                                        name="emp_qualification" required>
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="comp_name">Aadhar Number</label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_aadhar"
                                                        name="emp_aadhar" required>
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between text-left mt-2">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="comp_email">Temperary address <sup>*</sup></label>
                                                        <textarea class="form-control demoInputBox" id="emp_taddress"
                                                            name="emp_taddress" rows="5" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="comp_email">Permanent address <sup>*</sup></label>
                                                        <textarea class="form-control demoInputBox" id="emp_paddress"
                                                            name="emp_paddress" rows="5" required></textarea>
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
                                                    <div id="preview"><img src="../assets/images/employee/profile_pricture.png"></div>
                                                    <input type="file" name="dpimage" id="dpimage" class="mt-2">
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                            <div class="row justify-content-between text-left mt-2">
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                    <label for="comp_name">Date of Joining <sup>*</sup></label>
                                                    <input type="date" class="form-control demoInputBox" id="emp_doj" name="emp_doj"
                                                    required >
                                                </div>
                                                <div class="form-group">
                                                    <label for="comp_subject">Department <sup>*</sup></label>
                                                    <select class="form-control demoInputBox" id="emp_dept" name="emp_dept"
                                                        onfocusout="myFunction()" required>
                                                        <option>Select Department</option>
                                                        <option value="Office">Office</option>
                                                        <option value="Technical">Technical</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="comp_email">Salary Account Details<sup>*</sup></label>
                                                    <textarea class="form-control demoInputBox" id="emp_bank_details" name="emp_bank_details"
                                                        rows="3" ></textarea>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="comp_email">Office Notes</sup></label>
                                                    <textarea class="form-control demoInputBox" id="emp_office_notes" name="emp_office_notes" rows="4"
                                                        ></textarea>
                                                </div>
                                               
                                            </div>
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                    <label for="comp_name">Designation <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_desig" name="emp_desig"
                                                    required >
                                                </div>
                                                <div class="form-group">
                                                    <label for="comp_name">Office email id <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_office_email"
                                                        name="emp_office_email" required>
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                     
                                                <div class="form-group">
                                                    <label for="comp_name">Blood Group</label>
                                                    <input type="text" class="form-control demoInputBox" id="blood_group"
                                                        name="blood_group" >
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comp_name">Salary<sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox" id="emp_salary"
                                                        name="emp_salary" >
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comp_subject">Job Status <sup>*</sup></label>
                                                    <select  class="form-control demoInputBox" id="emp_status" name="emp_status"
                                                        onfocusout="myFunction()">
                                                        <option value="Working" selected>Working</option>
                                                    </select>
                                                </div>
                                               </div>
                                            </div>
                                               </div>
                                            </div>
                                  
                                        <div class="row justify-content-between text-left mt-2">
                             

                                     
                                                <div class="col-sm-12">
                                                 
                                                        <div class="d-flex justify-content-between w-100">
                                                            <a href="./employee-list.php" class="btn btn-dark w-40">Back</a>
                                                            <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Enroll Employee Record</button>
                                                        </div>
                                                    
                                                </div>

                                            </form>
                                        </div>
                            </div>

                            <div class="clearfix"></div>



                            <!-- END FOOTER CONTENT-->
                        
                            <!-- END FOOTER CONTAINER-->
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once('../common/footer.php');  ?>
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