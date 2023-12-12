<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
error_reporting(0);
if(!checkSession()) {
    $redirect = $settings['url']."login";
    header("Location: $redirect");
}

$id = protect($_GET['id']);
$query = $db->query("SELECT * FROM support WHERE hash='$id' and sender='$_SESSION[uid]' and status='1'");
if($query->num_rows==0) { 
    $redirect = $settings['url']."account/supports";
    header("Location: $redirect");
}
$row = $query->fetch_assoc();
?>
<div class="col-md-12">
    <div class="user-login-signup-form-wrap">
        <div class="modal-content">
            <div class="modal-body">
                <div class="user-connected-form-block">
                    <h3>Confirm Close Ticket</h2>
                    <hr/>
                    <?php
                    $hide_form=0;
					if(isset($_POST['close'])) {
                    $FormBTN = protect($_POST['close']);
                    if($FormBTN == "yes") {
                        $update = $db->query("UPDATE support SET status='4' WHERE id='$row[id]'");
                        $hide_form=1;
                        $success_1 = str_ireplace("%hash%",$row['hash'],'$lang_success_1');
                        echo success("Support Ticket Closed $row[hash]");
                        EmailSys_DisputeClosed(idinfo($row['recipient'],"email"),$row['hash'],"");
                    }
					}
                    if($hide_form==0) {
                    ?>
                    
                    <form class="user-connected-from user-login-form" action="" method="POST">
                        <div class="alert alert-info">
                            Are you sure you want to close Support Ticket <b><?php echo $row['hash']; ?></b>?
                        </div>
                        <button type="submit" name="close" value="yes" class="btn btn-success"><?php echo $lang['btn_1']; ?></button> <a href="<?php echo $settings['url']; ?>account/support/<?php echo $row['hash']; ?>" class="btn btn-danger"><?php echo $lang['btn_2']; ?></a>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>