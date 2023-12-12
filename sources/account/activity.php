<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
if(!checkSession()) {
    $redirect = $settings['url']."login";
    header("Location: $redirect");
}
?>
<div class="container-fluid py-4">                
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>All Transactions</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <form class="user-connected-from user-signup-form" action="" method="POST">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="txid" placeholder="<?php echo filter_var($lang['field_24'], FILTER_SANITIZE_STRING); ?>">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="email" placeholder="<?php echo filter_var($lang['field_25'], FILTER_SANITIZE_STRING); ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block" name="search" value="search" style="padding:11px;"><i class="fa fa-search"></i> <?php echo filter_var($lang['btn_22'], FILTER_SANITIZE_STRING); ?></button>
                    </div>
                </div>
                </form>
                <?php
                $Searching = 0;
				if(isset($_POST['search'])) {
                $FormBTN = protect($_POST['search']);
                if($FormBTN == "search") {
                    $Search = '';
                    $transaction_id = protect($_POST['txid']);
                    if(!empty($transaction_id)) {
                        $Search .= " and txid='$transaction_id'";
                    }
                    $email = protect($_POST['email']);
                    $email_id = GetUserID($email);
                    if($email_id !== false && $email_id > 0) {
                        $Search .= " and u_field_1='$email_id'";
                    }
                    if(!empty($Search)) {
                        $Searching = 1;
                    }
                }
				}
                ?>
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo filter_var($lang['transaction_id'], FILTER_SANITIZE_STRING); ?></th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
                        $limit = 15;
                        $startpoint = ($page * $limit) - $limit;
                        if($page == 1) {
                            $i = 1;
                        } else {
                            $i = $page * $limit;
                        }
                        if($Searching == "1") {
                            $statement = "activity WHERE uid='$_SESSION[uid]' $Search";
                            $query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC");
                        } else {
                            $statement = "activity WHERE uid='$_SESSION[uid]'";
                            $query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
                        }
                        if($query->num_rows>0) {
                            while($row = $query->fetch_assoc()) {
                                $amount = $row['amount'];
                                if($row['type'] == "2" or $row['type'] == "4" or $row['type'] == "6" or $row['type'] == "7" or $row['type'] == "8" or $row['type'] == "299" or $row['type'] == "29" or $row['type'] == "32") {
                                        $amount = '-'.$amount;
                                } else {
                                        $amount = '+'.$amount;
                                }
                                ?>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  <div>
                                    <small><?= ActivityDate($row['created']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>
                                  </div>
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?php echo DecodeUserActivity($row['id']); ?></h6>
                                  </div>
                                </div>
                              </td>
                              <td><?php echo filter_var($row['txid'], FILTER_SANITIZE_STRING); ?></td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> <?php echo filter_var($amount.' '.$row['currency'], FILTER_SANITIZE_STRING)?> </span>
                              </td>
                              <td class="align-middle">
                                <center><span class="text-xs font-weight-bold"> <?php echo filter_var(DecodeTXStatus($row['status'], FILTER_SANITIZE_STRING)) ?> </span></center>
                              </td>
                              <td>
                                <div class="avatar-group mt-2 text-xs">
                                  <a href="<?php echo filter_var($settings['url'], FILTER_SANITIZE_STRING); ?>account/transaction/<?php echo filter_var($row['txid'], FILTER_SANITIZE_STRING)?>" class="btn btn-primary text-xs">View</a>
                                </div>
                              </td>
                            </tr>
                    <?php
                        }
                    } else {
                        if($Searching == "1") {
                            echo '<tr><td colspan="6">'.$lang[info_7].'</td></tr>';
                        } else {
                            echo '<tr><td colspan="6">'.$lang[info_8].'</td></tr>';
                        }
                    }
                    ?>
                  </tbody>
                </table>
                <center>
                <?php
                if($Searching == "0") {
                    $ver = $settings['url']."account/activity";
                    if(web_pagination($statement,$ver,$limit,$page)) {
                        echo web_pagination($statement,$ver,$limit,$page);
                    }
                }
                ?>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>