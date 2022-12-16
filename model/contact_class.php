<?php 
include('../config/dbconfig.php');
$dbcon = new dbconfig();


    $compcode = $_REQUEST['compid'];
    if(isset($compcode) and $compcode!=""){
        $row	=	$db->getAllRecords('complaint_register','*',' AND comp_code="'.$compcode.'"');  
        $workorderData	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');    
       
    }else {
        $row	=	$db->getAllRecords('complaint_register','*',' AND comp_code="'.$compcode.'"');  
        $workorderData	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');    
    }

    $employeeData = $db->getAllRecords('employee','*');


    if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
    $cwoCount	=	$db->getQueryCount('complaint_work_order','cwo_id');
    // echo "count" . $empCount[0]['total'];
 if($cwoCount[0]['total']==0){
     echo   $cwo_code = "CWO1";
    } else {
        $cwocompCount	=	$db->getQueryCount('complaint_work_order','*',' AND comp_code="'.$compcode.'"');
        if($cwocompCount[0]['total']==0){          
            require_once('../model/complaint_work_order_class.php'); 
            $dbcon = new complaintWorkOrder();
                $hid = $dbcon->getmaxid() +1;
            echo  $cwo_code = "CWO" . $hid;
        }else {
            $crow	=	$db->getAllRecords('complaint_work_order','*',' AND comp_code="'.$compcode.'"');  
            echo $cwo_code =$crow[0]['cwo_code'];
        }
    }
    $stringText  = $emp_code;
    $emp = explode(" ", $stringText);
    echo $emp[0]; //red 
    echo $techname = $emp[1]." ". $emp[2]; //yellow
 
    $ctdate=date('d-m-Y H:i:s');

			$data	=	array(
							'cwo_code'=>$cwo_code,
                            'emp_code'=> $emp[0],
                            'tech_name'=> $techname,
							'comp_code'=>$compcode,							
                            'cwo_date'=>$cwo_date,
                            'cwo_timedate'=> $ctdate,
                            'cwo_amount'=>$cwo_amount,
                            'cwo_status'=>$cwo_status,
                            'cwo_material_given'=>$cwo_material_given,
                            'cwo_remedies'=>$cwo_remedies
							);

                            $insert	=	$db->insert('complaint_work_order',$data);

			if($insert){

                // header('location:'.$_SERVER['PHP_SELF'].'?comp_id='.$_REQUEST['compid'].'');
                $cdata	=	array(

                    'comp_status'=>$cwo_status,
                    );

                    $update	=	$db->update('complaint_register',$cdata,array('comp_code'=>$compcode));

                        if($update){

                            header('location:complaint-edit.php?compid='.$compcode);
                            exit;

                        }
           

			}else{

                header('location:'.$_SERVER['PHP_SELF'].'?compid='.$compcode.'"');

				exit;

			}

	

	}


?>

?>