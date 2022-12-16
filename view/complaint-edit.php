<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
    if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){

        $row	=	$db->getAllRecords('complaint_register','*',' AND comp_code="'.$_REQUEST['editId'].'"');
    
    }

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){

	extract($_REQUEST);
		$userCount	=	$db->getQueryCount('complaint_register','comp_id');

			$data	=	array(

							'comp_name'=>$comp_name,
                            'comp_subject'=>$comp_subject,
							'comp_email'=>$comp_email,							
                            'comp_bankname'=>$comp_bankname,
                            'comp_branch'=>$comp_branch,
                            'comp_baddress'=>$comp_baddress,
                            'comp_number'=>$comp_number,
                            'comp_msg'=>trim($comp_msg),
							);

                            $update	=	$db->update('complaint_register',$data,array('comp_code'=>$_REQUEST['editId']));

			if($update){

				header('location:complaint-register.php?msg=ras');

				exit;

			}else{

				header('location:complaint-register.php?msg=rna');

				exit;

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
                                    <h2 class="title-1 pb-3">Edit Register Complaint <?php echo $_REQUEST['editId']; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="card">

                         

                            <div class="card-body">

                            <?php require_once('../common/message.php');  ?>

<form method="post">


                                <div class="col-sm-12">
                                  

                                        <div class="row mt-2 mb-2">
                                        <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_subject">Subject <sup>*</sup></label>
                                                    <select class="form-control demoInputBox" id="comp_subject"
                                                        name="comp_subject" onfocusout="myFunction()" required>
                                                        <option value="<?php echo isset($row[0]['comp_subject'])?$row[0]['comp_subject']:''; ?>" ><?php echo isset($row[0]['comp_subject'])?$row[0]['comp_subject']:''; ?></option>
                                                        <option value="complaint">Complaint</option>
                                                        <option value="enquiry">Enquiry</option>
                                                        <option value="Feedback">Feedback</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_name">Reporter Name <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox" id="comp_name"
                                                    value="<?php echo isset($row[0]['comp_name'])?$row[0]['comp_name']:''; ?>"
                                                        name="comp_name" placeholder="Please Enter your name" required>
                                                    <span id="comp_name-info" class="info"></span>
                                                </div>
                                            </div>
                                           
                                        </div>

                                        <div class="row justify-content-between text-left ">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_email">Email address <sup>*</sup></label>
                                                    <input type="email" class="form-control demoInputBox"
                                                        id="comp_email" name="comp_email" placeholder="name@example.com"
                                                        value="<?php echo isset($row[0]['comp_email'])?$row[0]['comp_email']:''; ?>"
                                                        required>
                                                    <span id="comp_email-info" class="info"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_number">Contact Number <sup>*</sup></label>
                                                    <input type="number" class="form-control demoInputBox"
                                                        id="comp_number" name="comp_number"
                                                        value="<?php echo isset($row[0]['comp_number'])?$row[0]['comp_number']:''; ?>"
                                                        placeholder="Please enter primary Number" required>
                                                    <span id="comp_number-info" class="info"></span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row justify-content-between text-left ">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_bankname">Bank Name <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox"
                                                        id="comp_bankname" name="comp_bankname"
                                                        value="<?php echo isset($row[0]['comp_bankname'])?$row[0]['comp_bankname']:''; ?>"
                                                        placeholder="Please enter Bank Name" required>
                                                    <span id="comp_bankname-info" class="info"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_branch">Branch <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox"
                                                        id="comp_branch" name="comp_branch" maxlength="10"
                                                        value="<?php echo isset($row[0]['comp_branch'])?$row[0]['comp_branch']:''; ?>"
                                                        placeholder="Please enter branch location" required>
                                                    <span id="comp_branch-info" class="info"></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row justify-content-between text-left ">

<div class="col-sm-12">
    <div class="form-group">
        <label for="comp_baddress">Branch Address <sup>*</sup></label> <span
            id="comp_baddress-info" class="info"></span>
        <textarea class="form-control demoInputBox" id="comp_baddress"
            name="comp_baddress" rows="3" required><?php echo isset($row[0]['comp_baddress'])?$row[0]['comp_baddress']:''; ?></textarea>
    </div>
</div>
</div>
<div class="row justify-content-between text-left ">
                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label for="comp_comments">Message <sup>*</sup></label><span
                                                        id="comp_msg-info" class="info"></span>
                                                    <textarea class="form-control demoInputBox" id="comp_msg"
                                                        name="comp_msg" rows="3" required><?php echo isset($row[0]['comp_msg'])?$row[0]['comp_msg']:''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                   

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-footer d-flex justify-content-between">
                                        <!-- <a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i
                                                class="fa fa-fw fa-sync"></i>
                                            Clear</a> -->
                                            <a href="./complaint-register.php" class="btn btn-dark">Back</a>
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