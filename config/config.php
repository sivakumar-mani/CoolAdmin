<?php
include_once('../model/Database.php');
include_once('../model/paginator.class.php');


define('DB_NAME', 'snehadb');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

// define('DB_NAME', 'snehalive');
// define('DB_USER', 'snehaadmin');
// define('DB_PASSWORD', 'MySonsBD@1310');
// define('DB_HOST', '198.71.225.63:3306');
// define('DB_HOST', 'a2nlmysql27plsk.secureserver.net:3306');



$dsn	= 	"mysql:dbname=".DB_NAME.";host=".DB_HOST."";
$pdo	=	"";
try {
	$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
}catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
$db 	=	new Database($pdo);
$pages	=	new Paginator();
?>