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
if(isset($_REQUEST['bifsc']) and $_REQUEST['bifsc']!=""){
    $condition	.=	' AND ifsc LIKE "%'.$_REQUEST['bifsc'].'%" ';
}
if(isset($_REQUEST['bname']) and $_REQUEST['bname']!=""){
    $condition	.=	' AND bank LIKE "%'.$_REQUEST['bname'].'%" ';
}
if(isset($_REQUEST['bregion']) and $_REQUEST['bregion']!=""){
    $condition	.=	' AND region LIKE "%'.$_REQUEST['bregion'].'%" ';
}
// if(isset($_POST['bincharge']) and $_POST['bincharge']!=""){
//     $condition	.=	' AND region_incharge LIKE "%'.$_POST['bincharge'].'%" ';
// }
if(isset($_REQUEST['bbranch']) and $_REQUEST['bbranch']!=""){
    $condition	.=	' AND branch LIKE "%'.$_REQUEST['bbranch'].'%" ';
}

 //Main queries\
 $pages->default_ipp	=	15;
 $sql 	= $db->getRecFrmQry("SELECT * FROM regional_office WHERE 1 ".$condition."");
 $pages->items_total	=	count($sql);
 $pages->mid_range	=	9;
 $pages->paginate(); 
$regionalData	=   $db->getRecFrmQry("SELECT * FROM regional_office WHERE 1 ".$condition." ORDER BY rocode ASC ".$pages->limit."");

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
                                    <h2 class="title-1 pb-3">Regional Office List</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-search"></i> <strong>Search</strong>
                                <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_hr'] == $ok  && $loginPermit[0]['admin_hr'] == $ok):?>
                                <a href="../view/regional-office-enroll.php" class="float-right btn btn-dark btn-sm"><i
                                        class="fa fa-fw fa-plus-circle"></i> Add Regional Office</a>
                                <?php endif ?>


                            </div>

                            <div class="card-body">

                                <?php  require_once('../common/message.php'); ?>

                                <div class="col-sm-12">



                                    <form method="get">

                                        <div class="row pt-3">

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>IFSC</label>
                                                    <input type="text" name="bifsc" id="bifsc" class="form-control"
                                                        value="<?php echo isset($_REQUEST['bifsc'])?$_REQUEST['bifsc']:''?>"
                                                        placeholder="Enter bank code">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Bank Name</label>
                                                    <input type="text" class="tel form-control" name="bname" id="bname"
                                                        value="<?php echo isset($_REQUEST['bname'])?$_REQUEST['bname']:''?>"
                                                        placeholder="Enter bank name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Bank Region</label>
                                                    <input type="text" class="tel form-control" name="bregion"
                                                        id="bregion"
                                                        value="<?php echo isset($_REQUEST['bregion'])?$_REQUEST['bregion']:''?>"
                                                        placeholder="Enter bank region">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-1">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Branch</label>
                                                    <input type="text" name="bbranch" id="bbranch" class="form-control"
                                                        value="<?php echo isset($_REQUEST['bbranch'])?$_REQUEST['bbranch']:''?>"
                                                        placeholder="Enter branch">
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="region_incharge">Region Incharge</label>
                                                    <select class="form-control" id="bincharge"
                                                        name="bincharge">
                                                        <option>Select Regional Incharge</option>
                                                        <?php $office ="Office";
                                                              $employeeData =	$db->getAllRecords('employee','*',' AND emp_dept="'.$office.'"'); 
                                                            foreach($employeeData as $val){ ?>
                                                        <option value="<?php echo  $val['emp_code'];?>">
                                                            <?php echo  $val['emp_code']." ". $val['emp_fname'] ." ". $val['emp_lname'];?>
                                                        </option>
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                            </div> -->

                                            <div class="col-sm-4">
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
                                        <th width="20%">Bank Code</th>
                                        <th width="35%">Bank Information</th>
                                        <th width="35%">Bank Contact Details</th>
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($regionalData)>0){
                                            $s	=	'';
                                            foreach($regionalData as $val){
                                                $s++;
                                            
                                        ?>
                                    <tr>


                                        <td>
                                            IFSC: <strong><?php echo $val['ifsc'];?></strong><br>
                                            Region: <strong><?php echo $val['region'];?></strong><br>
                                            <?php $empcode =$val['region_incharge'];
                                            $sql ="SELECT * FROM employee where emp_code ='$empcode'";
                                            $result = mysqli_query($dbcon->connection, $sql);
                                                  $row = mysqli_fetch_array($result); ?>
                                            Incharge: <strong><?php echo $row['emp_fname'];?></strong><br>
                                        </td>
                                        <td><span class="upperCase"><?php echo $val['bank'];?><br></span>
                                            Branch: <?php echo $val['branch'];?><br>
                                            Address:<br> <?php echo $val['address'];?>
                                        </td>
                                        <td>Manager: <span
                                                class="upperCase"><?php echo $val['contactPerson'];?><br></span>
                                            Contact: <?php echo $val['contactNo1'];?><br>
                                            Contact: <?php echo $val['contactNo2'];?><br>
                                            Mobile: <?php echo $val['mobilenumber'];?><br>
                                            eMail: <?php echo $val['bankemailid'];?><br>
                                        </td>


                                        <td align="center" style="vertical-align:middle !important">

                                            <a href="employee-view.php?empid=<?php echo $val['emp_id'];?>"
                                                class="text-primary ml-2 mr-2"><i
                                                    class="fa fa-fw fa-eye"></i></a><br><br>
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