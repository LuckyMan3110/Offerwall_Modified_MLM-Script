<!DOCTYPE html>
<html lang="en">
<head>
    <?php if ($m["google_analytics"] == "1") { ?>
    <?= $settings['google_analytics_code'] ?>
    <?php } ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if($settings['favicon']) { ?>
		<link rel="icon" type="image/png" href="<?= $settings['url'].$settings['favicon'] ?>">
	<?php } else { ?>
		<link rel="icon" type="image/png" href="<?= $settings['url'] ?>assets/front/img/favicon.png">
	<?php } ?>
    <link rel="stylesheet" href="<?php echo filter_var($settings['url']); ?>assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?= $settings['url'] ?>assets/wallet/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= $settings['url'] ?>assets/wallet/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= $settings['url'] ?>assets/wallet/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="<?= $settings['url'] ?>assets/wallet/css/soft-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <title>
        <?php
		  
          $b = protect($_GET['b']);
          if($b == "summary") { echo filter_var($lang['title_summary']); } 
          elseif($b == "transaction") { echo filter_var($lang['title_transaction_details']); }
          elseif($b == "ref") { echo "Referrals"; }
          elseif($b == "settings") { echo filter_var($lang['title_account_settings']); } 
		  elseif($b == "supports") { echo "Support"; } 
          elseif($b == "money") {
              $c = protect($_GET['c']);
              if($c == "deposit") { echo filter_var($lang['title_deposit_money']); }
              elseif($c == "withdrawal") { echo filter_var($lang['title_withdrawal_funds']); }
			  elseif($c == "membership") { echo "Membership"; }
			  elseif($c == "chart") { echo "Earning Chart"; }
			  elseif($c == "reward") { echo "Claim Rewards"; }
			  elseif($c == "offerwalls") { echo "Offerwalls"; }
              else { }
           } else { }
          if($b == "activity") { echo filter_var($lang['title_activity']); } 
          elseif($b == "supports") { 
              if (isset($_GET['c'])) { 
              $c = protect($_GET['c']);
              if($c == "open") { echo 'Open Support Ticket'; }
              elseif($c == "close") { echo 'Close Support Ticket'; }
              elseif($c == "escalate") { echo 'Sended For Review'; }
              elseif($c == "dispute") { echo 'Support Ticket Details'; }
              elseif($c == "disputes") { echo 'Support Ticket'; }
              else { echo 'Support Ticket'; } }
          } else {}
         ?> - <?php echo filter_var($settings['name']); ?>
  </title>
  <meta name="description" content="<?php echo filter_var($settings['description']); ?>">
  <meta name="keywords" content="<?php echo filter_var($settings['keywords']); ?>">
</head>
<body class="g-sidenav-show  bg-gray-100">