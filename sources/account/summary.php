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
        
        <?php
        $GetUserWallets = $db->query("SELECT * FROM users_wallets WHERE uid='$_SESSION[uid]' ORDER BY id");
        if($GetUserWallets->num_rows>0) {
            while($guw = $GetUserWallets->fetch_assoc()) { ?>
            
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="margin-top:4px;">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold"><?=$guw['currency']?>  Balance</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?=get_wallet_balance($_SESSION['uid'],$guw['currency'])?>
                                    <span class="text-success text-sm font-weight-bolder"></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <img src="<?= $settings['url'] ?>assets/flag/<?=$guw['currency']?>.png" style="width:55%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        
            }
        }
        ?>
    </div>
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Recent Activity</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php
                        $GetUserActivity = $db->query("SELECT * FROM activity WHERE uid='$_SESSION[uid]' ORDER BY id DESC LIMIT 7");
                        if($GetUserActivity->num_rows>0) {
                            while($gua = $GetUserActivity->fetch_assoc()) {
                                $amount = $gua['amount'];
                                if($gua['type'] == "2" or $gua['type'] == "4" or $gua['type'] == "6" or $gua['type'] == "7" or $gua['type'] == "8" or $gua['type'] == "299" or $gua['type'] == "29" or $gua['type'] == "32") {
                                    $amount = '-'.$amount;
                                } else {
                                    $amount = '+'.$amount;
                                } ?>
                    
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <small><?= ActivityDate($gua['created']) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo filter_var(DecodeUserActivity($gua['id']), FILTER_SANITIZE_STRING) ?></h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?php echo filter_var($amount.' '.$gua['currency'], FILTER_SANITIZE_STRING) ?> </span>
                      </td>
                      <td class="align-middle">
                        <center><span class="text-xs font-weight-bold"> <?php echo DecodeTXStatus($gua['status']) ?> </span></center>
                      </td>
                      <td>
                        <div class="avatar-group mt-2 text-xs">
                          <a href="<?php echo filter_var($settings['url'], FILTER_SANITIZE_STRING); ?>account/transaction/<?php echo filter_var($gua['txid'], FILTER_SANITIZE_STRING) ?>" class="btn btn-warning text-xs">View</a>
                        </div>
                      </td>
                    </tr>
                    <?php    }
                        } else { 
                            echo '<tr>
                                <td>'.$lang['info_8'].'</td>
                            </tr>';
                        }
                        ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md">
          <div class="card">
            <div class="card-header pb-0">
              <h6>How to get started?</h6>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-bell-55 text-success text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Deposit Fund</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Deposit some fund to activate a membership.</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-send text-danger text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Buy Membership</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Purchase membership and make referrals.</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-money-coins text-info text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Enjoy Earning</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Enjoy your happing and sweet earning with us.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>