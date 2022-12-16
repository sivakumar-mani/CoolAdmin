<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
?>

<body class="animsition">
<form name="myForm" id="needs-validation" action="../model/register_complaint_class.php"
                                    method="post" required>
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
                                    <h2 class="title-1 pb-3">Register the New Complaint</h2>
                                </div>
                            </div>
                        </div>



                        <div class="card">

                            <!-- <div class="card-header"><i class="fa fa-fw fa-plus"></i> <strong>Add</strong> </div> -->

                            <div class="card-body">

                            <?php require_once('../common/message.php');  ?>

                        
                                    <div class="col-sm-12">
                                        <div class="row justify-content-between text-left ">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_subject">Subject <sup>*</sup></label>
                                                    <select class="form-control demoInputBox" id="comp_subject"
                                                        name="comp_subject" onfocusout="myFunction()" required>
                                                        <option>Select Subject</option>
                                                        <option value="complaint">Complaint</option>
                                                        <option value="enquiry">Enquiry</option>\
                                                        <option value="Feedback">Feedback</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please selected any File.
                                                    </div>
                                                </div>
                                                <p id="demo"></p>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_name">Reporter Name <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox" id="comp_name"
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
                                                        required>
                                                    <span id="comp_email-info" class="info"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_number">Contact Number <sup>*</sup></label>
                                                    <input type="number" class="form-control demoInputBox"
                                                        id="comp_number" name="comp_number"
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
                                                        placeholder="Please enter Bank Name" required>
                                                    <span id="comp_bankname-info" class="info"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="comp_branch">Branch <sup>*</sup></label>
                                                    <input type="text" class="form-control demoInputBox"
                                                        id="comp_branch" name="comp_branch" maxlength="10"
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
                                                        name="comp_baddress" rows="3" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between text-left ">
                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label for="comp_comments">Message <sup>*</sup></label><span
                                                        id="comp_msg-info" class="info"></span>
                                                    <textarea class="form-control demoInputBox" id="comp_msg"
                                                        name="comp_msg" rows="3" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    
                             
                                <div class="row ">
                                            <div class="col-sm-12 d-flex w-100 justify-content-between">
                                                <button type="reset" class="btn btn-danger">RESET</button>
                                                <a href="./complaint-register.php" class="btn btn-dark">Back</a>
                                                <button type="submit" class="btn btn-primary">SEND</button>
                                            </div>
                                        </div>
                            </div>


                            <div class="clearfix"></div>



                            <!-- END FOOTER CONTENT-->
                          
                            <!-- END FOOTER CONTAINER-->
                        </div>
                        <?php require_once('../common/footer.php');  ?>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    </form>
    <?php require_once('../common/page-bottom.php');  ?>
</body>

</html>
<!-- end document-->