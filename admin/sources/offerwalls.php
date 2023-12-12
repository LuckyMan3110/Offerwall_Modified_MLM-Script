<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
$b = protect($_GET['b']);
if($b == "view") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM offerwalls_logs WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=offerwalls"); }
	$row = $query->fetch_assoc();
	?>
<div class="col-md-12">
	<div class="card">
        <div class="card-body">
            <?php
            $FormBTN = protect($_POST['btn_action']);
            if($FormBTN == "process_reward") {
                $row['status'] = '1';
                $time = time();
                $update = $db->query("UPDATE offerwalls_logs SET status='1',processed_on='$time' WHERE id='$row[id]'");
                $update = $db->query("UPDATE activity SET status='1' WHERE txid='$row[txid]'");
                $update = $db->query("UPDATE transactions SET status='1' WHERE txid='$row[txid]'");
                $account = idinfo($row['uid'],"email");
                UpdateUserWallet($row['uid'],$row['reward'],$settings['default_currency'],1);
                $query = $db->query("SELECT * FROM offerwalls_logs WHERE id='$id'");
                $row = $query->fetch_assoc();
                echo success("Reward was credit to user account successfully.");
            }

            if($FormBTN == "cancel_reward") {
                $row['status'] = '2';
                $update = $db->query("UPDATE offerwalls_logs SET status='2' WHERE id='$row[id]'");
                $update = $db->query("UPDATE activity SET status='2' WHERE txid='$row[txid]'");
                $update = $db->query("UPDATE transactions SET status='2' WHERE txid='$row[txid]'");
                echo success("Reward was canceled successfully.");
            }
            if($FormBTN == "pending_reward") {
                $row['status'] = '3';
                $update = $db->query("UPDATE offerwalls_logs SET status='3' WHERE id='$row[id]'");
                $update = $db->query("UPDATE activity SET status='3' WHERE txid='$row[txid]'");
                $update = $db->query("UPDATE transactions SET status='3' WHERE txid='$row[txid]'");
                echo success("Reward marked as pending confirmation.");
            }
            
            if($FormBTN == "reverse_reward") {
                $row['status'] = '4';
                $time = time();
                $update = $db->query("UPDATE offerwalls_logs SET status='4' WHERE id='$row[id]'");
                $update = $db->query("UPDATE activity SET status='2',type='32' WHERE txid='$row[txid]'");
                $update = $db->query("UPDATE transactions SET status='2',type='32' WHERE txid='$row[txid]'");
                $account = idinfo($row['uid'],"email");
                UpdateUserWallet($row['uid'],$row['reward'],$settings['default_currency'],2);
                $query = $db->query("SELECT * FROM offerwalls_logs WHERE id='$id'");
                $row = $query->fetch_assoc();
                echo success("Reward was debited from user account successfully.");
            }
            ?>

            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td style="text-transform:capitalize;"><?=$row['company']?> TID:</td>
                        <td><?php echo $row['tid']; ?></td>
                    </tr>
                    <tr>
                        <td>User:</td>
                        <td><a href="./?a=users&b=edit&id=<?php echo $row['uid']; ?>"><?php echo idinfo($row['uid'],"email"); ?></a></td>
                    </tr>
                    <tr>
                        <td>Reward:</td>
                        <td><?php echo $row['reward']; ?> <?php echo $settings['default_currency']; ?></td>
                    </tr>
                    <tr>
                        <td>Date:</td>
                        <td><?php if($row['date_created']>0) { echo date("d/m/Y H:i:s",$row['date_created']); } else { echo 'n/a'; } ?></td>
                    </tr>
                    <tr>
                        <td>Campaign Name and ID:</td>
                        <td><?=$row['campaign_name']?> (<?=$row['campaign_id']?>)</td>
                    </tr>
                    <tr>
                        <td>Action:</td>
                        <td>
                            <?php
                            $action = $row['action'];
                            if($action == "1") {
                                echo '<span class="badge badge-success">Reward Confirmed.</span>';
                            } elseif($action == "2") {
                                echo '<span class="badge badge-danger">Reverse the rewards as Offerwall not accepted the result.</span>';
                            } else { }
                            ?>
                        </td>
                    </tr>
                    <?php if (!empty($row['txid'])) { ?>
                    <tr>
                        <td>System TXID:</td>
                        <td><?php echo $row['txid']; ?></td>
                    </tr>
                    <tr>
                        <td>Processed on:</td>
                        <td><?php if($row['processed_on']>0) { echo date("d/m/Y H:i:s",$row['processed_on']); } else { echo 'No yet processed.'; } ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Status:</td>
                        <td>
                            <?php
                            $status = $row['status'];
                            if($status == "1") {
                                echo '<span class="badge badge-success">Completed</span>';
                            } elseif($status == "2") {
                                echo '<span class="badge badge-danger">Canceled</span>';
                            } elseif($status == "3") {
                                echo '<span class="badge badge-warning">Pending Approval</span>';
                            } elseif($status == "4") {
                                echo '<span class="badge badge-info">Reversed</span>';
                            } else { }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <hr>
            <?php if($row['status'] == "3") { ?>
            <form action="" method="POST">
                <button type="submit" class="btn btn-success" name="btn_action" value="process_reward">Send Reward</button> 
                <button type="submit" class="btn btn-danger" name="btn_action" value="cancel_reward">Cancel Reward</button>
            </form>
            <?php } ?>
            <?php if($row['status'] == "2") { ?>
            <form action="" method="POST">
                <button type="submit" class="btn btn-warning" name="btn_action" value="pending_reward">Make Pending</button>
            </form>
            <?php } ?>
            <?php if($row['status'] == "1") { ?>
            <form action="" method="POST">
                <button type="submit" class="btn btn-warning" name="btn_action" value="pending_reward">Make Pending</button>
                <button type="submit" class="btn btn-info" name="btn_action" value="reverse_reward">Reverse Reward</button>
            </form>
            <?php } ?>
            <?php if($row['status'] == "4") { ?>
            <form action="" method="POST">
                <button type="submit" class="btn btn-warning" name="btn_action" value="pending_reward">Make Pending</button>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="col-md-12">
	<div class="card">
        <div class="card-body">
            <form action="" method="POST">
            <div class="row">
            <div class="col-md-5" style="padding:10px;">
                    <input type="text" class="form-control" name="txid" placeholder="TID" value="<?php if(isset($_POST['txid'])) { echo $_POST['txid']; } ?>">
                </div>
                <div class="col-md-5" style="padding:10px;">
                    <input type="text" class="form-control" name="email" placeholder="Email address" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>">
                </div>
                <div class="col-md-2" style="padding:10px;">
                    <button type="submit" class="btn btn-primary btn-block" name="btn_search" value="deposits">Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
		<div class="card">
            <div class="card-body table-responsive">
                
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="25%">User</th>
                        <th width="15%">Reward</th>
                        <th width="15%">TID</th>
                        <th width="15%">Company</th>
                        <th width="18%">Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $searching=0;
                    $FormBTN = protect($_POST['btn_search']);
                    if($FormBTN == "deposits") {
                        $searching=1;
                        $search_query = array();
                        $s_email = protect($_POST['email']);
                        if(!empty($s_email)) {
                            if(GetUserID($s_email)) {
                                $s_uid = GetUserID($s_email);
                                $search_query[] = "uid='$s_uid'";
                            }
                        }
                        $s_txid = protect($_POST['txid']);
                        if(!empty($s_txid)) { $search_query[] = "tid='$s_txid'"; }
                        $p_query = implode(" and ",$search_query);
                    }
                    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
                    $limit = 20;
                    $startpoint = ($page * $limit) - $limit;
                    if($page == 1) {
                        $i = 1;
                    } else {
                        $i = $page * $limit;
                    }
                    $statement = "offerwalls_logs";
                    if($searching==1) {
                        if(empty($p_query)) {
                            $qry = 'empty query';
                        }
                        $query = $db->query("SELECT * FROM {$statement} WHERE $p_query ORDER BY id DESC");
                    } else {
                        $query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
                    }
                    if($query->num_rows>0) {
                        while($row = $query->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><a href="./?a=users&b=edit&id=<?php echo $row['uid']; ?>"><?php echo idinfo($row['uid'],"email"); ?></a></td>
                                <td><?php echo $row['reward']; ?> <?php echo $settings['default_currency']; ?></td>
                                <td><?php echo $row['tid']; ?></td>
                                <td><?=$row['company']; ?></td>
                                <td>
                                    <?php
                                    $status = $row['status'];
                                    if($status == "1") {
                                        echo '<span class="badge badge-success">Completed</span>';
                                    } elseif($status == "2") {
                                        echo '<span class="badge badge-danger">Canceled</span>';
                                    } elseif($status == "3") {
                                        echo '<span class="badge badge-warning">Pending</span>';
                                    } elseif($status == "4") {
                                        echo '<span class="badge badge-info">Reversed</span>';
                                    } else { }
                                    ?>
                                </td>
                                <td>
                                    <a href="./?a=offerwalls&b=view&id=<?php echo $row['id']; ?>" title="View"><span class="badge badge-primary"><i class="fa fa-search"></i> View</span></a> 
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        if($searching == "1") {
                            echo '<tr><td colspan="6">No found results.</td></tr>';
                        } else {
                            echo '<tr><td colspan="6">No have Offerwalls logs yet.</td></tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php
            if($searching == "0") {
                $ver = "./?a=offerwalls";
                if(admin_pagination($statement,$ver,$limit,$page)) {
                    echo admin_pagination($statement,$ver,$limit,$page);
                }
            }
            ?>
        </div>
    </div>
</div>
                                                
<?php
}
?>