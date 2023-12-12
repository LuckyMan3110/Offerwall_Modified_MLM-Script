<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
if(isset($_GET['a'])) {
$a = protect($_GET['a']);
}
if(isset($_GET['b'])) {
$b = protect($_GET['b']);
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel - <?=$settings['name']?></title>
    <meta name="description" content="Control Panel - <?= $settings['name']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/codemirror/theme/monokai.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/simplemde/simplemde.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= $settings['url'] ?>assets/new/plugins/daterangepicker/daterangepicker.css">
    
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background:#51D8C9;">
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="https://s3.envato.com/files/335098119/80px.png" alt="AdminLTELogo" height="60" width="60">
    </div>
    
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <span class="badge badge-primary"><i class="fa fa-pencil"></i> Version <?= $version ?></span>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
    </nav>
  <!-- /.navbar -->
    
    
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:#003731;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <center><span class="brand-text font-weight-light">Admin Panel</span></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://s3.envato.com/files/335098119/80px.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="./?a=users&b=edit&id=<?php echo filter_var($_SESSION['admin_uid'], FILTER_SANITIZE_STRING); ?>" class="d-block"><?php echo idinfo($_SESSION['admin_uid'],"account_user"); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item <?php if ($a == "") { echo "menu-open"; } ?>">
                <a href="./" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item <?php if ($a == "users" or $a == "languages" or $a == "update_logo") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>Manage User<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./?a=users" class="nav-link <?php if ($a == "users") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Users</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=languages" class="nav-link <?php if ($a == "languages" and $b == "") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage Languages</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=languages&b=add" class="nav-link <?php if ($a == "languages" and $b == "add") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Languages</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=update_logo" class="nav-link <?php if ($a == "update_logo") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Update Logo</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item <?php if ($a == "deposits" or $a == "deposit_methods" or $a == "manual_deposit") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clinic-medical"></i>
                  <p>Manage Deposits<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./?a=deposits" class="nav-link <?php if ($a == "deposits" and $b == "" or $a == "deposits" and $b == "view") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Deposits</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=deposit_methods" class="nav-link <?php if ($a == "deposit_methods" and $b == "" or $a == "deposit_methods" and $b == "edit" or $a == "deposit_methods" and $b == "delete") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Deposit Methods</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=deposit_methods&b=add" class="nav-link <?php if ($a == "deposit_methods" and $b == "add") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Auto Method</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=manual_deposit" class="nav-link <?php if ($a == "manual_deposit" and $b == "" or $a == "manual_deposit" and $b == "edit" or $a == "manual_deposit" and $b == "delete") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manual Method</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=manual_deposit&b=add" class="nav-link <?php if ($a == "manual_deposit" and $b == "add") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Manual Method</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item <?php if ($a == "withdrawals" or $a == "withdrawal_methods") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Manage Withdraws<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./?a=withdrawals" class="nav-link <?php if ($a == "withdrawals" and $b == "" or $a == "withdrawals" and $b == "view") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Withdraw</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=withdrawal_methods" class="nav-link <?php if ($a == "withdrawal_methods" and $b == "" or $a == "withdrawal_methods" and $b == "edit" or $a == "withdrawal_methods" and $b == "delete") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Withdrawal Methods</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=withdrawal_methods&b=add" class="nav-link <?php if ($a == "withdrawal_methods" and $b == "add") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Method</p>
                    </a>
                  </li>
                </ul>
            </li>
            
            <li class="nav-item <?php if ($a == "ref") { echo "menu-open"; } ?>">
                <a href="./?a=ref" class="nav-link">
                  <i class="nav-icon fas fa-chalkboard-teacher"></i>
                  <p>Manage Referrals</p>
                </a>
            </li>
			<li class="nav-item <?php if ($a == "referral_config" or $a == "membership_log") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-holly-berry"></i>
                  <p>Manage Membership<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./?a=referral_config" class="nav-link <?php if ($a == "referral_config") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Membership</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=membership_log" class="nav-link <?php if ($a == "membership_log") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Membership Logs</p>
                    </a>
                  </li>
                </ul>
            </li>
            
            <li class="nav-item <?php if ($a == "reward" or $a == "reward_log") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-gift"></i>
                  <p>Manage Rewards<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./?a=reward" class="nav-link <?php if ($a == "reward") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Rewards</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=reward_log" class="nav-link <?php if ($a == "reward_log") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Rewards Logs</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item <?php if ($a == "offerwalls" or $a == "offerwalls_setting") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-asterisk"></i>
                  <p>Offerwalls<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./?a=offerwalls" class="nav-link <?php if ($a == "offerwalls") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Logs</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=offerwalls_setting" class="nav-link <?php if ($a == "offerwalls_setting") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Config</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item <?php if ($a == "support") { echo "menu-open"; } ?>">
                <a href="./?a=support" class="nav-link">
                  <i class="nav-icon fas fa-headset"></i>
                  <p>Support Tickets</p>
                  <span class="right badge badge-danger"><?php $query = $db->query("SELECT * FROM support WHERE status=1"); echo filter_var($query->num_rows, FILTER_SANITIZE_STRING); ?></span>
                </a>
            </li>
            <li class="nav-item <?php if ($a == "module") { echo "menu-open"; } ?>">
                <a href="./?a=module" class="nav-link">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>Modules</p>
                </a>
            </li>
            <li class="nav-item <?php if ($a == "live_chat") { echo "menu-open"; } ?>">
                <a href="./?a=live_chat" class="nav-link">
                  <i class="nav-icon fas fa-crow"></i>
                  <p>Live Chat</p>
                </a>
            </li>
            <li class="nav-item <?php if ($a == "google_analytics") { echo "menu-open"; } ?>">
                <a href="./?a=google_analytics" class="nav-link">
                  <i class="nav-icon fas fa-chart-bar"></i>
                  <p>Google Analytics</p>
                </a>
            </li>
            <li class="nav-item <?php if ($a == "send_mail") { echo "menu-open"; } ?>">
                <a href="./?a=send_mail" class="nav-link">
                  <i class="nav-icon fas fa-mail-bulk"></i>
                  <p>Send Email</p>
                </a>
            </li>
            <li class="nav-item <?php if ($a == "country") { echo "menu-open"; } ?>">
                <a href="./?a=country" class="nav-link">
                  <i class="nav-icon fas fa-globe"></i>
                  <p>Manage Countries</p>
                </a>
            </li>
            <li class="nav-item <?php if ($a == "settings" or $a == "smtp_settings" or $a == "admin_profits" or $a == "admin_profits_logs") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>Admin Management<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./?a=settings" class="nav-link <?php if ($a == "settings" and $b == "") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Site Settings</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=smtp_settings" class="nav-link <?php if ($a == "smtp_settings" and $b == "") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mail Settings</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=admin_profits" class="nav-link <?php if ($a == "admin_profits" and $b == "") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Profit</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./?a=admin_profits_logs" class="nav-link <?php if ($a == "admin_profits_logs" and $b == "") { echo "active"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Profit Logs</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="./?a=logout" class="nav-link">
                  <i class="nav-icon fas fa-ban"></i>
                  <p>Logout</p>
                </a>
            </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
   <div class="content-wrapper" style="background:#51D8C9;">
        <br>
        <div class="content mt-3">