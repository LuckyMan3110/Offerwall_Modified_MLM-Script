<?php
//amount_local={amount_local}&amount_usd={amount_usd}&offer_id={offer_ID}&hash={secure_hash}&ip_click={ip_click}
$secret = $setings['cpxresearch_secret'];
$action = isset($_GET['status']) ? $_GET['status'] : null;
$transactionId = isset($_GET['trans_id']) ? $_GET['trans_id'] : null;
$userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;
$points = isset($_GET['amount_usd']) ? $_GET['amount_usd'] : null;
$campaignId = isset($_GET['offer_id']) ? $_GET['offer_id'] : null;
$signature = isset($_GET['hash']) ? $_GET['hash'] : null;
$ipuser = isset($_GET['ip_click']) ? $_GET['ip_click'] : "0.0.0.0";
$campaignName = "Unavailable";
$country = "Unavailable";

$transactionIdCount = $db->query("SELECT * FROM offerwalls_logs WHERE tid='$transactionId' && company='cpxresearch'");
if($transactionIdCount->num_rows>0){ // Check if the transaction is new
    echo "DUP";
    $row = $transactionIdCount->fetch_assoc();
    if ($action == "2" && $row['action'] == "1") {
        $row['status'] = '4';
        $time = time();
        $update = $db->query("UPDATE offerwalls_logs SET status='4' WHERE id='$row[id]'");
        $update = $db->query("UPDATE activity SET status='2',type='32' WHERE txid='$row[txid]'");
        $update = $db->query("UPDATE transactions SET status='2',type='32' WHERE txid='$row[txid]'");
        UpdateUserWallet($row['uid'],$row['reward'],$settings['default_currency'],2);
    }
} else {
    if ($action == "1") {
        $txid = strtoupper(randomHash(10));
        $date = time();
        $insert = $db->query("INSERT offerwalls_logs (uid,date_created,tid,campaign_id,campaign_name,ip,country,company,reward,action,signature,status,txid) 
        VALUES ('$userId','$date','$transactionId','$campaignId','$campaignName','$ipuser','$country','cpxresearch','$points','$action','$signature','3','$txid')");
        $description = "Completed Offers and Task by CPX Research. ($campaignName - $campaignId)";
        $create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
        VALUES ('$txid','31','$userId','$description','$points','$settings[default_currency]','3','$date')");
        $insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
        VALUES ('$txid','31','$userId','$points','$settings[default_currency]','3','$date')");
        echo "OK";
    }
}
?>