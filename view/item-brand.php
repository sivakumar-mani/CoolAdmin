<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }

    $editFlag = false;
    $bndname ="";
    $bid =0;



    if(isset($_GET['bid'])){
        $editFlag = true;
        $getdata	=	$db->getAllRecords('brands','*',' AND bid="'.$_REQUEST['bid'].'"');
        $bndname = $getdata[0]['brandsname'];
        $brandsid = $getdata[0]['brandsid'];
        $bid = $getdata[0]['bid'];
    }



    if(isset($_POST['update'])){
        $brandsname = trim($_POST['brandsname']);
        $matchdata	=	$db->getQueryCount('brands','*',' AND brandsname="'.$brandsname.'"');
        if($matchdata[0]['total']==0){
        $bid =$_GET['bid'];
        $data	=	array(          
            'brandsname'=>$_POST['brandsname'],
            );
        $update	=	$db->update('brands',$data,array('bid'=>$bid));

        if($update){
                header('location:item-brand.php?msg=ras');
                exit;
            }else{
                header('location:item-brand.php?msg=rna');
                exit;
            }
        }
        else {
            header('location:item-brand.php?msg=matchbrand');
            exit;
        }
    }

    if(isset($_POST['save'])){

        $brandsname = trim($_POST['brandsname']);
        $matchdata	=	$db->getQueryCount('brands','*',' AND brandsname="'.$brandsname.'"');
        if($matchdata[0]['total']==0){
		$brandsCount	=	$db->getQueryCount('brands','bid');

        if($brandsCount[0]['total']==0){
            echo   $brandsid = "BND1";
           } else {
            require_once('../model/brand_class.php'); 
            $dbcon = new brand();
                 $hid = $dbcon->getmaxid() +1;
            echo  $brandsid = "BND" . $hid;
           }
			$data	=	array(
                            'brandsid'=>$brandsid,
							'brandsname'=>trim(strtoupper($_POST['brandsname'])),
							);

			$insert	=	$db->insert('brands',$data);

        if($insert){
            header('location:item-brand.php?msg=ras');
            exit;
        }else{
            header('location:item-brand.php?msg=rna');
            exit;
		}
    }
    else {
        header('location:item-brand.php?msg=matchbrand');
        exit;
    }
	}

    $condition	=	'';

    $pages->default_ipp	=	15;
    $sql 	= $db->getRecFrmQry("SELECT * FROM brands WHERE 1 ".$condition."");
    $pages->items_total	=	count($sql);
    $pages->mid_range	=	9;
    $pages->paginate(); 
   $brandsData	=   $db->getRecFrmQry("SELECT * FROM brands WHERE 1 ".$condition." ORDER BY brandsname ASC ".$pages->limit."");
   
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
                                    <h2 class="title-1 pb-3">Item Brand</h2>
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
                                                    <label>Product Brand</label>
                                                    <input type="text" name="brandsname" list="docs" id="brandsname" value="<?php echo  $bndname; ?>"
                                                        class="form-control upperCase" placeholder="Enter the brands Name" required>
                                                        <datalist id="docs">
                                                            <?php  foreach($brandsData as $val){ ?>
                                                            <option>
                                                                <?php echo $val['brandsname'];;?>
                                                            </option>
                                                            <?php  } ?>
                                                        </datalist>
                                                </div>
                                                <span class="ft-c-red">Example :  HIKVISION, CP PLUS</span>
                                            </div>

                                            <!-- <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Product Specification</label>
                                                    <input type="text" name="categoryspec" id="categoryspec" value="<?php echo $catspec; ?>"
                                                        class="form-control" placeholder="Enter Category Specification" required>
                                                </div>
                                            </div> -->
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <div class="d-flex justify-content-between">
                                                   
                                            <?php if ($editFlag == false):?>
                                           <button type="submit"  name="save" value="save" id="save"
                                                            class="btn btn-primary"><i
                                                                class="fa fa-fw fa-plus-circle"></i> Add
                                                            Brand</button>
                                        <?php else: ?>
                                        <button type="submit"  name="update" value="update" id="update"
                                                            class="btn btn-primary"><i
                                                                class="fa fa-fw fa-plus-circle"></i> Update
                                                                Brand</button>
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
                                        <th width="100">Brand #</th>
                                        <th>Brand Name</th>
                                        <!-- <th>Category Specification</th> -->
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($brandsData)>0){
                                            $s	=	'';
                                            foreach($brandsData as $val){
                                                $s++;
                                            
                                        ?>
                                    <tr>

                                        <td><?php echo $val['brandsid'];?></td>
                                      
                                        <td><?php echo $val['brandsname'];?></td>
                                   
                                       


                                        <td align="center">

                                       
                                     
                                            <?php if( $_SESSION['adminlevel']>=1 ) :?>
                                            <!-- <a href="employee-view.php?empid=<?php echo $val['catid'];?>"
                                                class="text-primary ml-2 mr-2"><i
                                                    class="fa fa-fw fa-eye"></i></a><br><br> -->
                                            <a href="item-brand.php?bid=<?php echo $val['bid'];?>"
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