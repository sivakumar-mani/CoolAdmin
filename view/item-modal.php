<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }

    $editFlag = false;
    $catname ="";
    $catid =0;



    if(isset($_GET['catid'])){
        $editFlag = true;
        $getdata	=	$db->getAllRecords('category','*',' AND catid="'.$_REQUEST['catid'].'"');
        $catname = $getdata[0]['categoryname'];
        $categoryid = $getdata[0]['categoryid'];
        $catid = $getdata[0]['catid'];
    }



    if(isset($_POST['update'])){
        $categoryname = trim($_POST['categoryname']);
        $matchdata	=	$db->getQueryCount('category','*',' AND categoryname="'.$categoryname.'"');
        if($matchdata[0]['total']==0){
        $catid =$_GET['catid'];
        $data	=	array(          
            'categoryname'=>$_POST['categoryname'],
            );
        $update	=	$db->update('category',$data,array('catid'=>$catid));

        if($update){
                header('location:item-modal.php?msg=ras');
                exit;
            }else{
                header('location:item-modal.php?msg=rna');
                exit;
            }
        }
        else {
            header('location:item-modal.php?msg=matchprod');
            exit;
        }
    }

    if(isset($_POST['save'])){

        $categoryname = trim($_POST['categoryname']);
        $matchdata	=	$db->getQueryCount('category','*',' AND categoryname="'.$categoryname.'"');
        if($matchdata[0]['total']==0){
		$categoryCount	=	$db->getQueryCount('category','catid');

        if($categoryCount[0]['total']==0){
            echo   $categoryId = "CAT1";
           } else {
            require_once('../model/category_class.php'); 
            $dbcon = new category();
                 $hid = $dbcon->getmaxid() +1;
            echo  $categoryId = "CAT" . $hid;
           }
			$data	=	array(
                            'categoryId'=>$categoryId,
							'categoryname'=>trim(strtoupper($_POST['categoryname'])),
							);

			$insert	=	$db->insert('category',$data);

        if($insert){
            header('location:item-modal.php?msg=ras');
            exit;
        }else{
            header('location:item-modal.php?msg=rna');
            exit;
		}
    }
    else {
        header('location:item-modal.php?msg=matchprod');
        exit;
    }
	}

    $condition	=	'';

    $pages->default_ipp	=	15;
    $sql 	= $db->getRecFrmQry("SELECT * FROM category WHERE 1 ".$condition."");
    $pages->items_total	=	count($sql);
    $pages->mid_range	=	9;
    $pages->paginate(); 
   $categoryData	=   $db->getRecFrmQry("SELECT * FROM category WHERE 1 ".$condition." ORDER BY categoryname ASC ".$pages->limit."");
   
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
                                    <h2 class="title-1 pb-3">Item Modal Number/Code</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-plus"></i> <strong>Add</strong> </div>

                            <div class="card-body">

                                <?php  require_once('../common/message.php'); 

?>

                                <form method="post">
                                    <div class="col-sm-12">
                                        <div class="row mt-2 mb-2">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Item Modal Number/Code</label>
                                                    <input type="text" name="categoryname" list="docs" id="categoryname" value="<?php echo  $catname; ?>"
                                                        class="form-control upperCase" placeholder="Enter the Category Name" required>
                                                        <datalist id="docs">
                                        <?php  foreach($categoryData as $val){ ?>
                                        <option>
                                            <?php echo $val['categoryname'];;?>
                                        </option>
                                        <?php  } ?>
                                    </datalist>
                                                </div>
                                                <span class="ft-c-red">Example :  DS-2CE16D0T-ITPF</span>
                                              
                                            </div>

                                            <!-- <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Product Specification</label>
                                                    <input type="text" name="categoryspec" id="categoryspec" value="<?php echo $catspec; ?>"
                                                        class="form-control" placeholder="Enter Category Specification" required>
                                                </div>
                                            </div> -->
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <div class="d-flex justify-content-between">
                                                   
                                            <?php if ($editFlag == false):?>
                                           <button type="submit"  name="save" value="save" id="save"
                                                            class="btn btn-primary"><i
                                                                class="fa fa-fw fa-plus-circle"></i> Add
                                                            Category</button>
                                        <?php else: ?>
                                        <button type="submit"  name="update" value="update" id="update"
                                                            class="btn btn-primary"><i
                                                                class="fa fa-fw fa-plus-circle"></i> Update
                                                            Category</button>
                                        <?php endif ?>
                                                 
                                                     
                                                        <a href="<?php echo $_SERVER['PHP_SELF'];?>"
                                                            class="btn btn-danger"><i class="fa fa-fw fa-sync"></i>
                                                            Clear</a>

                                                        <!-- <button type="submit" name="submit" value="search" id="submit"
                                            class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>
                                            Add Record</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                            </div>
                            <!-- <a href="./account-ledger.php" class="btn btn-dark">Back</a> -->
                            </form>
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
                                        <th width="100">Category #</th>
                                        <th>Category</th>
                                        <!-- <th>Category Specification</th> -->
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($categoryData)>0){
                                            $s	=	'';
                                            foreach($categoryData as $val){
                                                $s++;
                                            
                                        ?>
                                    <tr>

                                        <td><?php echo $val['categoryId'];?></td>
                                      
                                        <td><?php echo $val['categoryname'];?></td>
                                   
                                       


                                        <td align="center">

                                       
                                     
                                            <?php if( $_SESSION['adminlevel']>=1 ) :?>
                                            <!-- <a href="employee-view.php?empid=<?php echo $val['catid'];?>"
                                                class="text-primary ml-2 mr-2"><i
                                                    class="fa fa-fw fa-eye"></i></a><br><br> -->
                                            <a href="item-modal.php?catid=<?php echo $val['catid'];?>"
                                                class="text-primary ml-2 mr-2"><i class="fa fa-fw fa-edit"></i></a>
                                                <!-- <a href="script.php?act=edit&cid=<?php echo $categoryId; ?>">Edit</a> -->
                                            <?php endif ?>
                                            <?php if( $_SESSION['adminlevel']==0 ) :?>
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

                    <!-- END MAIN CONTENT-->
                    <!-- END PAGE CONTAINER-->
                </div>

                s

                <!-- END FOOTER CONTENT-->
                <?php require_once('../common/footer.php');  ?>
                <!-- END FOOTER CONTAINER-->
            </div>

            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <?php require_once('../common/page-bottom.php');  ?>
</body>

</html>
<!-- end document-->