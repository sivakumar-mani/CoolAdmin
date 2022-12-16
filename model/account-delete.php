<?php 

include_once('../config/config.php');

if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){

    $_SESSION['deleteid'] = $_REQUEST['delId'];

	$db->delete('account_ledger',array('ac_trans_id'=>$_REQUEST['delId']));

	header('location: ../view/account-ledger.php?msg=rds');

	exit;

}

?>