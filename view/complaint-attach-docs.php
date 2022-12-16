<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }

    if(isset($_REQUEST['comp_code']) and $_REQUEST['comp_code']!=""){
        $row	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$_REQUEST['comp_code'].'"'); 
       
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

    $folder ="../assets/images/cwo/";
    if(isset($_FILES['supportdocs']['name']) and $_FILES['supportdocs']['name']!=""){
        $file_name=$_FILES['supportdocs']['name'];
    }else {
        $file_name=$row[0]['emp_profile_img_name'];
    }
   
    $stringText  = $sender_emp_code;
    $emp = explode(" ", $stringText);
    echo $emp[0]; //red 
    echo $sendername = $emp[1]." ". $emp[2]; 

    $stringText  = $uploded_emp_code;
    $emp1 = explode(" ", $stringText);
    echo $emp1[0]; //red 
    echo $uploadedrname = $emp1[1]." ". $emp1[2]; 


 
   
    $data	=	array(

        // 'emp_code'=>$emp_code,
        'cwo_code'=>$row[0]['cwo_code'],
        'comp_code'=>$_REQUEST['comp_code'],						
        'sender_emp_code'=>$emp[0],
        'uploded_emp_code'=>$emp1[0],
        'send_staff_name'=>$sendername,
        'uploded_staff_name'=>$uploadedrname,
        'doc_received_date'=>$doc_received_date,
        'doc_updated_date'=>$doc_updated_date,
        'docs_img_path'=>$folder,
        'docs_img_name'=>$file_name,
        'attach_comments'=>$attach_comments,
        );

        
       
        $insert	=	$db->insert('cwo_support_docs',$data);
        $errors= array();
        
        $file_size = $_FILES['supportdocs']['size'];
        $file_tmp = $_FILES['supportdocs']['tmp_name'];
        $file_type = $_FILES['supportdocs']['type'];
        $tmp = explode('.', $file_name);
        $file_ext=end($tmp);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $extensions= array("pdf","jpeg","jpg","png","doc", "xls");
        
        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 5097152) {
           $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true) {
           move_uploaded_file($file_tmp,"../assets/images/cwo/".$file_name);
           
        }else{
           print_r($errors);
        }
  
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
                                    <h2 class="title-1 pb-3">Attach Documents to Complaint Work Order</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-edit"></i> <strong>Attach Documents to Complaint Work Order</strong> </div>

                            <div class="card-body">

                            <?php require_once('../common/message.php');  ?>
                                <div class="col-sm-12">
                                    <?php 
                                    	
                                    ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="ft-s-16 ft-w-600 ft-c-red"> Complaint Number : <?php echo $row[0]['comp_code']; ?>
                                                </span>   
                                                <span>Complaint Work Order: <?php echo $row[0]['cwo_code']; ?></span>  
                                            </div>

                                        </div>
                                        <div class="modal-body">
                                     
                                            <div class="row">
                                            <div class="col-sm-6">
                                                    <div class="form-group">
                                                    <label>Document Sender Name</label>
                                    <select class="tel form-control"  name="emp_code"   id="emp_code">
                                        <option type="hidden">  </option>
                                        <?php  foreach($employeeData as $val){ ?>
                                                        <option>
                                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                                        </option>
                                                        <?php  } ?>
                                    </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Document Received Date</label> 
                                                        <input type="date" name="doc_received_date" id="doc_received_date" value=""
                                                            class="form-control" placeholder="Enter date" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                            <div class="col-sm-6">
                                                    <div class="form-group">
                                                    <label>Uploaded By</label>
                                    <select class="tel form-control"   name="uploded_emp_code"
                                        id="uploded_emp_code">
                                        <option type="hidden">  </option>
                                        <?php  foreach($employeeData as $val){ ?>
                                                        <option>
                                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                                        </option>
                                                        <?php  } ?>
                                    </select>
                                                        
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Document Uploaded Date</label> 
                                                        <input type="date" name="doc_updated_date" id="doc_updated_date" value=""
                                                            class="form-control" placeholder="Enter date" required>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                           

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group"> <label>Remark</label>
                                                        <textarea class="form-control demoInputBox" id="attach_comments"
                                                            name="attach_comments" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_name">Attach Document</label>
                                                    <div id="preview"></div>
                                                    <input type="file" name="supportdocs" id="supportdocs"  class="mt-2" value="<?php echo isset($row[0]['emp_profile_img_name'])?$row[0]['emp_profile_img_name']:''; ?>">
                                                </div>
                                                </div>
                                        </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row mt-3">
                                        <div class="d-flex justify-content-between w-100">
                                            <a href="complaint-work-order.php?compid=<?php echo $compcode;?>" class="btn btn-dark w-40">Back</a>
                                            <button type="submit" name="submit" value="submit" id="submit"
                                                class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Update
                                                Complaint Work Order</button>
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

            $("#supportdocs").change(function() {
                imagePreview(this);
            });
            </script>
</body>

</html>
<!-- end document-->