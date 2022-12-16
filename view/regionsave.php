<?php
session_start();
   include_once('../config/config.php');
   require_once('../common/page-top.php'); 
   require_once('../model/permission_declare.php'); 
    if(isset($_POST['Save'])){

        $ifsccode = $_SESSION['$ifsc'];
        $matchdata	=	$db->getQueryCount('regional_office','*',' AND ifsc="'.$ifsc.'"');
        if($matchdata[0]['total']==0){
            $ifscCount	=	$db->getQueryCount('regional_office','ifsc');

            if($ifscCount[0]['total']==0){
            echo   $rocode = "RO1";
            echo $_POST['bankcode'];
           } else {
            require_once('../model/regional_class.php'); 
            $dbcon = new regional();
                 $hid = $dbcon->getmaxid() +1;
            echo  $rocode = "RO" . $hid;
           }

			$data	=	array(
                            'rocode'=>$rocode,
							'bankcode'=>trim($_POST['bankcode']),
                            'ifsc'=>trim($_POST['ifsccode']),
                            'bank'=>trim($_POST['bankname']),
                            'branch'=>trim($_POST['branch']),
                            'region'=>trim($_POST['region']),
                            'address'=>trim($_POST['bankaddress']),
                            'city'=>trim($_POST['bankcity']),
                            'district'=>trim($_POST['district']),
                            'MICR'=>$_SESSION['micr'],
                            'contactNo1'=>trim($_POST['bankcontact1']),
                            'contactNo2'=>trim($_POST['bankcontact2']),
                            'mobilenumber'=>trim($_POST['mobilenumber']),
                            'alternatenumber'=>trim($_POST['alternatenumber']),                            
                            'contactPerson'=>trim($_POST['contactPerson']),
                            'bankemailid'=>trim($_POST['bankemailid']),
                            'region_incharge'=>trim($_POST['region_incharge']), 
                            'status'=> "Active",        
							);

			$insert	=	$db->insert('regional_office',$data);

        if($insert){
            header('location:add-regional-office.php?msg=rosuccess');
            exit;
            $_SESSION['search_result'] = "False";
        }else{
            header('location:add-regional-office.php?msg=rofail');
            exit;
            $_SESSION['search_result'] = "False";
		}
    }
    else {
        header('location:add-regional-office.php?msg=romatch');
        exit;
        $_SESSION['search_result'] = "False";
    }
	}

?>