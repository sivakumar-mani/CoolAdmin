<?php 

include_once('../config/config.php');
require_once('../common/page-top.php'); 
// include_once('../config/dbconfig.php');
// $db = new dbconfig();

// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
  
    require_once('../model/dashboard_function.php'); 
    $dbcon = new dashboard();
    




?>
<?php

$condition	=	'';
if(isset($_REQUEST['comp_code']) and $_REQUEST['comp_code']!=""){
    $condition	.=	' AND comp_code LIKE "%'.$_REQUEST['comp_code'].'%" ';
}
if(isset($_REQUEST['comp_bankname']) and $_REQUEST['comp_bankname']!=""){
    $condition	.=	' AND comp_bankname LIKE "%'.$_REQUEST['comp_bankname'].'%" ';
}
if(isset($_REQUEST['comp_branch']) and $_REQUEST['comp_branch']!=""){
    $condition	.=	' AND comp_branch LIKE "%'.$_REQUEST['comp_branch'].'%" ';
}

if(isset($_REQUEST['comp_status']) and $_REQUEST['comp_status']!=""){
    $condition	.=	' AND comp_status LIKE "'.$_REQUEST['comp_status'].'" ';
}

// if(isset($_REQUEST['ac_trans_mode']) and $_REQUEST['ac_trans_mode']!=""){
//     $condition	.=	' AND ac_trans_mode LIKE "%'.$_REQUEST['ac_trans_mode'].'%" ';
// }

// if((isset($_REQUEST['fromdate']) and $_REQUEST['fromdate']!="") && (isset($_REQUEST['todate']) and $_REQUEST['todate']!="")){
//     $condition	.=	' AND ac_trans_date BETWEEN "'.$_REQUEST['fromdate'].'" AND "'.$_REQUEST['todate'].'" ';
// }

// if(isset($_REQUEST['fromdate']) and $_REQUEST['fromdate']!=""){
//     $condition	.=	' AND ac_trans_date LIKE "'.$_REQUEST['fromdate'].'"  ';
// }

// ------------- Debit total statement -----------

// $qry = "SELECT SUM(ac_amount) AS count FROM complaint_register WHERE ac_trans_type='Debit'  ".$condition."";

// $res = $dbcon->connection->query($qry);
// $total = 0;
// $rec =  $res->fetch_assoc();
// $total = $rec['count'];

// ------------- Credit  total statement -----------
// $qry1 = "SELECT SUM(ac_amount) AS count  FROM complaint_register WHERE ac_trans_type='Credit' ".$condition."";

// $res1 = $dbcon->connection->query($qry1);
// $ctotal = 0;
// $rec1 =  $res1->fetch_assoc();
// $ctotal = $rec1['count'];

 //Main queries
 $pages->default_ipp	=	15;
 $sql 	= $db->getRecFrmQry("SELECT * FROM complaint_register WHERE 1 ".$condition."");
 $pages->items_total	=	count($sql);
 $pages->mid_range	=	9;
 $pages->paginate(); 
$complaintData	=   $db->getRecFrmQry("SELECT * FROM complaint_register WHERE 1 ".$condition." ORDER BY comp_id DESC ".$pages->limit."");

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
                                    <h2 class="title-1 pb-3 pb-3">Complaint Register</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-search"></i> <strong>Search</strong> <a
                                    href="../view/complaint-add.php" class="float-right btn btn-dark btn-sm"><i
                                        class="fa fa-fw fa-plus-circle"></i> Add Complaints</a></div>

                            <div class="card-body">

                             <?php require_once('../common/message.php');  ?>



                                <div class="col-sm-12">



                                    <form method="get">

                                        <div class="row">

                                            <div class="col-sm-2">

                                                <div class="form-group">

                                                    <label>Complaint #</label>

                                                    <input type="text" name="comp_code" id="comp_code"
                                                        class="form-control"
                                                        value="<?php echo isset($_REQUEST['comp_code'])?$_REQUEST['comp_code']:''?>"
                                                        placeholder="Enter complaint number">

                                                </div>

                                            </div>
                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Bank Name</label>

                                                    <input type="text" class="tel form-control" name="comp_bankname"
                                                        id="comp_bankname"
                                                        value="<?php echo isset($_REQUEST['comp_bankname'])?$_REQUEST['comp_bankname']:''?>"
                                                        placeholder="Enter bank name">

                                                </div>

                                            </div>
                                            <div class="col-sm-3">

                                                <div class="form-group">

                                                    <label>Branch</label>

                                                    <input type="text" name="comp_branch" id="comp_branch"
                                                        class="form-control"
                                                        value="<?php echo isset($_REQUEST['comp_branch'])?$_REQUEST['comp_branch']:''?>"
                                                        placeholder="Enter branch location">

                                                </div>

                                            </div>

                                            <div class="col-sm-2">

                                                <div class="form-group">

                                                <label for="comp_number">Complaint Status</label>
                                                    <input type="text" list="docs" class="tel form-control"
                                                        name="comp_status" id="comp_status"
                                                        value="<?php echo isset($_REQUEST['comp_status'])?$_REQUEST['comp_status']:''?>"
                                                        placeholder="Select complaint status">
                                                    <!-- <input type="text"  class="form-control" /> -->
                                                    <datalist id="docs">
                                                        <option>Assigned</option>
                                                        <option>Completed</option>
                                                        <option>Hold</option>
                                                        <option>Inprogress</option>
                                                        <option>Open</option>
                                                    </datalist>
                                                </div>

                                            </div>
                                            <div class="col-sm-2">
                                            <label>&nbsp;</label>
<div class="form-group">


                                                        <button type="submit" name="submit" value="search" id="submit"
                                                            class="btn btn-primary"><i class="fa fa-fw fa-search"></i>
                                                            </button>

                                                        <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                            class="btn btn-danger ml-3"><i class="fa fa-fw fa-sync"></i>
                                                            </a>
  </div>  </div>


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
                                        <th>Comp#</th>
                                        <th width="100">Date</th>
                                        <th>Bank Details</th>
                                        <th>Reporter Details</th>
                                        <th>Complaint Details</th>
                                        <th>Status</th>
                                        <?php if( $_SESSION['adminlevel']==1 || $_SESSION['adminlevel']==0 ) :?>
                                        <th width="100" class="text-center">Action</th>
                                       <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($complaintData)>0){
                                            $s	=	'';
                                            foreach($complaintData as $val){
                                                $s++;
                                            
                                        ?>
                                    <tr>

                                        <td>   
                                           
                                            <a href="complaint-edit.php?editId=<?php echo $val['comp_code'];?>"
                                                class="text-primary ml-2 mr-2"><?php echo $val['comp_code'];?></a>
                                       
                                        </td>
                                        <td><?php echo $val['comp_datetime'];?></td>
                                        <td><?php echo $val['comp_bankname'] ."<br>". $val['comp_branch']."<br>". $val['comp_baddress'] ;?></td>
                                        <td><?php echo $val['comp_name'] ."<br>".$val['comp_email'] ."<br>". $val['comp_number'] ;?>
                                        </td>
                                        <td><?php echo $val['comp_subject'] ."<br>".$val['comp_msg']; ?></td>
                                        <td><?php echo $val['comp_status']; ?></td>
                                   
                                        <td align="center">
                                        <?php if( $_SESSION['adminlevel']==1 ) :?>
                                            <a href="complaint-work-order.php?compid=<?php echo $val['comp_code'];?>"
                                                class="text-primary ml-2 mr-2">Assign</a> <br><br>
                                                <?php endif ?>
                                                <?php if( $_SESSION['adminlevel']==0 ) :?>

                                                   
                                                    <!-- <button type="button"  data-toggle="modal" data-target="#deletemodal" class="btn btn-danger deletebtn"> DELETE </button> -->
                                            <a href="" data-toggle="modal" data-target="#deletemodal"class="text-danger ml-2 mr-2 deletebtn">
                                                <i
                                                    class="fa fa-fw fa-trash"></i> </a>
                                                    <?php endif ?>
                                                   
                                                        <?php if( $_SESSION['adminlevel']>=1 ) :?>
                                            <a href="complaint-view.php?compid=<?php echo $val['comp_code'];?>"
                                                class="text-primary ml-2 mr-2">View</i></a>
                                           <?php endif ?>
                                        </td>
                                     
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
 <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
 <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Complaint Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="complaint-delete.php" method="POST">

                    <div class="modal-body">

                        

                        <h4> Do you want to Delete this Complaint : <input type="text" name="delete_id" id="delete_id"> ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                // $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>
</body>

</html>
<!-- end document-->