<?php 
    include_once('../config/config.php');
    require_once('../common/page-top.php'); 
// session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }


if(isset($_REQUEST['deletedata'])){

$id=  $_POST['delete_id'];
			
echo "id".$id;
			$delete	=$db->delete('complaint_register',array('comp_code'=>$id));

			if($delete){
             

				header('location:complaint-register.php?msg=delsuccess');
                // header('location:complaint_register.php');
				exit;

			}else{
             
				header('location:complaint-register.php?msg=delfail');

				exit;

			}

	

	}


?>
