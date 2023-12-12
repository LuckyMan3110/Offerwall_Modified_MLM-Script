<div class="container-fluid py-4">
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

$id = protect($_GET['id']);
$query = $db->query("SELECT * FROM transactions WHERE txid='$id' and sender='$_SESSION[uid]' or txid='$id' and recipient='$_SESSION[uid]'");
if($query->num_rows==0) {
    $redirect = $settings['url']."account/summary";
    header("Location: $redirect");
}
$row = $query->fetch_assoc();
$type = $row['type'];
switch($type) {
    case "1": include("transaction/payment.php"); break;
    case "2": include("transaction/payment.php"); break;
    case "3": include("transaction/deposit.php"); break;
    case "4": include("transaction/withdrawal.php"); break;
    case "28": include("transaction/AdminTransfer.php"); break;
    case "29": include("transaction/AdminTransfer.php"); break;
    case "31": include("transaction/offerwalls.php"); break;
    case "32": include("transaction/offerwalls.php"); break;
    default: include("transaction/payment.php");
}
?>
</div>