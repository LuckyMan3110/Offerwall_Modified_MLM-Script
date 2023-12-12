<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
define('V1_INSTALLED',TRUE);
ob_start();
session_start();
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
include(getLanguage($settings['url'],null,2));

if(checkSession()) {
    $id = protect($_GET['id']);
    
    $query = $db->query("SELECT * FROM gateways_fields WHERE gateway_id='$id' ORDER BY id");
    if($query->num_rows>0) {
        $process_type = gatewayinfo($id,"process_type");
        $process_time = gatewayinfo($id,"process_time");
        $fee = gatewayinfo($id,"fee");
        $include_fee = gatewayinfo($id,"include_fee");
        $extra_fee = gatewayinfo($id,"extra_fee");
        if($include_fee == "1") {
            $efee = '+ '.$extra_fee.'%';
        } else {
            $efee = '';
        }
        
        $c_fee = $fee;
        echo '<div class="form-group" style="color:white;">
                <label style="color:white;">'.$lang['will_be_debited'].'</label>
                <input type="text" class="form-control" disabled id="receive_amount">
                <input type="hidden" id="c_fee" value="'.$c_fee.'">
                <input type="hidden" id="d_fee" value="'.$c_fee.'">
                <input type="hidden" id="c_include_fee" value="'.$include_fee.'">
                <input type="hidden" id="c_extra_fee" value="'.$extra_fee.'">
            </div>';
        echo $lang['withdrawal_fee'].': <span id="wfee">'.$fee.' '.$settings['default_currency'].'</span> '.$efee.'';
        while($row = $query->fetch_assoc()) {
            echo '<div class="form-group">
                <label style="color:white;">'.$row['field_name'].'</label>
                <input type="text" class="form-control" name="fieldvalues['.$row['id'].']">
            </div>';
        }
    } 
}
?>