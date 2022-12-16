<?php 

include_once('../config/config.php');
require_once('../common/page-top.php'); 
require_once('../model/permission_declare.php'); 
// include_once('../config/dbconfig.php');
// $db = new dbconfig();

// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }





?>
<?php

$condition	=	'';
if(isset($_REQUEST['emp_code']) and $_REQUEST['emp_code']!=""){
    $condition	.=	' AND emp_code LIKE "%'.$_REQUEST['emp_code'].'%" ';
}


if(isset($_REQUEST['emp_status']) and $_REQUEST['emp_status']!=""){
    $condition	.=	' AND emp_status LIKE "%'.$_REQUEST['emp_status'].'%" ';
}
if(isset($_REQUEST['emp_fname']) and $_REQUEST['emp_fname']!=""){
    $condition	.=	' AND emp_fname LIKE "%'.$_REQUEST['emp_fname'].'%" ';
}
 //Main queries\
 $pages->default_ipp	=	15;
 $sql 	= $db->getRecFrmQry("SELECT * FROM employee WHERE 1 ".$condition."");
 $pages->items_total	=	count($sql);
 $pages->mid_range	=	9;
 $pages->paginate(); 
$employeeData	=   $db->getRecFrmQry("SELECT * FROM employee WHERE 1 ".$condition." ORDER BY emp_code ASC ".$pages->limit."");

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
                                    <h2 class="title-1 pb-3">Employee List</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-search"></i> <strong>Search</strong>
                            <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_hr'] == $ok  && $loginPermit[0]['admin_hr'] == $ok):?>
                                <a href="../view/employee-enroll.php" class="float-right btn btn-dark btn-sm"><i
                                        class="fa fa-fw fa-plus-circle"></i> Enroll Employee</a>
                                        <?php endif ?>


                            </div>

                            <div class="card-body">

                            <?php  require_once('../common/message.php'); ?>

                                <div class="col-sm-12">



                                    <form method="get">

                                        <div class="row pt-3">

                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Employee#</label>

                                                    <input type="text" name="emp_code" id="emp_code"
                                                        class="form-control"
                                                        value="<?php echo isset($_REQUEST['emp_code'])?$_REQUEST['emp_code']:''?>"
                                                        placeholder="Enter Employee number">

                                                </div>

                                            </div>
                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Employee Name</label>
                                                    <input type="text" class="tel form-control" name="emp_fname"
                                                        id="emp_fname"
                                                        value="<?php echo isset($_REQUEST['emp_fname'])?$_REQUEST['emp_fname']:''?>"
                                                        placeholder="Enter employee name">

                                                </div>

                                            </div>
                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Employee Status</label>
                                                
                                                    <!-- <input type="text" class="tel form-control" name="emp_status"
                                                        id="emp_status"
                                                        value="<?php echo isset($_REQUEST['emp_status'])?$_REQUEST['emp_status']:''?>"
                                                        placeholder="Search employee status"> -->
                                                        <select class="form-control demoInputBox" id="emp_status" 
                                                        name="emp_status" onfocusout="myFunction()" >
                                                        <option value="">Select the status</option>
                                                        <option  value="Working">Working</option>
                                                        <option  value="Resigned">Resigned</option>
                                            
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-sm-3">
                                                <label></label>
                                                <div class="form-group">


                                                    <button type="submit" name="submit" value="search" id="submit"
                                                        class="btn btn-primary"><i class="fa fa-fw fa-search"></i>
                                                        Search</button>

                                                    <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                        class="btn btn-danger ml-2"><i class="fa fa-fw fa-sync"></i>
                                                        Clear</a>

                                                </div>

                                            </div>


                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <div class="row marginTop">
                            <div class="col-sm-12 paddingLeft pagerfwt">
                                <?php if($pages->items_total > 0) { ?>
                                <?php echo $pages->display_pages();?>
                                <?php echo $pages->display_items_per_page();?>
                                <?php echo $pages->display_jump_menu(); ?>
                                <?php }?>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="mt-2 mb-3">

                            <table class="table table-striped table-bordered">
                                <thead>

                                    <tr class="bg-primary text-white">
                                        <th width="120">Employee Info</th>
                                        <th width="150">Personnal Info</th>
                                        <th width="300">Address</th>
                                        <th>Office Info</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($employeeData)>0){
                                            $s	=	'';
                                            foreach($employeeData as $val){
                                                $s++;
                                            
                                        ?>
                                    <tr>


                                        <td><img src="<?php echo $val['emp_profile_img_path'] .$val['emp_profile_img_name'] ;?>"
                                                width="100">
                                            <br>
                                            Emp #: <strong><?php echo $val['emp_code'];?></strong>
                                        </td>
                                        <td><span
                                                class="upperCase"><?php echo $val['emp_fname']. " " . $val['emp_lname'];?><br></span>
                                            DOB :
                                            <?php $empdob = date('d-m-Y', strtotime($val['emp_dob'])); echo  $empdob;?>
                                            <br> <?php if($val['emp_marital_status'] =='Single'): ?>Mother :
                                            <?php endif ?>
                                            <?php if($val['emp_marital_status'] =='Married'): ?>Spouse : <?php endif ?>
                                            <?php echo $val['emp_sname']?><br>
                                            BG: <?php echo $val['blood_group']?>
                                        </td>

                                        <td><span class="ft-c-blue">Permenent Address:</span>
                                            <br><?php echo $val['emp_paddress'] ;?><br><span class="ft-c-blue">Temperary
                                                Address:</span><br> <?php echo $val['emp_taddress'] ;?>
                                        </td>
                                        <td>
                                            DOJ :
                                            <?php $empdoj = date('d-m-Y', strtotime($val['emp_doj'])); echo  $empdoj;?>
                                            <br>Phone : <?php echo $val['emp_mobileno'] ;?> <span
                                                class="ml-2"><?php echo $val['emp_amobileno'] ;?>
                                                <br>email Id : <?php echo $val['emp_office_email'] ;?>
                                            </span>
                                        </td>
                                        <td align="center" style="vertical-align:middle !important">
                                            <?php echo $val['emp_status'] ?></td>


                                        <td align="center" style="vertical-align:middle !important">
                                        
                                            <a href="employee-view.php?empid=<?php echo $val['emp_id'];?>"
                                                class="text-primary ml-2 mr-2"><i class="fa fa-fw fa-eye"></i></a><br><br>
                                                <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_hr'] == $ok  && $loginPermit[0]['admin_hr'] == $ok):?>
                                            <a href="employee-edit.php?empid=<?php echo $val['emp_id'];?>"
                                                class="text-primary ml-2 mr-2"><i class="fa fa-fw fa-edit"></i></a>
                                            <br><br>
                                         <?php endif ?>
                                         <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_hr'] == $ok  && $loginPermit[0]['superadmin'] == $ok):?>
                                            <a href="" class="text-danger ml-2 mr-2"
                                                onClick="return confirm('Are you sure to delete this user?');"><i
                                                    class="fa fa-fw fa-trash"></i> </a>
                                        </td>
                                        <?php endif ?>

                                    </tr>
                                    <?php 
            }
        }else{
        ?>
                                    <tr>
                                        <td colspan="5" align="center">No Record(s) Found!</td>
                                    </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                        <!--/.col-sm-12-->

                        <div class="clearfix"></div>

                        <div class="row marginTop">
                            <div class="col-sm-12 paddingLeft pagerfwt">
                                <?php if($pages->items_total > 0) { ?>
                                <?php echo $pages->display_pages();?>
                                <?php echo $pages->display_items_per_page();?>
                                <?php echo $pages->display_jump_menu(); ?>
                                <?php }?>
                            </div>
                            <div class="clearfix"></div>
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