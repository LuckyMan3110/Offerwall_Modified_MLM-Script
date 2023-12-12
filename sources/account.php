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
?>

<?php include("account_head.php"); ?>
    <?php include("menu_logged.php"); ?>
    <main class="main-content mt-1 border-radius-lg">    
        <?php include("account_navbar.php"); ?>
        <?php
        $b = protect($_GET['b']);
        switch($b) {
            case "summary": include("account/summary.php"); break;
            case "activity": include("account/activity.php"); break;
            case "ref": include("account/ref.php"); break;
            case "settings": include("account/settings.php"); break;
            case "money": include("account/money.php"); break;
            case "supports": include("account/supports.php"); break;
            case "support": include("account/support.php"); break;
            case "transaction": include("account/transaction.php"); break;
            default: include("account/summary.php");
        }
        ?>
    </main>
<?php include("account_footer.php"); ?>
    
    
