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
$c = protect($_GET['c']);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-3">
            <div class="user-wallet-wrap">
                <div class="modal-content bg-secondary">
                    <div class="modal-body">
                        <div class="user-connected-form-block">
                        <div class="list-group settings_menu">
                            <a href="<?= $settings['url']; ?>account/settings/profile" class="list-group-item list-group-item-action <?php if($c == "" or $c == "profile") { echo 'active'; } ?>"><?php echo filter_var($lang['settings_profile'], FILTER_SANITIZE_STRING); ?></a>
                            <a href="<?= $settings['url']; ?>account/settings/change_password" class="list-group-item list-group-item-action <?php if($c == "change_password") { echo 'active'; } ?>"><?php echo filter_var($lang['settings_change_password'], FILTER_SANITIZE_STRING); ?></a>
                            <a href="<?= $settings['url']; ?>account/settings/wallet_passphrase" class="list-group-item list-group-item-action <?php if($c == "wallet_passphrase") { echo 'active'; } ?>"><?php echo filter_var($lang['settings_wallet_passphrase'], FILTER_SANITIZE_STRING); ?></a>
                            <a href="<?= $settings['url']; ?>account/settings/2fa" class="list-group-item list-group-item-action <?php if($c == "2fa") { echo 'active'; } ?>"><?php echo filter_var($lang['settings_2fa'], FILTER_SANITIZE_STRING); ?></a>
                            <?php if($settings['require_document_verify'] == "1") { ?><a href="<?= $settings['url']; ?>account/settings/verification" class="list-group-item list-group-item-action <?php if($c == "verification") { echo 'active'; } ?>"><?php echo filter_var($lang['settings_verification'], FILTER_SANITIZE_STRING); ?></a><?php } ?>
                            <a href="<?= $settings['url']; ?>account/settings/logs" class="list-group-item list-group-item-action <?php if($c == "logs") { echo 'active'; } ?>"><?php echo filter_var($lang['settings_account_logs'], FILTER_SANITIZE_STRING); ?></a>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="user-wallet-wrap">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="user-connected-form-block">
                            <?php
                            $redirect_profile = $settings['url']."account/settings/profile";
                            switch($c) {
                                case "profile": include("settings/profile.php"); break;
                                case "change_password": include("settings/change_password.php"); break;
                                case "wallet_passphrase": include("settings/wallet_passphrase.php"); break;
                                case "2fa": include("settings/2fa.php"); break;
                                case "verification": include("settings/verification.php"); break;
                                case "logs": include("settings/logs.php"); break;
                                default: header("Location: $redirect_profile");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>