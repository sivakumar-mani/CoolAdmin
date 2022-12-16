<?php 

include_once('../config/config.php');
$accounts = "accounts";
$complaint ="complaint";
$employee = "employee";
$products = "products";
$varUserName = $_SESSION['name'];
$ok ="yes";
$loginPermit=	$db->getAllRecords('login_permission','*',' AND username="'.$varUserName.'"');  

?>