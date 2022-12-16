<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }

    $editFlag = false;
    $itemname ="";
    $iid =0;



    if(isset($_GET['iid'])){
        $editFlag = true;
        $getdata	=	$db->getAllRecords('item','*',' AND iid="'.$_REQUEST['iid'].'"');
        $itemname = $getdata[0]['itemname'];
        $iid = $getdata[0]['iid'];
        $itemid = $getdata[0]['itemid'];
    }



    if(isset($_POST['update'])){
        $itemname = trim($_POST['itemname']);
        $matchdata	=	$db->getQueryCount('item','*',' AND itemname="'.$itemname.'"');
        if($matchdata[0]['total']==0){
        $iid =$_GET['iid'];
        $data	=	array(          
            'itemname'=>trim(strtoupper($_POST['itemname'])),
            );
        $update	=	$db->update('item',$data,array('iid'=>$iid));

        if($update){
                header('location:item-name.php?msg=ras');
                exit;
            }else{
                header('location:item-name.php?msg=rna');
                exit;
            }
        }
        else {
            header('location:item-name.php?msg=matchprod');
            exit;
        }
    }

    if(isset($_POST['save'])){

        $itemname = trim($_POST['itemname']);
        $matchdata	=	$db->getQueryCount('item','*',' AND itemname="'.$itemname.'"');
        if($matchdata[0]['total']==0){
		$itemCount	=	$db->getQueryCount('item','iid');

        if($itemCount[0]['total']==0){
            echo   $itemid = "ITEM1";
           } else {
            require_once('../model/item_class.php'); 
            $dbcon = new item();
                 $hid = $dbcon->getmaxid() +1;
            echo  $itemid = "ITEM" . $hid;
           }
			$data	=	array(
                            'itemid'=>$itemid,
							'itemname'=>trim(strtoupper($_POST['itemname'])),
							);

			$insert	=	$db->insert('item',$data);

        if($insert){
            header('location:item-name.php?msg=ras');
            exit;
        }else{
            header('location:item-name.php?msg=rna');
            exit;
		}
    }
    else {
        header('location:item-name.php?msg=matchprod');
        exit;
    }
	}

    $condition	=	'';

    $pages->default_ipp	=	15;
    $sql 	= $db->getRecFrmQry("SELECT * FROM item WHERE 1 ".$condition."");
    $pages->items_total	=	count($sql);
    $pages->mid_range	=	9;
    $pages->paginate(); 
   $itemData	=   $db->getRecFrmQry("SELECT * FROM item WHERE 1 ".$condition." ORDER BY itemname ASC ".$pages->limit."");
   
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
                                    <h2 class="title-1 pb-3">Item Modal Number / Code</h2>
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
                                                    <label>Item Name</label>
                                                    <input type="text" name="itemname" list="docs" id="itemname" value="<?php echo  $itemname; ?>"
                                                        class="form-control upperCase" placeholder="Enter the item Name" required>
                                                        <datalist id="docs">
                                        <?php  foreach($categoryData as $val){ ?>
                                        <option>
                                            <?php echo $val['itemname'];;?>
                                        </option>
                                        <?php  } ?>
                                    </datalist>
                                                </div>
                                                <span class="ft-c-red">Example :  CAMERA 2MP HD, WESTERN HARDDISK 1TB</span>
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
                                                            Item Modal</button>
                                        <?php else: ?>
                                        <button type="submit"  name="update" value="update" id="update"
                                                            class="btn btn-primary"><i
                                                                class="fa fa-fw fa-plus-circle"></i> Update
                                                            Item Modal</button>
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
                                        <th width="100">Item #</th>
                                        <th>Item Modal Number / Code</th>
                                        <!-- <th>Category Specification</th> -->
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($itemData)>0){
                                            $s	=	'';
                                            foreach($itemData as $val){
                                                $s++;
                                            
                                        ?>
                                    <tr>

                                        <td><?php echo $val['itemid'];?></td>
                                      
                                        <td><?php echo $val['itemname'];?></td>
                                   
                                       


                                        <td align="center">

                                       
                                     
                                            <?php if( $_SESSION['adminlevel']>=1 ) :?>
                                            <!-- <a href="employee-view.php?empid=<?php echo $val['iid'];?>"
                                                class="text-primary ml-2 mr-2"><i
                                                    class="fa fa-fw fa-eye"></i></a><br><br> -->
                                            <a href="item-name.php?iid=<?php echo $val['iid'];?>"
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

               
            </div>

            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <?php require_once('../common/page-bottom.php');  ?>
</body>

</html>
<!-- end document-->