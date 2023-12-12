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
$myuser_infoQuery= $db->query("SELECT * FROM users WHERE id=".$_SESSION['uid']); 
$myuser_info = $myuser_infoQuery->fetch_assoc();
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-3">
                    <h5 class="mb-2">Referral Program</h5>
                    <p class="mb-0">Track and find all the details about our referral program, your stats and revenues.</p>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-3 col-6 text-center">
                            <div class="py-3" style="border-radius:10px;border:solid;border-color:orange;">
                                <?php 
                                    foreach($db->query("SELECT SUM(commission) FROM bonus_logs WHERE currency= '$settings[default_currency]' and uid='$_SESSION[uid]' ") as $row) 
                                    $td = number_format($row['SUM(commission)'], 2, '.', '');  
                                ?>
                                <h6 class="text-warning text-gradient mb-0">Earnings</h6>
                                <h4 class="font-weight-bolder"><span class="small">$ </span><?=$td?></h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 text-center">
                            <div class="py-3" style="border-radius:10px;border:solid;border-color:#E10CC4;">
                                <h6 class="text-primary text-gradient mb-0">Direct Referrals</h6>
                                <h4 class="font-weight-bolder"><?php $query = $db->query("SELECT * FROM users WHERE ref1='$_SESSION[uid]' "); echo $query->num_rows; ?></h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 text-center mt-4 mt-lg-0">
                            <div class="py-3" style="border-radius:10px;border:solid;border-color:#048CDE;">
                                <h6 class="text-info text-gradient mb-0">Indirect Referrals</h6>
                                <h4 class="font-weight-bolder"><?php $query = $db->query("SELECT * FROM users WHERE ref2='$_SESSION[uid]' or ref3='$_SESSION[uid]' or ref4='$_SESSION[uid]' or ref5='$_SESSION[uid]' or ref6='$_SESSION[uid]' or ref7='$_SESSION[uid]' or ref8='$_SESSION[uid]' or ref9='$_SESSION[uid]' or ref10='$_SESSION[uid]' "); echo $query->num_rows; ?></h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 text-center mt-4 mt-lg-0">
                            <div class="py-3" style="border-radius:10px;border:solid;border-color:#EA0909;">
                                <h6 class="text-danger text-gradient mb-0">Total Referrals</h6>
                                <h4 class="font-weight-bolder"><?php $query = $db->query("SELECT * FROM users WHERE ref1='$_SESSION[uid]' or ref2='$_SESSION[uid]' or ref3='$_SESSION[uid]' or ref4='$_SESSION[uid]' or ref5='$_SESSION[uid]' or ref6='$_SESSION[uid]' or ref7='$_SESSION[uid]' or ref8='$_SESSION[uid]' or ref9='$_SESSION[uid]' or ref10='$_SESSION[uid]' "); echo $query->num_rows; ?><span class="small"></span></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-5 col-12">
                            <h6 class="mb-0">Referral Link</h6>
                            <p class="text-sm">Copy the link bellow and share with your friends.</p>
                            <div class="border-dashed border-1 border-secondary border-radius-md p-3">
                                <form action="#" method="post">
                                    <div class="d-flex align-items-center">
                                        <div class="form-group w-70">
                                            <div class="input-group bg-gray-200">
                                                <input type="text" id="myInput" class="form-control form-control-sm" value="<?=$settings['url']?>index.php?ref=<?=$_SESSION['uid']?>">
                                            </div>
                                        </div>
                                        <button type="button" onclick="myFunction()" id="myTooltip" onmouseout="outFunc()" class="btn btn-sm btn-outline-secondary ms-2 px-3">Copy</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-7 col-12 mt-4 mt-lg-0">
                            <h6 class="mb-0">How to use</h6>
                            <p class="text-sm">Integrate your referral code in 3 easy steps.</p>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="card card-plain text-center">
                                        <div class="card-body">
                                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md mb-2">
                                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                            <p class="text-sm font-weight-bold mb-2">1. Share with your friends </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="card card-plain text-center">
                                        <div class="card-body">
                                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md mb-2">
                                                <i class="ni ni-send text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                            <p class="text-sm font-weight-bold mb-2">2. Wait for there joining </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="card card-plain text-center">
                                        <div class="card-body">
                                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md mb-2">
                                                <i class="ni ni-spaceship text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                            <p class="text-sm font-weight-bold mb-2">3. Earn Commission when they activate account. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                </div>
            </div>
        </div>
        <div class="col-6 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6>Level 1 (Direct Referrals)</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Referral Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Country</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
    							$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    							$limit = 20;
    							$startpoint = ($page * $limit) - $limit;
    							if($page == 1) {
    								$i = 1;
    							} else {
    								$i = $page * $limit;
    							}
    						   
    							$query = $db->query("SELECT * FROM users WHERE ref1='$_SESSION[uid]' ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
    							if($query->num_rows>0) {
    								while($row = $query->fetch_assoc()) {
    							?>
                                <tr>
                                    <?php $email = $row['email']; ?>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?php echo date("d M Y H:i",$row['signup_time']); ?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?php echo hideEmailAddress($email); ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-sm font-weight-bold mb-0"><?php echo $row['country']; ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <?php if ($row['membership'] > 0) { echo"<span class='badge badge-info'>Active</span>"; } else { echo"<span class='badge badge-warning'>Inactive</span>"; } ?>
                                    </td>
                                </tr>
                                <?php } } else { echo '<tr><td colspan="3">You have no referral yet.</font></td></tr>'; } ?>
                            </tbody>
                        </table>
                        <?php
    						$ver = $settings['url']."account/ref";
    						if(web_pagination($statement,$ver,$limit,$page)) {
    							echo web_pagination($statement,$ver,$limit,$page);
    						}
    					?>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6>Indirect Referrals</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Referral Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Country</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
    							$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    							$limit = 20;
    							$startpoint = ($page * $limit) - $limit;
    							if($page == 1) {
    								$i = 1;
    							} else {
    								$i = $page * $limit;
    							}
    						   
    							$query = $db->query("SELECT * FROM users WHERE ref2='$_SESSION[uid]' or ref3='$_SESSION[uid]' or ref4='$_SESSION[uid]' or ref5='$_SESSION[uid]' or ref6='$_SESSION[uid]' or ref7='$_SESSION[uid]' or ref8='$_SESSION[uid]' or ref9='$_SESSION[uid]' or ref10='$_SESSION[uid]' ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
    							if($query->num_rows>0) {
    								while($row = $query->fetch_assoc()) {
    							?>
                                <tr>
                                    <?php $email = $row['email']; ?>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?php echo date("d M Y H:i",$row['signup_time']); ?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?php echo hideEmailAddress($email); ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-sm font-weight-bold mb-0"><?php echo $row['country']; ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <?php if ($row['membership'] > 0) { echo"<span class='badge badge-info'>Active</span>"; } else { echo"<span class='badge badge-warning'>Inactive</span>"; } ?>
                                    </td>
                                </tr>
                                <?php } } else { echo '<tr><td colspan="3">You have no referral yet.</font></td></tr>'; } ?>
                            </tbody>
                        </table>
                        <?php
    						$ver = $settings['url']."account/ref";
    						if(web_pagination($statement,$ver,$limit,$page)) {
    							echo web_pagination($statement,$ver,$limit,$page);
    						}
    					?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        function myFunction() {
          var copyText = document.getElementById("myInput");
          copyText.select();
          copyText.setSelectionRange(0, 99999);
          document.execCommand("copy");
          
          var tooltip = document.getElementById("myTooltip");
          tooltip.innerHTML = "Copied!";
        }
        
        function outFunc() {
          var tooltip = document.getElementById("myTooltip");
          tooltip.innerHTML = "Copy";
        }
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>