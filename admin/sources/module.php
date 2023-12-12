<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
?>
<div class="card">
    <div class="card-header">
        <strong class="card-title">Modules <b>Control</b></strong>
    </div>
    <div class="card-body">
        
        <?php
		if(isset($_POST['btn_save'])) {
		    
			if(isset($_POST['deposit'])) { $deposit = 1; } else { $deposit = 0; }
			if(isset($_POST['withdrawal'])) { $withdrawal = 1; } else { $withdrawal = 0; }
			if(isset($_POST['referral_system'])) { $referral_system = 1; } else { $referral_system = 0; }
			if(isset($_POST['support_ticket'])) { $support_ticket = 1; } else { $support_ticket = 0; }
			if(isset($_POST['rewards'])) { $rewards = 1; } else { $rewards = 0; }
			
			if(isset($_POST['live_chat'])) { $live_chat = 1; } else { $live_chat = 0; }
			if(isset($_POST['google_analytics'])) { $google_analytics = 1; } else { $google_analytics = 0; }
			if(isset($_POST['registration'])) { $registration = 1; } else { $registration = 0; }
			if(isset($_POST['forget_password'])) { $forget_password = 1; } else { $forget_password = 0; }

		
			$contents = '<?php
if(!defined("V1_INSTALLED")){
header("HTTP/1.0 404 Not Found");
exit;
}
                
$m = array();
$m["deposit"] = "'.$deposit.'"; // Deposit
$m["withdrawal"] = "'.$withdrawal.'"; // Withdrawal
$m["referral_system"] = "'.$referral_system.'"; // Referral System
$m["support_ticket"] = "'.$support_ticket.'"; // Support Ticket
$m["rewards"] = "'.$rewards.'"; // Support Ticket
$m["live_chat"] = "'.$live_chat.'"; // Live Chat
$m["google_analytics"] = "'.$google_analytics.'"; // Google Analytics
$m["registration"] = "'.$registration.'"; // User Registration
$m["forget_password"] = "'.$forget_password.'"; // Forget Password

?>
            ';				
			$update = file_put_contents("../configs/module.php",$contents);
			if($update) {
				$m["deposit"] = $deposit; // Deposit
				$m["withdrawal"] = $withdrawal; // Withdrawal
                $m["referral_system"] = $referral_system; // Referral System
                $m["support_ticket"] = $support_ticket; // Support Ticket
                $m["rewards"] = $rewards; // Support Ticket
                $m["live_chat"] = $live_chat; // Live Chat
                $m["google_analytics"] = $google_analytics; // Google Analytics
                $m["registration"] = $registration; // User Registration
                $m["forget_password"] = $forget_password; // Forget Password
				echo success("Your changes was saved successfully.");
			} else {
				echo error("Please set chmod 777 of file <b>config/module.php</b>.");
			}
			
		}
		?>
        
        <form action="" method="POST">
            <div class="row">
                <div class="col">
                    <div class="checkbox">
                		<label>
                		  <input type="checkbox" name="deposit" value="yes" <?php if($m['deposit'] == "1") { echo 'checked'; }?>> Deposits
                		</label>
                	</div>
                	<div class="checkbox">
                		<label>
                		  <input type="checkbox" name="withdrawal" value="yes" <?php if($m['withdrawal'] == "1") { echo 'checked'; }?>> Withdrawals
                		</label>
                	</div>
					<div class="checkbox">
                		<label>
                		  <input type="checkbox" name="registration" value="yes" <?php if($m['registration'] == "1") { echo 'checked'; }?>> Users Registration
                		</label>
                	</div>
					<div class="checkbox">
                		<label>
                		  <input type="checkbox" name="forget_password" value="yes" <?php if($m['forget_password'] == "1") { echo 'checked'; }?>> Forget Password
                		</label>
                	</div>
                </div>
                <div class="col">
                    <div class="checkbox">
                		<label>
                		  <input type="checkbox" name="referral_system" value="yes" <?php if($m['referral_system'] == "1") { echo 'checked'; }?>> Referral System
                		</label>
                	</div>
                	<div class="checkbox">
                		<label>
                		  <input type="checkbox" name="support_ticket" value="yes" <?php if($m['support_ticket'] == "1") { echo 'checked'; }?>> Support Tickets
                		</label>
                	</div>
                	<div class="checkbox">
                		<label>
                		  <input type="checkbox" name="rewards" value="yes" <?php if($m['rewards'] == "1") { echo 'checked'; }?>> Rewards
                		</label>
                	</div>
                </div>
                <div class="col">
                    <div class="checkbox">
                		<label>
                		  <input type="checkbox" name="live_chat" value="yes" <?php if($m['live_chat'] == "1") { echo 'checked'; }?>> Live Chat
                		</label>
                	</div>
                	<div class="checkbox">
                		<label>
                		  <input type="checkbox" name="google_analytics" value="yes" <?php if($m['google_analytics'] == "1") { echo 'checked'; }?>> Google Analytics
                		</label>
                	</div>
                </div>
            </div>
    </div>
        <button type="submit" class="btn btn-primary btn-block" style="border-radius:0px;" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
        </form>
</div>