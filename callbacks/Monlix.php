<?php
$secret = $setings['monlix_secret']; // check your app info
$userId = isset($_GET['userId']) ? $_GET['userId'] : null;
$transactionId = isset($_GET['transactionid']) ? $_GET['transactionid'] : null;
$points = isset($_GET['payout']) ? $_GET['payout'] : null;
$country = isset($_GET['country']) ? $_GET['country'] : null;
$action = isset($_GET['status']) ? $_GET['status'] : null;
$ipuser = isset($_GET['userip']) ? $_GET['userip'] : "0.0.0.0";
$signature = isset($_GET['secretKey']) ? $_GET['secretKey'] : null;
$campaignId = "Unavailable";
$campaignName = isset($_GET['taskName']) ? $_GET['taskName'] : null;

$transactionIdCount = $db->query("SELECT * FROM offerwalls_logs WHERE tid='$transactionId' && company='monlix'");
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
        VALUES ('$userId','$date','$transactionId','$campaignId','$campaignName','$ipuser','$country','monlix','$points','$action','$signature','3','$txid')");
        $description = "Completed Offers and Task by Monlix. ($campaignName - $campaignId)";
        $create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
        VALUES ('$txid','31','$userId','$description','$points','$settings[default_currency]','3','$date')");
        $insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
        VALUES ('$txid','31','$userId','$points','$settings[default_currency]','3','$date')");
        echo "OK";
    }
}
?>