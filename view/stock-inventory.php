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
?>
<?php

$condition	=	'';
if(isset($_REQUEST['categoryname']) and $_REQUEST['categoryname']!=""){
    $condition	.=	' AND categoryname LIKE "%'.$_REQUEST['categoryname'].'%" ';
}
if(isset($_REQUEST['brandsname']) and $_REQUEST['brandsname']!=""){
    $condition	.=	' AND brandsname LIKE "%'.$_REQUEST['brandsname'].'%" ';
}
if(isset($_REQUEST['itemname']) and $_REQUEST['itemname']!=""){
    $condition	.=	' AND itemname LIKE "%'.$_REQUEST['itemname'].'%" ';
}

 //Main queries
 $pages->default_ipp	=	15;
 $sql 	= $db->getRecFrmQry("SELECT categoryname, brandsname,itemname, mrp, sum(quantity) as qty FROM purchased_items_inventory WHERE 1 ".$condition."");
 $pages->items_total	=	count($sql);
 $pages->mid_range	=	9;
 $pages->paginate(); 
// $stockData	=   $db->getRecFrmQry("SELECT * FROM stock_inventory WHERE 1 ".$condition." ORDER BY stockcode ".$pages->limit."");
$stockData	=   $db->getRecFrmQry("SELECT categoryname, brandsname,itemname, mrp, sum(quantity) as qty FROM purchased_items_inventory WHERE 1 ".$condition." GROUP BY categoryname, brandsname,itemname ".$pages->limit."");
// SELECT BookName, Language, COUNT(*) FROM Books GROUP BY BookName, Language;

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
                                    <h2 class="title-1">Stock Inventory</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-search"></i> <strong>Search</strong> </div>

                            <div class="card-body">  <?php require_once('../common/message.php');  ?>
                                <div class="col-sm-12">
                                    <form method="get">

                                        <div class="row">

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Item Modal Code</label>
                                                    <input type="text" name="categoryname" id="categoryname"
                                                        class="form-control"
                                                        value="<?php echo isset($_REQUEST['categoryname'])?$_REQUEST['categoryname']:''?>"
                                                        placeholder="Enter Item modal code">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Brand Name</label>
                                                    <input type="text" class="tel form-control" name="brandsname" id="brandsname"
                                                        value="<?php echo isset($_REQUEST['brandsname'])?$_REQUEST['brandsname']:''?>"
                                                        placeholder="Enter Brand Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Item Name</label>
                                                    <input type="text" class="tel form-control" name="itemname" id="itemname"
                                                        value="<?php echo isset($_REQUEST['itemname'])?$_REQUEST['itemname']:''?>"
                                                        placeholder="Enter Item name">
                                                </div>
                                            </div>
                                     
                                            <div class="col-sm-3">
                                            <label>&nbsp;</label>
                                            <div class="d-flex justify-content-between w-100">

<button type="submit" name="submit" value="search" id="submit"
    class="btn btn-primary"><i class="fa fa-fw fa-search"></i>
    Search</button>

<a href="<?php echo $_SERVER['PHP_SELF'];?>"
    class="btn btn-danger"><i class="fa fa-fw fa-sync"></i>
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
                                        <th>Stock Name</th>
                                        <th>Stock Quantity</th>
                                        <th>MRP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count($stockData)>0){
                                            $s	=	'';
                                            foreach($stockData as $val){
                                                $s++;
                                            
                                        ?>
                                    <tr>

                                        <td class="inner-table">
                                           <table class="border-allnone">
                                            <tr class="bg-none border-allnone">
                                                <td width="200"> <?php echo $val['categoryname'];?></td>
                                                <td width="200"> <?php echo $val['brandsname'];?></td>
                                                <td> <?php echo $val['itemname'];?></td>
                                            </tr>
                                           </table></td>
                                           <?php if( $val['qty'] == 0) {?>
                                      <td class="text-right bg-red"> <?php echo $val['qty'] ;?>
                                      <?php } else {?>
                                        <td class="text-right"> <?php echo $val['qty'] ;?>
                                        <?php } ?>
                                          <td class="text-right"><?php echo $val['mrp'] ;?>
                                        </td>
                                    </tr>
                                    <?php 
            }
        }
        ?>
                                  
                                  
                                    
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