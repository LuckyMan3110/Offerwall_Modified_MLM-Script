<?php
$secret_key = $setings['bitlabs_secret'];
$userId = isset($_GET['uid']) ? $_GET['uid'] : null;
$points = isset($_GET['val']) ? $_GET['val'] : null;
$transactionId = isset($_GET['tx']) ? $_GET['tx'] : null;
$country = isset($_GET['country']) ? $_GET['country'] : null;
$campaignId = isset($_GET['offer_id']) ? $_GET['offer_id'] : null;
$campaignName = isset($_GET['offer_name']) ? $_GET['offer_name'] : null;
$signature = isset($_GET['hash']) ? $_GET['hash'] : null;
$action = isset($_GET['type']) ? $_GET['type'] : null;
if ($action == "COMPLETE") {
$transactionIdCount = $db->query("SELECT * FROM offerwalls_logs WHERE tid='$transactionId' && company='bitlabs'");
// validate signature
//if(md5($userId.$transactionId.$points.$secret) == "$signature") {
    if($transactionIdCount->num_rows>0){ // Check if the transaction is new
        // Transaction already in our system, don't call us again.
        echo "DUP";
    } else {
        $action = 1;
        $txid = strtoupper(randomHash(10));
        $date = time();
        $insert = $db->query("INSERT offerwalls_logs (uid,date_created,tid,campaign_id,campaign_name,country,company,reward,action,signature,status,txid) 
        VALUES ('$userId','$date','$transactionId','$campaignId','$campaignName','$country','bitlabs','$points','$action','$signature','3','$txid')");
        $description = "Completed Offers and Task by Bitlabs. ($campaignName - $campaignId)";
        $create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
        VALUES ('$txid','31','$userId','$description','$points','$settings[default_currency]','3','$date')");
        $insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
        VALUES ('$txid','31','$userId','$points','$settings[default_currency]','3','$date')");
        echo "OK";
    }
//}
}
?>