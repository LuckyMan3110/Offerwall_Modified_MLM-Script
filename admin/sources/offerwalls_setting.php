<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

?>
<?php
        
if(isset($_POST['offerwall_config'])) {
    
    if ($_POST['offerwall_config'] == "wannads") {
        $wannads_api = protect($_POST['wannads_api']);
        $wannads_secret = protect($_POST['wannads_secret']);
        if (empty($wannads_api) or empty($wannads_secret)) {
            $result =  error("Some fields are empty.");
        } else {
            $update = $db->query("UPDATE settings SET wannads_api='$wannads_api',wannads_secret='$wannads_secret'");
			$settingsQuery = $db->query("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
			$settings = $settingsQuery->fetch_assoc();
			$result =  success("Details has been updated.");
        }
    }
    if ($_POST['offerwall_config'] == "bitlabs") {
        $bitlabs_api = protect($_POST['bitlabs_api']);
        $bitlabs_secret = protect($_POST['bitlabs_secret']);
        if (empty($bitlabs_api) or empty($bitlabs_secret)) {
            $result =  error("Some fields are empty.");
        } else {
            $update = $db->query("UPDATE settings SET bitlabs_api='$bitlabs_api',bitlabs_secret='$bitlabs_secret'");
			$settingsQuery = $db->query("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
			$settings = $settingsQuery->fetch_assoc();
			$result =  success("Details has been updated.");
        }
    }
    if ($_POST['offerwall_config'] == "monlix") {
        $monlix_api = protect($_POST['monlix_api']);
        $monlix_secret = protect($_POST['monlix_secret']);
        if (empty($monlix_api) or empty($monlix_secret)) {
            $result =  error("Some fields are empty.");
        } else {
            $update = $db->query("UPDATE settings SET monlix_api='$monlix_api',monlix_secret='$monlix_secret'");
			$settingsQuery = $db->query("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
			$settings = $settingsQuery->fetch_assoc();
			$result =  success("Details has been updated.");
        }
    }
    if ($_POST['offerwall_config'] == "cpxresearch") {
        $cpxresearch_api = protect($_POST['cpxresearch_api']);
        $cpxresearch_secret = protect($_POST['cpxresearch_secret']);
        if (empty($cpxresearch_api) or empty($cpxresearch_secret)) {
            $result =  error("Some fields are empty.");
        } else {
            $update = $db->query("UPDATE settings SET cpxresearch_api='$cpxresearch_api',cpxresearch_secret='$cpxresearch_secret'");
			$settingsQuery = $db->query("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
			$settings = $settingsQuery->fetch_assoc();
			$result =  success("Details has been updated.");
        }
    }
}

?>
<?php if (!empty($result)) { ?>
<?=$result?>
<?php } ?>
<div class="card">
    <div class="card-header">
        <strong class="card-title">Wannads <b>Config</b></strong>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="form-group">
                <label>API Key</label>
                <input type="text" class="form-control" name="wannads_api" value="<?php echo $settings['wannads_api']; ?>">
            </div>
            <div class="form-group">
                <label>Secret Key</label>
                <input type="text" class="form-control" name="wannads_secret" value="<?php echo $settings['wannads_secret']; ?>">
            </div>
            <div class="form-group">
                <label>Postback URL</label>
                <input type="text" disabled class="form-control" value="<?php echo $settings['url']; ?>callbacks/checkPayment.php?a=Wannads">
            </div>
            <button type="submit" class="btn btn-primary" name="offerwall_config" value="wannads" style="border-radius:0px;"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Save Changes</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <strong class="card-title">Bitlabs <b>Config</b></strong>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="form-group">
                <label>API Key</label>
                <input type="text" class="form-control" name="bitlabs_api" value="<?php echo $settings['bitlabs_api']; ?>">
            </div>
            <div class="form-group">
                <label>Secret Key</label>
                <input type="text" class="form-control" name="bitlabs_secret" value="<?php echo $settings['bitlabs_secret']; ?>">
            </div>
            <div class="form-group">
                <label>Postback URL</label>
                <input type="text" disabled class="form-control" value="<?php echo $settings['url']; ?>callbacks/checkPayment.php?a=Bitlabs">
            </div>
            <button type="submit" class="btn btn-primary" name="offerwall_config" value="bitlabs" style="border-radius:0px;"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Save Changes</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <strong class="card-title">CPX Research <b>Config</b></strong>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="form-group">
                <label>APP ID</label>
                <input type="text" class="form-control" name="cpxresearch_api" value="<?php echo $settings['cpxresearch_api']; ?>">
            </div>
            <div class="form-group">
                <label>Security Hash</label>
                <input type="text" class="form-control" name="cpxresearch_secret" value="<?php echo $settings['cpxresearch_secret']; ?>">
            </div>
            <div class="form-group">
                <label>Postback URL</label>
                <input type="text" disabled class="form-control" value="<?php echo $settings['url']; ?>callbacks/checkPayment.php?a=CPX">
            </div>
            <button type="submit" class="btn btn-primary" name="offerwall_config" value="cpxresearch" style="border-radius:0px;"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Save Changes</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <strong class="card-title">Monlix <b>Config</b></strong>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="form-group">
                <label>API Key</label>
                <input type="text" class="form-control" name="monlix_api" value="<?php echo $settings['monlix_api']; ?>">
            </div>
            <div class="form-group">
                <label>Secret Key</label>
                <input type="text" class="form-control" name="monlix_secret" value="<?php echo $settings['monlix_secret']; ?>">
            </div>
            <div class="form-group">
                <label>Postback URL</label>
                <input type="text" disabled class="form-control" value="<?php echo $settings['url']; ?>callbacks/checkPayment.php?a=Monlix">
            </div>
            <button type="submit" class="btn btn-primary" name="offerwall_config" value="monlix" style="border-radius:0px;"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Save Changes</button>
        </form>
    </div>
</div>