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
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
if(checkAdminSession()) {
	include("sources/header.php");
	$a = protect($_GET['a']);
	switch($a) {
		case "users": include("sources/users.php"); break;
		case "all_user_activity": include("sources/all_user_activity.php"); break;
		case "manual_transactions": include("sources/manual_transactions.php"); break;
		case "manual_deposit": include("sources/manual_deposit.php"); break;
		case "deposit_methods": include("sources/deposit_methods.php"); break;
		case "deposits": include("sources/deposits.php"); break;
		case "withdrawal_methods": include("sources/withdrawal_methods.php"); break;
		case "withdrawals": include("sources/withdrawals.php"); break;
		case "languages": include("sources/languages.php"); break;
		case "smtp_settings": include("sources/smtp_settings.php"); break;
		case "support": include("sources/support.php"); break;
		case "logs": include("sources/logs.php"); break;
		case "ref": include("sources/ref.php"); break;
		case "settings": include("sources/settings.php"); break;
		case "admin_profits": include("sources/admin_profits.php"); break;
		case "admin_profits_logs": include("sources/admin_profits_logs.php"); break;
		case "live_chat": include("sources/live_chat.php"); break;
		case "google_analytics": include("sources/google_analytics.php"); break;
		case "send_mail": include("sources/send_mail.php"); break;
		case "country": include("sources/country.php"); break;
		case "update_logo": include("sources/update_logo.php"); break;
		case "module": include("sources/module.php"); break;
		case "referral_config": include("sources/referral_config.php"); break;
		case "membership_log": include("sources/membership_log.php"); break;
		case "reward": include("sources/reward.php"); break;
		case "reward_log": include("sources/reward_log.php"); break;
		case "offerwalls": include("sources/offerwalls.php"); break;
		case "offerwalls_setting": include("sources/offerwalls_setting.php"); break;
		case "logout": 
			unset($_SESSION['admin_uid']);
			unset($_COOKIE['admin_uid']);
			setcookie("admin_uid", "", time() - (86400 * 30), '/'); // 86400 = 1 day
			session_unset();
			session_destroy();
			header("Location: $settings[url]admin");
		break;
		default: include("sources/dashboard.php");
	}
	include("sources/footer.php");
} else {
	include("sources/login.php");
}
mysqli_close($db);
?>