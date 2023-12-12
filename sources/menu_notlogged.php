<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
    <head>
    	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
          <?php
          // Get a current page and display different title for every page
          $a = protect($_GET['a']);
          if ($a == "login") { echo "Login - $settings[name]";
          } elseif ($a == "register") { echo "Register - $settings[name]";
          } elseif ($a == "password") { echo "Change Password - $settings[name]";
          } elseif ($a == "email_verify") { echo "Email Verification - $settings[name]";
          } elseif ($a == "contacts") { echo "Contact us - $settings[name]";
          } elseif ($a == "deposit") { echo "Payment Status - $settings[name]";
          } else {echo $settings['name'];}
          ?>
           
        </title>
        <meta name="description" content="<?=$settings['description']?>">
        <meta name="keywords" content="<?=$settings['keywords']?>">
        <script src="https://use.fontawesome.com/32efc5ddb7.js"></script>
    	<link rel="stylesheet" type="text/css" href="<?= $settings['url'] ?>assets/front/css/slick.css"/>
    	<link rel="stylesheet" type="text/css" href="<?= $settings['url'] ?>assets/front/css/slick-theme.min.css"/>
    	<link rel="stylesheet" type="text/css" href="<?= $settings['url'] ?>assets/front/css/bootstrap.min.css">
    	<link rel="stylesheet" type="text/css" href="<?= $settings['url'] ?>assets/front/css/custom_styles.css">
    	<script src="<?= $settings['url'] ?>assets/front/js/jquery.min.js"></script>
    	<script src="<?= $settings['url'] ?>assets/front/js/slick.min.js"></script>
    	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600;700&display=swap" rel="stylesheet">
        <?php if($settings['favicon']) { ?>
    		<link rel="icon" type="image/png" href="<?= $settings['url'].$settings['favicon'] ?>">
    	<?php } else { ?>
    		<link rel="icon" type="image/png" href="<?= $settings['url'] ?>assets/front/img/favicon.png">
    	<?php } ?>
    	<?php if ($m["google_analytics"] == "1") { ?>
        <?= $settings['google_analytics_code'] ?>
        <?php } ?>
    </head>
    <body>
        <section class="header tac">
        	<div class="container">
        		<div class="bars block992 us pointer abs">
        			<span></span>
        			<span></span>
        			<span></span>
        		</div>
        		<div class="row">
        			<div class="col-md-3">
        				<a href="<?= $settings['url']; ?>">
        				    <?php if($settings['white_logo']) { ?>
                    			<img src="<?= $settings['url'].$settings['white_logo'] ?>" class="logo-main">
                    		<?php } else { ?>
                    			<img src="<?= $settings['url']; ?>assets/front/img/logo-main.png" class="logo-main">
                    		<?php } ?>
        				</a>
        			</div>
        			<div class="col-md-6">
        				<ul class="mainUl">
        					<li><a href="<?= $settings['url']; ?>" class="main-link active"><?=$lang["home"]?></a></li>
        					<li><a href="<?= $settings['url']; ?>#about" class="main-link"><?=$lang["how_we_work"]?></a></li>
        					<!--
        					<li class="dropdownLi">
        						<a href="#" class="main-link dropdown_a"> INFORMATION&nbsp; <i class="fa fa-angle-down"></i> </a>
        						<ul class="dropdownUl">
        							<li><a href="#">How we work</a></li>
        							<li><a href="#">Referral programs</a></li>
        						</ul>
        					</li>
        					-->
        					<li><a href="<?= $settings['url']; ?>#contact" class="main-link"><?=$lang["title_contacts"]?></a></li>
        					<li><a href="<?= $settings['url']; ?>#faq" class="main-link"><?=$lang["faqs"]?></a></li>
        					
        					<li class="dropdownLi">
                                <a class="main-link dropdown_a" href="#"><i class="fa fa-globe"></i> <?=$_COOKIE['lang']?></a>
                                <ul class="dropdownUl">
                                    <?=getLanguage($settings['url'],null,1);?>
                                </ul>
                            </li>
        				</ul>
        			</div>
        			<?php if(!checkSession()) { ?>
        			<div class="col-md-3">
        				<div class="flex headBtnFlex">
        					<a href="<?= $settings['url'] ?>login" class="headbtn headbtn1 btn1"><?= $lang['menu_login'] ?></a>
        					&nbsp;&nbsp;&nbsp;
        					<a href="<?= $settings['url'] ?>register" class="headbtn headbtn2 btn2"><?= $lang['menu_register'] ?></a>
        				</div>
        			</div>
        			<?php } ?>
            		<?php if(checkSession()) { ?>
            		<div class="col-md-3">
        				<div class="flex headBtnFlex">
        					<a href="<?= $settings['url']; ?>account/summary" class="headbtn headbtn1 btn1"><?= $lang['title_summary'] ?></a>
        					&nbsp;&nbsp;&nbsp;
        					<a href="<?= $settings['url']; ?>logout" class="headbtn headbtn2 btn2"><?= $lang['log_out'] ?></a>
        				</div>
        			</div>
            		<?php } ?>
        		</div>
        	</div>
        </section>