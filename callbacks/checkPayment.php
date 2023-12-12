<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
define('V1_INSTALLED',TRUE);
ob_start();
session_start();
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
$a = protect($_GET['a']);
if($a == "PayPal") { include("PayPal.php"); }
elseif($a == "AdvCash") { include("AdvCash.php"); }
elseif($a == "Payeer") { include("Payeer.php"); }
elseif($a == "PerfectMoney") { include("PerfectMoney.php"); }
elseif($a == "Skrill") { include("Skrill.php"); }
elseif($a == "Paytm") { include("Paytm.php"); }
elseif($a == "Flutterwave") { include("Flutterwave.php"); }
elseif($a == "Stripe") { include("Stripe.php"); }
elseif($a == "Wannads") { include("Wannads.php"); }
elseif($a == "Bitlabs") { include("Bitlabs.php"); }
elseif($a == "CPX") { include("CPX.php"); }
elseif($a == "Monlix") { include("Monlix.php"); }
else {
	echo 'Error! Unknown merchant.';
}
?>