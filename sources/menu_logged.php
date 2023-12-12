<?php
if (isset($_GET['b'])) {
$b = protect($_GET['b']);
}
if (isset($_GET['c'])) {
$c = protect($_GET['c']); 
} else {
	$c = "";
}
?>
<script src="https://use.fontawesome.com/08d0c47985.js"></script>
<style type="text/css">
.iconBack{
    background: #E8ECEF;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    width: 35px;
    height: 35px;
    box-shadow: 0 3px 6px rgb(0 0 0 / 15%);
    justify-content: center;
}
.icon{
    color: #2E3235;
    font-size: 18px;
}
.iconCurrent{
	background: #F5740E
}
.iconCurrent .icon{
	color: white
}
</style>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-left ms-3 bg-white" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?php echo filter_var($settings['url']); ?>">
        <img src="<?=$settings['url'] ?>assets/front/img/favicon.png" class="navbar-brand-img" style="width:13px;">
        <span class="ms-1 font-weight-bold"><?=$settings['name'] ?></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div >
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  <?php if($b == "summary") { echo 'active'; } ?>" href="<?= $settings['url']; ?>account/summary">
            <span class="iconBack <?php if($b == "summary") { echo 'iconCurrent'; } ?> text-center me-2 d-flex align-items-center justify-content-center">
            	<center><i class="fa fa-igloo" style="color:<?php if($b == "summary") { echo 'white'; } ?>;"></i></center>
            </span>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        
        
        <?php if ($m["deposit"] == 1) { ?>
        <li class="nav-item">
          <a class="nav-link  <?php if($c == "deposit") { echo 'active'; } ?>" href="<?= $settings['url']; ?>account/money/deposit">
            <span class="iconBack <?php if($c == "deposit") { echo 'iconCurrent'; } ?> text-center me-2 d-flex align-items-center justify-content-center">
            	<i class="fa fa-plus-square" style="color:<?php if($c == "deposit") { echo 'white'; } ?>;"></i>
            </span>
            <span class="nav-link-text ms-1">Deposit</span>
          </a>
        </li>
        <?php } ?>
        <?php if ($m["withdrawal"] == 1) { ?>
        <li class="nav-item">
          <a class="nav-link  <?php if($c == "withdrawal") { echo 'active'; } ?>" href="<?= $settings['url']; ?>account/money/withdrawal">
            <span class="iconBack <?php if($c == "withdrawal") { echo 'iconCurrent'; } ?> text-center me-2 d-flex align-items-center justify-content-center">
            	<i class="fa fa-minus-square" style="color:<?php if($c == "withdrawal") { echo 'white'; } ?>;"></i>
            </span>
            <span class="nav-link-text ms-1">Withdraw</span>
          </a>
        </li>
        <?php } ?>
        <?php if ($m["referral_system"] == 1) { ?>
		<li class="nav-item">
          <a class="nav-link  <?php if($c == "membership") { echo 'active'; } ?>" href="<?= $settings['url']; ?>account/money/membership">
            <span class="iconBack <?php if($c == "membership") { echo 'iconCurrent'; } ?> text-center me-2 d-flex align-items-center justify-content-center">
            	<i class="fa fa-align-justify" style="color:<?php if($c == "membership") { echo 'white'; } ?>;"></i>
            </span>
            <span class="nav-link-text ms-1">Membership</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  <?php if($b == "ref") { echo 'active'; } ?>" href="<?=$settings['url']?>account/ref">
            <span class="iconBack <?php if($b == "ref") { echo 'iconCurrent'; } ?> text-center me-2 d-flex align-items-center justify-content-center">
            	<i class="fa fa-users" style="color:<?php if($b == "ref") { echo 'white'; } ?>;margin-bottom:-3px;"></i>
            </span>
            <span class="nav-link-text ms-1">Invite & Earn</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  <?php if($c == "chart") { echo 'active'; } ?>" href="<?=$settings['url']?>account/money/chart">
            <span class="iconBack <?php if($c == "chart") { echo 'iconCurrent'; } ?> text-center me-2 d-flex align-items-center justify-content-center">
            	<i class="fa fa-area-chart" style="color:<?php if($c == "chart") { echo 'white'; } ?>;margin-bottom:-3px;"></i>
            </span>
            <span class="nav-link-text ms-1">Earn Chart</span>
          </a>
        </li>
        <?php if ($m["rewards"] == 1) { ?>
            <li class="nav-item">
              <a class="nav-link  <?php if($c == "reward") { echo 'active'; } ?>" href="<?=$settings['url']?>account/money/reward">
                <span class="iconBack <?php if($c == "reward") { echo 'iconCurrent'; } ?> text-center me-2 d-flex align-items-center justify-content-center">
                	<i class="fa fa-gift" style="color:<?php if($c == "reward") { echo 'white'; } ?>;margin-bottom:-3px;"></i>
                </span>
                <span class="nav-link-text ms-1">Rewards</span>
              </a>
            </li>
        <?php } ?>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link  <?php if($c == "offerwalls") { echo 'active'; } ?>" href="<?=$settings['url']?>account/money/offerwalls">
            <span class="iconBack <?php if($c == "offerwalls") { echo 'iconCurrent'; } ?> text-center me-2 d-flex align-items-center justify-content-center">
            	<i class="fa fa-asterisk" style="color:<?php if($c == "offerwalls") { echo 'white'; } ?>;margin-bottom:-3px;"></i>
            </span>
            <span class="nav-link-text ms-1">Offerwalls</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 mt-3 pt-3">
      <div class="card card-background shadow-none card-background-mask-warning" id="sidenavCard">
        <div class="full-background" style="background-image: url('<?php echo filter_var($settings['url']); ?>assets/wallet/img/curved-images/white-curved.jpeg')"></div>
        <div class="card-body text-left p-3 w-100">
          <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
            <i class="ni ni-headphones text-dark text-gradient text-lg top-0" aria-hidden="true" id="sidenavCardIcon"></i>
          </div>
          <h6 class="text-white up mb-0">Need help?</h6>
          <p></p>
          <a href="<?php echo filter_var($settings['url']); ?>account/supports" class="btn btn-white btn-sm w-100 mb-0">Contact Us</a>
        </div>
      </div>
    </div>
  </aside>