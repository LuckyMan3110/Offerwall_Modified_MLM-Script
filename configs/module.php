<?php
if(!defined("V1_INSTALLED")){
header("HTTP/1.0 404 Not Found");
exit;
}
                
$m = array();
$m["deposit"] = "1"; // Deposit
$m["withdrawal"] = "1"; // Withdrawal
$m["referral_system"] = "1"; // Referral System
$m["support_ticket"] = "1"; // Support Ticket
$m["rewards"] = "1"; // Support Ticket
$m["live_chat"] = "1"; // Live Chat
$m["google_analytics"] = "1"; // Google Analytics
$m["registration"] = "1"; // User Registration
$m["forget_password"] = "1"; // Forget Password

?>
            