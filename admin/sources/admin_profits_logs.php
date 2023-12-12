<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
// Type 299 = Membership earn
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
?>
<div class="col-md-12">
	<div class="card">
        <div class="card-body">
            <form action="" method="POST">
            <div class="row">
                <div class="col-md-5" style="padding:10px;">
                    <input type="text" class="form-control" name="txid" placeholder="Transaction ID" value="<?php if(isset($_POST['txid'])) { echo filter_var($_POST['txid'], FILTER_SANITIZE_STRING); } ?>">
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
                        <th>Date</th>
                        <th>TXID</th>
                        <th>Fee Charge</th>
                        <th>Via</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $searching=0;
                    $FormBTN = protect($_POST['btn_search']);
                    if($FormBTN == "deposits") {
                        $searching=1;
                        $search_query = array();
                        $s_txid = protect($_POST['txid']);
                        if(!empty($s_txid)) { $search_query[] = "u_field_3='$s_txid'"; }
                        $search_query[] = "type='1'";
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
                    
                    if($searching==1) {
                        if(empty($p_query)) {
                            $qry = 'empty query';
                        }
                        $statement = "admin_logs WHERE $p_query";
                        $query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC");
                    } else {
                        $statement = "admin_logs";
                        $query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
                    }
                    if($query->num_rows>0) {
                        while($row = $query->fetch_assoc()) {
                            ?>
                            <tr>
                            <td><?php if($row['time']>0) { echo date("d/m/Y H:i:s",$row['time']); } else { echo 'n/a'; } ?></td>
                            <td><?=$row['u_field_3']?></td>
                            <td><?=$row['u_field_1']?> <?=$row['u_field_2']?></td>
                            <td>
                                <?php
                                if ($row['type'] == "299") {
                                    echo '<span class="badge badge-info">Membership Purchased</span>';
								} else {
								    echo '<span class="badge badge-danger">Unknown</span>';
								}
                                ?>
                            </td>
                            </tr>
                            <?php
                        }
                    } else {
                        if($searching == "1") {
                            echo '<tr><td colspan="6">No found results.</td></tr>';
                        } else {
                            echo '<tr><td colspan="6">No have admin profits logs yet.</td></tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php
            if($searching == "0") {
                $ver = "./?a=admin_profits_logs";
                if(admin_pagination($statement,$ver,$limit,$page)) {
                    echo admin_pagination($statement,$ver,$limit,$page);
                }
            }
            ?>
        </div>
    </div>
</div>