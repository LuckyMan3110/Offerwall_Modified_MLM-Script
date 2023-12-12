<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(file_exists("./install.php")) {
	header("Location: ./install.php");
} 
define('V1_INSTALLED',TRUE);
ob_start();
session_start();
include("configs/bootstrap.php");
include("includes/bootstrap.php");
include(getLanguage($settings['url'],null,null));

if(isset($_GET['ref'])){
$ref = $_GET['ref'];
$check = $db->query("SELECT * FROM users WHERE id=$ref");
$chk_ref = $check->fetch_assoc();
if($chk_ref['email_verified'] > 0){
setcookie("ref", $chk_ref['id']);
}else{
setcookie("ref", "0");
}
}
$a = protect($_GET['a']);
switch($a) {
	case "account": include("sources/account.php"); break;
	case "login": include("sources/login.php"); break;
	case "register": include("sources/register.php"); break;
	case "password": include("sources/password.php"); break;
	case "email_verify": include("sources/email_verify.php"); break;
	case "deposit": include("sources/deposit.php"); break;
	case "logout": 
		unset($_SESSION['uid']);
		unset($_COOKIE['uid']);
		setcookie("uid", "", time() - (86400 * 30), '/'); // 86400 = 1 day
		session_unset();
		session_destroy();
		header("Location: $settings[url]");
	break;
	default: include("sources/home.php");
}
mysqli_close($db);
?>