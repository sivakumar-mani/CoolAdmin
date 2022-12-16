<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
    if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){

        $row	=	$db->getAllRecords('account_ledger','*',' AND ac_trans_id="'.$_REQUEST['editId'].'"');
    
    }

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){

	extract($_REQUEST);

	if($transdate==""){

		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');

		exit;

	}elseif($transmode==""){

		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');

		exit;

	}
    elseif($transname==""){

		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');

		exit;

	}    elseif($transno==""){

		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');

		exit;

	}
    elseif($transtype==""){

		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');

		exit;

	}
    elseif($transamount==""){

		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');

		exit;

	}
    elseif($transdetails==""){

		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');

		exit;

	}
    
    
    
    else{

		

		$userCount	=	$db->getQueryCount('account_ledger','ac_trans_id');


			$data	=	array(

							'ac_trans_date'=>$transdate,
                            'ac_trans_mode'=>$transmode,
							'ac_trans_type'=>$transtype,							
                            'trans_name'=>$transname,
                            'ac_trans_details'=>$transdetails,
                            'ac_trans_no'=>$transno,
                            'ac_amount'=>$transamount,
                            'ac_balance'=>0,
							);

                            $update	=	$db->update('account_ledger',$data,array('ac_trans_id'=>$editId));

			if($update){

				header('location:account-ledger.php?msg=ras');

				exit;

			}else{

				header('location:account-ledger.php?msg=rna');

				exit;

			}

	

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
                                    <h2 class="title-1 pb-3">Edit Transactions</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <div class="card-header"><i class="fa fa-fw fa-edit"></i> <strong>Edit</strong><span class="ft-s-16 ft-w-600 ft-c-red"> - Transaction Id :<?php echo isset($row[0]['ac_trans_id'])?$row[0]['ac_trans_id']:''; ?> </span> </div>

                            <div class="card-body">

                            <?php require_once('../common/message.php');  ?>

<form method="post">


                                <div class="col-sm-12">
                                  

                                        <div class="row mt-2 mb-2">

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Transanction Date</label>
                                                    <input type="date" name="transdate" id="transdate" value="<?php echo isset($row[0]['ac_trans_date'])?$row[0]['ac_trans_date']:''; ?>" 
                                                        class="form-control"  required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Transaction Mode</label>
                                                    <select class="form-control" id="transmode" name="transmode"
                                                        required>
                                                        <option value="<?php echo isset($row[0]['ac_trans_mode'])?$row[0]['ac_trans_mode']:''; ?>" ><?php echo isset($row[0]['ac_trans_mode'])?$row[0]['ac_trans_mode']:''; ?></option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="Cheque">Cheque</option>
                                                        <option value="Merchant App">Merchant App</option>
                                                        <option value="Net Banking">Net Banking</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Bank Name / App Name</label>
                                                    <input type="text" name="transname" id="transname" value="<?php echo isset($row[0]['trans_name'])?$row[0]['trans_name']:''; ?>"
                                                        class="form-control" placeholder="Enter Bank Name / App Name" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2 mb-2">

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Transanction / Cheque / Cash Voucher No</label>
                                                    <input type="text" name="transno" id="transno" class="form-control" value="<?php echo isset($row[0]['ac_trans_no'])?$row[0]['ac_trans_no']:''; ?>"
                                                        placeholder="Enter Transanction number" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Transaction Type</label>
                                                    <select class="form-control" id="transtype" name="transtype"
                                                        required>
                                                        <option value="<?php echo isset($row[0]['ac_trans_type'])?$row[0]['ac_trans_type']:''; ?>" ><?php echo isset($row[0]['ac_trans_type'])?$row[0]['ac_trans_type']:''; ?></option>
                                                        <option value="Credit">Credit</option>
                                                        <option value="Debit">Debit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Transanction Amount</label>
                                                    <input type="text" name="transamount" id="transamount" value="<?php echo isset($row[0]['ac_amount'])?$row[0]['ac_amount']:''; ?>"
                                                        class="form-control" placeholder="Enter Transanction Amount" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2 mb-2">
                                            <div class="col-sm-12">
                                            <label>Transanction Details</label>
                                                <textarea class="form-control demoInputBox" id="transdetails" 
                                                    name="transdetails" rows="3" required><?php echo isset($row[0]['ac_trans_details'])?$row[0]['ac_trans_details']:''; ?></textarea> 
                                            </div>
                                        </div>
                                   

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-footer d-flex justify-content-between">
                                        <a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i
                                                class="fa fa-fw fa-sync"></i>
                                            Clear</a>
                                            <a href="./account-ledger.php" class="btn btn-dark">Back</a>
                                            <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Update Record</button>
                                    </div>
                                </div>
                            </div>
                            </form>
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