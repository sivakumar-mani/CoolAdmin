<?php 
require_once('../common/page-top.php'); 
require_once('../model/permission_declare.php'); 
include_once('../config/config.php');
// include('../config/dbconfig.php');
// $dbcon = new dbconfig();



session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }

    require_once('../model/permission.php'); 
    $dbcon = new permission();
    
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
                                    <h2 class="title-1 pb-3">Dashboard </h2>
                                    <!-- <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add item</button> -->
                                </div>
                            </div>
                        </div>

                        <?php 
                            require_once('../model/dashboard_function.php'); 
                            $dbcon = new dashboard();

                            // result of complaint result in widget
                        // $totalcount=$dbcon->total_count();
                        // $openstatus=$dbcon->open_status_count();
                        // $completedstatus=$dbcon->completed_status_count();
                        // $assignedcount=$dbcon->assigned_status_count();
                        // $availablebalance = $dbcon->available_balance();
                        $totalWorkingEmp = $dbcon->total_employee();
                        $totalresignemp = $dbcon-> total_ressigned_employee();
                        // $todaydebit = $dbcon-> today_debit();
                        // $todaycredit = $dbcon-> today_credit();
                        // $permit = $dbcon-> permits();

                        $openstatus =0;
                        $assignedcount=0;
                        $completedstatus=0;
                        $totalcount=0;
                        ?>

                        <div class="row">
                            <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_complaint'] == $ok ):?>
                            <div class="col-sm-4">
                                <div class="widget-box">
                                    <div class="widget-inner">
                                        <div class="d-flex brd-bottom pb-2">
                                        <img src="../assets/images/complaint-icon.png"  alt="" />
                                        <h2 class="heading">COMPLAINTS STATUS </h2>
                                        </div>
                                        <table class="table">
  <tbody>
    <tr>
   
        <td> 
            <a href="complaint-register.php?comp_status=Open"> New Complaints -</a>
        </td>
        <td align="right"><?php echo $openstatus; ?></td>
    <tr>
    <td> 
            <a href="complaint-register.php?comp_status=Assigned"> Assigned Complaints -</a>
        </td>
        <td align="right"><?php echo $assignedcount; ?></td>
    </tr>
    <tr>
      <td>Pending Complaints :</td>
      <td align="right"><?php echo $openstatus; ?></td>
    </tr>
    <tr>
      <td>Completed Complaints :</td>
      <td align="right"><?php echo $completedstatus; ?></td>
    </tr>
    <tr>
      <td>Total Complaints :</td>
      <td align="right"><?php echo $totalcount; ?></td>
    </tr>
  </tbody>
</table>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                            <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_accounts'] == $ok ):?>
                            <div class="col-sm-4">
                               
                            <div class="widget-box">
                                    <div class="widget-inner">
                                        <div class="d-flex brd-bottom pb-2">
                                        <img src="../assets/images/complaint-icon.png"  alt="" />
                                        <h2 class="heading">ACCOUNTS DETAILS</h2>
                                        </div>
                                        <table class="table">
  <tbody>
    <tr>
   
        <td> 
        Available balance 
                                               
        </td>
        <td align="right"><?php  $availablebalance=0; echo $availablebalance;?></td>
    <tr>
    <td colspa="2"> 
           <span class="ft-bold">Yesterday Transaction <?php echo date("d-m-Y", strtotime("yesterday")); ?></span>
       
    </tr>
    <tr>
      <td>Credit  :</td>
      <td align="right"><?php $todaycredit=0; echo  $todaycredit; ?></td>
    </tr>
    <tr>
      <td>Debit :</td>
      <td align="right"><span class="text-right"><?php $todaydebit=0; echo  $todaydebit; ?></span></td>
    </tr>
   
    <tr class="bg-light">
      <td>Balance :</td>
      <td align="right"><?php $todaycredit =0; $todaydebit=0; echo  $todaycredit - $todaydebit ; ?></td>
    </tr>
  </tbody>
</table>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                            <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_hr'] == $ok ):?>
                            <div class="col-sm-4">
                               
                            <div class="widget-box">
                                    <div class="widget-inner">
                                        <div class="d-flex brd-bottom pb-2">
                                        <img src="../assets/images/complaint-icon.png"  alt="" />
                                        <h2 class="heading">EMPLOYEE DETAILS</h2>
                                        </div>
                                        <table class="table">
  <tbody>
    <tr>
   
        <td> 
        Working Employee #
                                               
        </td>
        <td align="right"><?php   echo  $totalWorkingEmp;?></td>
    <tr>
    <td colspa="2"> 
           <span class="ft-bold">Reassigned Count # </span>
           <td align="right"><?php echo       $totalresignemp; ?></td>
    </tr>

  </tbody>
</table>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>

                      
                        
                        <?php require_once('../common/footer.php');  ?>
                        <!-- END FOOTER CONTAINER-->
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