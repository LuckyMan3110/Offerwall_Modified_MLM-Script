<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

if(!checkSession()) {
    $redirect = $settings['url']."login";
    header("Location: $redirect");
}

$redirect_summary = $settings['url']."account/summary";

$c = protect($_GET['c']);
switch($c) {
    case "deposit": include("money/deposit.php"); break;
    case "withdrawal": include("money/withdrawal.php"); break;
	case "membership": include("money/membership.php"); break;
	case "chart": include("money/chart.php"); break;
	case "reward": include("money/reward.php"); break;
	case "offerwalls": include("money/offerwalls.php"); break;
    default: header("Location: $redirect_summary");
}
?>