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
	$query = $db->query("SELECT * FROM membership_log WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=membership_log"); }
	$row = $query->fetch_assoc();
	?>
	

           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                        <td>Deposit ID:</td>
                                        <td><?php echo $row['id']; ?></td>
                                    </tr>
                                <tr>
                                        <td>Deposit Hash:</td>
                                        <td><?php echo $row['txid']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>User:</td>
                                        <td><a href="./?a=users&b=edit&id=<?php echo $row['uid']; ?>"><?php echo idinfo($row['uid'],"email"); ?></a></td>
                                    </tr>
                                    <tr>
                                        <td>Amount:</td>
                                        <td><?php echo $row['amount']; ?> <?php echo $row['currency']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Fee:</td>
                                        <td><?php echo $row['fee']; ?> <?php echo $row['currency']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gross Amount:</td>
                                        <td><?php $g_amount = $row['amount'] - $row['fee'] ; echo $g_amount; ?> <?php echo $row['currency']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gateway:</td>
                                        <td><?php echo gatewayinfo($row['method'],"name"); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gateway Transaction ID:</td>
                                        <td><?php if($row['gateway_txid']) { echo $row['gateway_txid']; } else { echo 'n/a'; } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date:</td>
                                        <td><?php if($row['requested_on']>0) { echo date("d/m/Y H:i:s",$row['requested_on']); } else { echo 'n/a'; } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Processed on:</td>
                                        <td><?php if($row['processed_on']>0) { echo date("d/m/Y H:i:s",$row['processed_on']); } else { echo 'n/a'; } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td>
                                        <td>
                                                <?php
                                                $status = $row['status'];
                                                if($status == "3") {
                                                    echo '<span class="badge badge-success">Completed</span>';
                                                } elseif($status == "2") {
                                                    echo '<span class="badge badge-danger">Canceled</span>';
                                                } elseif($status == "1") {
                                                    echo '<span class="badge badge-warning">Pending</span>';
                                                } else { }
                                                ?>
                                            </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                        </div>
	                </div>
	        </div>
	<?php
} else {
?>


        <div class="col-md-12">
				<div class="card">
                    <div class="card-body">
                        <form action="" method="POST">
                        <div class="row">
                        <div class="col-md-5" style="padding:10px;">
                                <input type="text" class="form-control" name="txid" placeholder="TXID" value="<?php if(isset($_POST['txid'])) { echo $_POST['txid']; } ?>">
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
                                    <th>User</th>
                                    <th>Plan Name</th>
                                    <th>Amount</th>
                                    <th>TXID</th>
                                    <th>Expires on</th>
                                    <th>Status</th>
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
                                    if(!empty($s_txid)) { $search_query[] = "txid='$s_txid'"; }
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
                                $statement = "membership_log";
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
										
										$query_p = $db->query("SELECT * FROM referral_membership WHERE id='$row[plan]'");
										$p = $query_p->fetch_assoc();
										$date = date('Y-m-d');
                                        ?>
                                        <tr>
                                            <td><a href="./?a=users&b=edit&id=<?php echo $row['uid']; ?>"><?php echo idinfo($row['uid'],"email"); ?></a></td>
											<td><?php echo $p['name'] ?></td>
                                            <td><?php echo $row['amount']; ?> <?php echo $row['currency']; ?></td>
                                            <td><?php echo $row['txid']; ?></td>
                                            <td><?php echo $row['end_date']; ?></td>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                if($date > $row['end_date']) {
                                                    echo '<span class="badge badge-danger">Expired</span>';        
                                                } elseif($status == "1") {
                                                    echo '<span class="badge badge-success">Active</span>';
                                                } elseif($status == "2") {
                                                    echo '<span class="badge badge-warning">Pending</span>';
                                                } elseif($status == "3") {
                                                    echo '<span class="badge badge-danger">Cancelled</span>';
                                                } else { }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    if($searching == "1") {
                                        echo '<tr><td colspan="6">No found results.</td></tr>';
                                    } else {
                                        echo '<tr><td colspan="6">No have Active Memberships yet.</td></tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        if($searching == "0") {
                            $ver = "./?a=membership_log";
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