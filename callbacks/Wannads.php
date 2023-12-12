<?php
$secret = $setings['wannads_secret']; // check your app info at www.wannads.com
$userId = isset($_GET['subId']) ? $_GET['subId'] : null;
$transactionId = isset($_GET['transId']) ? $_GET['transId'] : null;
$points = isset($_GET['reward']) ? $_GET['reward'] : null;
$signature = isset($_GET['signature']) ? $_GET['signature'] : null;
$action = isset($_GET['status']) ? $_GET['status'] : null;
$ipuser = isset($_GET['userIp']) ? $_GET['userIp'] : "0.0.0.0";
$campaignId = isset($_GET['campaign_id']) ? $_GET['campaign_id'] : null;
$campaignName = isset($_GET['campaign_name']) ? $_GET['campaign_name'] : null;
$country = isset($_GET['country']) ? $_GET['country'] : null;

//$sp = $signature;
//$sp2 = md5($userId.$transactionId.$points.$secret);
$transactionIdCount = $db->query("SELECT * FROM offerwalls_logs WHERE tid='$transactionId' && company='wannads'");
// validate signature
//if(md5($userId.$transactionId.$points.$secret) == "$signature") {
    if($transactionIdCount->num_rows>0){ // Check if the transaction is new
        // Transaction already in our system, don't call us again.
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
            VALUES ('$userId','$date','$transactionId','$campaignId','$campaignName','$ipuser','$country','wannads','$points','$action','$signature','3','$txid')");
            $description = "Completed Offers and Task by Wannads. ($campaignName - $campaignId)";
            $create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            VALUES ('$txid','31','$userId','$description','$points','$settings[default_currency]','3','$date')");
            $insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            VALUES ('$txid','31','$userId','$points','$settings[default_currency]','3','$date')");
            echo "OK";
        }
    }
//}
?>