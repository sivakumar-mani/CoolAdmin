<?php 
session_start();
echo $_SERVER['PHP_SELF'];
        $_SESSION['search_result'] = "False";
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
    require_once('../model/permission_declare.php'); 
// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
        
    }
   
    ?>
<body class="animsition">

    <div class="page-wrapper region">
        <!-- HEADER MOBILE-->
        <?php require_once('../common/header.php');  ?>
        <!-- END HEADER MOBILE-->
        <!-- MENU SIDEBAR-->
        <?php require_once('../common/sidebar.php');  ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1 pb-3">Add Regional Office</h2>
                                </div>
                            </div>
                        </div>

                        <form method="post">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card bg-light " style="border-radius: 15px">
                                    <div class="card-body ">
                                        <div class="row pt-3">
                                            <div class="col-sm-3 text-right pt-2"> 
                                                <label>Enter Regional Bank IFSC: </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <input type="text" onfocusin="myFunction(this)" name="ifsc" id="ifsc" class="form-control"
                                                        placeholder="Enter bank code">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <button type="submit"  name="submit" value="search" id="submit"
                                                        class="btn btn-primary"><i class="fa fa-fw fa-search"></i>
                                                        Search Bank</button>
                                                    <!-- <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                        class="btn btn-danger ml-2"><i class="fa fa-fw fa-sync"></i>
                                                        Clear</a> -->
                                                </div>
                                            </div>
                                        </div>                                                     
                                    </div>
                                </div>
                                        <?php
                                       $office ="Office";
                                       $employeeData =	$db->getAllRecords('employee','*',' AND emp_dept="'.$office.'"'); 
                                            if(isset($_POST['ifsc'])) {
                                                $ifsc = $_POST['ifsc'];                                               
                                                $matchdata	=	$db->getQueryCount('regional_office','*',' AND ifsc="'.$ifsc.'"');
                                            // echo $matchdata[0]['total'];
                                            if($matchdata[0]['total']!=0){
                                                 ?>
                                                <div id="rosaved" class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i>
                                                    <?php $search_result1 = "False";   echo "This bank details already saved, please enter new bank details. ";   ?></div>
                                                    <?php }
                                                    $json = @file_get_contents(
                                                        "https://ifsc.razorpay.com/".$ifsc);
                                                    $arr = json_decode($json);
                                                    if(isset($arr->BRANCH)) {
                                                        $_SESSION['search_result'] = "True";
                                                        $_SESSION['search_result1'] = "True";
                                                        $ifsc =  $arr->IFSC;
                                                        $bankcode =  $arr->BANKCODE;
                                                        $bankname = $arr->BANK;
                                                        $branch = $arr->BRANCH;
                                                        $region = $arr->CENTRE;
                                                        $city = $arr->CITY;
                                                        $district = $arr->DISTRICT;
                                                        $state = $arr->STATE;
                                                        $_SESSION['micr']= $arr->MICR; 
                                                        $address= $arr->ADDRESS; 
                                                        $contact= $arr->CONTACT;
                                                }
                                                else { ?>

                       
                         
                            <?php $_SESSION['search_result']="False";  ?>
                            <div id="rofail" class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                                <?php   echo " Invalid Bank IFSC Code, please enter the correct bank code. ";   ?></div>

                            <?php                   }
                                            }
                                            ?>
                        </form>

                        <div class="clear-both"></div>
                        <div class="row">
                           
                        <div class="col-sm-12">
                            <?php  require_once('../common/message.php'); ?>
            </div>
                        </div>
                  

            <!-- <div class="card pb-3"> -->
            <div class="card pb-3" <?php if (($_SESSION['search_result'] == "False") || (isset($search_result1) == "False")){?>style="display:none" <?php } ?>>
                <div class="card-header"><i class="fa fa-fw fa-plus"></i> <strong>Add</strong> </div>

                <div class="card-body">
                    <?php require_once('../common/message.php');  ?>

                    <div class="col-sm-12  pt-3">
                        <form action="regionsave.php" method="POST">

                            <div class="row justify-content-between text-left ">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="comp_name">IFSC Code</label>
                                        <input class="tel form-control" name="ifsccode" onFocus="clearpage()" id="ifsccode"
                                            value="<?php if (isset($ifsc)) { echo $ifsc; } ; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="comp_name">Bank Code</label>
                                        <input class="tel form-control" name="bankcode" id="bankcode"
                                            value="<?php if (isset($bankcode)) { echo $bankcode; } ; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="comp_name">Bank Name</label>
                                        <input class="tel form-control" name="bankname" id="bankname"
                                            value="<?php if (isset($bankname)) { echo $bankname; } ; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="comp_name">Branch</label>
                                        <input class="tel form-control" name="branch" id="branch"
                                            value="<?php if (isset($branch)) { echo $branch; } ; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between text-left mt-2">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="comp_name">Region</label>
                                        <input class="tel form-control" name="region" id="region"
                                            value="<?php if (isset($region)) { echo $region; } ; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="comp_name">Address</label>
                                        <input class="tel form-control" name="bankaddress"
                                            id="bankaddress"
                                            value="<?php if (isset($address)) { echo $address; } ; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between text-left mt-2">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="comp_name">Contact</label>
                                        <input class="tel form-control" name="bankcontact1" id="bankcontact1"
                                            value="<?php if (isset($contact)) { echo $contact; } ; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="comp_name">City</label>
                                        <input class="tel form-control" name="bankcity" id="bankcity"
                                            value="<?php if (isset($city)) { echo $city; } ; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="comp_name">District</label>
                                        <input class="tel form-control" name="district" id="district"
                                            value="<?php if (isset($district)) { echo $district; } ; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="comp_name">State</label>
                                        <input class="tel form-control" name="state" id="state"
                                            value="<?php if (isset($state)) { echo $state; } ; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="page-header mb-2">
                                <h3> Please Bank Details</h3>
                            </div>
                            <div class="clearfix"></div>

                            <div class="row justify-content-between text-left ">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="comp_name">Bank Manager Name</label>
                                        <input class="tel form-control" name="contactPerson" id="contactPerson"
                                             required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="comp_name">Land Line Number</label>
                                        <input class="tel form-control" name="bankcontact2" id="bankcontact2"
                                           >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="comp_name">Mobile Number</label>
                                        <input class="tel form-control" name="mobilenumber" id="mobilenumber"
                                             required>
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-between text-left ">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="comp_name">Alternate Number</label>
                                        <input class="tel form-control" name="alternatenumber" id="alternatenumber"
                                             >
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="comp_name">Bank Email id</label>
                                        <input class="tel form-control" name="bankemailid" id="bankemailid"
                                             required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="region_incharge">Region Incharge</label>
                                        <select class="form-control" id="region_incharge" name="region_incharge" required>
                                            <option>Select Regional Incharge</option>
                                            <?php  foreach($employeeData as $val){ ?>
                                            <option value="<?php echo  $val['emp_code'];?>">
                                                <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                            </option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-between text-left mt-2">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between w-100">
                                        <a href="./employee-list.php" class="btn btn-dark w-40">Back</a>
                                        <button type="submit" name="Save" value="Save" id="Save"
                                            class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i>
                                            Add Regional Bank</button>
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
        </div>
        <?php require_once('../common/footer.php');  ?>
    </div>
    <?php require_once('../common/page-bottom.php');  ?>
    <script>
function myFunction(x) {
 document.getElementById('rosuccess').style= "display:none";
 document.getElementById('rosaved').style= "display:none";
 document.getElementById('rofail').style= "display:none";
 window.location.href = "./add-regional-office.php";
}
    </script>
</body>

</html>
<!-- end document-->