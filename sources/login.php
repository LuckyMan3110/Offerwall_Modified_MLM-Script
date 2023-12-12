<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
if(checkSession()) {
    $redirect = $settings['url']."account/summary";
    header("Location: $redirect");
}
if(isset($_GET['type'])) {
        $type = protect($_GET['type']);


if($type == "auth") {
$auth_id = $_SESSION['auth_uid'];
$query = $db->query("SELECT * FROM users WHERE id='$auth_id'");
if($query->num_rows==0) { 
    $redirect = $settings['url']."login";
    header("Location: $redirect");
}
$u = $query->fetch_assoc();
$ga 		= new GoogleAuthenticator();
$qrCodeUrl 	= $ga->getQRCodeGoogleUrl(idinfo($_SESSION['auth_uid'],"email"), $_SESSION['secret'], $settings['name']);
?>
<!DOCTYPE html>
<html>
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Two Factor Auth - <?= $settings['name']; ?></title>
    <meta name="description" content="<?= $settings['description']; ?>">
    <meta name="keywords" content="<?php echo filter_var($settings['keywords'], FILTER_SANITIZE_STRING); ?>">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../assets/new/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../assets/new/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/new/dist/css/adminlte.min.css">
    <?php if($settings['favicon']) { ?>
		<link rel="icon" type="image/png" href="<?= $settings['url'].$settings['favicon'] ?>">
	<?php } else { ?>
		<link rel="icon" type="image/png" href="<?= $settings['url'] ?>assets/logo/favicon.png">
	<?php } ?>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="<?php echo filter_var($settings['url'], FILTER_SANITIZE_STRING); ?>" class="h1"><b><?php echo filter_var($settings['name'], FILTER_SANITIZE_STRING); ?></b></a>
        </div>
        <div class="card-body">
          <p class="login-box-msg"><?php echo filter_var($lang['title_2fa'], FILTER_SANITIZE_STRING); ?></p>
          <?php
            $FormBTN = protect($_POST['auth']);
            if($FormBTN == "auth") {
                $code = protect($_POST['code']);
                $checkResult = $ga->verifyCode($_SESSION['secret'], $code, 2);    // 2 = 2*30sec clock tolerance
                if($checkResult) {
                            $_SESSION['auth_code'] = false;
                            $_SESSION['auth_id'] = false;
                            $_SESSION['uid'] = $u['id'];
                            if(protect($_POST['remember_me']) == "yes") {
                                setcookie("prowall_uid", $u['id'], time() + (86400 * 30), '/'); // 86400 = 1 day
                            }
                            $last_login = $login['last_login']+5000;
                            if(time() > $last_login) {
                                $time = time();
                                $update = $db->query("UPDATE users SET last_login='$time' WHERE id='$u[id]'");
                            }
                            $time = time();
                            $login_ip = $_SERVER['REMOTE_ADDR'];
                            $insert = $db->query("INSERT users_logs (uid,type,time,u_field_1) VALUES ('$u[id]','1','$time','$login_ip')");
                            if($_SESSION['payorder_url']) {
                                $redirect = $_SESSION['payorder_url'];
                                header("Location: $redirect");
                            } else {
                                $redirect = $settings['url']."account/summary";
                                header("Location: $redirect");
                            }
                } else {
                    echo error($lang['error_51']);
                }
            } 
          ?>
          <form action="" method="post">
            <div class="input-group mb-3">
              <input class="form-control" type="email" disabled value="<?php echo filter_var($u['email'], FILTER_SANITIZE_STRING); ?>" name="email" placeholder="<?php echo filter_var($lang['placeholder_3'], FILTER_SANITIZE_STRING); ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input class="form-control" type="text" name="code" placeholder="<?php echo filter_var($lang['placeholder_12'], FILTER_SANITIZE_STRING); ?>" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-vr-cardboard"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" name="auth" value="auth" class="btn btn-primary btn-block"><?php echo filter_var($lang['btn_29'], FILTER_SANITIZE_STRING); ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
                            
    <script src="../../assets/new/plugins/jquery/jquery.min.js"></script>
    <script src="../../assets/new/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/new/dist/js/adminlte.min.js"></script>
</body>
</html>

  
<?php
} 
} else {
?>
<?php include("menu_notlogged.php"); ?>

<section class="loginPage">
	<div class="container">
		<div class="row">
			
			<div class="col-md-8 col-md-offset-2 pad0">
				
				<div class="logCont">
					<div class="flex logFlex">
						<div class="logLeft tac">
							<div class="inner cwhite">
								<div class="cont">
									<h2 class=" fs24 mb10"><?=$lang["not_a_mem"]?></h2>
									<p class=" fs13 mb20">
										<?=$lang["want_to_reg"]?>
									</p>
									<a href="/register" class="btn1 br5 fs13 mt10 logMiniBtn inline"><?=$lang["jn_for_free"]?></a>
								</div>							
								<img src="assets/front/img/logimg.png" class="logimg">
								<div class="flex jc992">
									<a href="/"><?= $lang['terms_of_use']; ?></a>
									<a href="/"><?= $lang['privacy_policy']; ?></a>
									<a href="/#faqs"><?=$lang["faqs"]?></a>
								</div>
							</div>
						</div> <!-- logLeft -->
						<div class="logRight">
							<?php
                    		if(isset($_POST['login'])) {
                    			$FormBTN = protect($_POST['login']);
                    		
                            
                            if($FormBTN == "login") {
                                $email = protect($_POST['email']);
                                $password = protect($_POST['password']);
                    			if(isset($_POST['g-recaptcha-response'])) {
                    			$recaptcha_response = protect($_POST['g-recaptcha-response']);
                                }
                                $CheckLogin = $db->query("SELECT * FROM users WHERE email='$email'");
                                if(empty($email) or empty($password)) { 
                                    echo error($lang['error_36']);
                                } elseif($CheckLogin->num_rows==0) {
                                    echo error($lang['error_37']);
                                } elseif($settings['enable_recaptcha'] == "1" && !VerifyGoogleRecaptcha($recaptcha_response)) {
                                    echo error($lang['error_52']);  
                                } else {
                                    $login = $CheckLogin->fetch_assoc();
                                    if(password_verify($password, $login['password'])) {
                                    
                                        if($login['status'] == "11") {
                                            echo error($lang['error_38']);
                                        } else {
                                            if($login['2fa_auth'] == "1" && $login['2fa_auth_login'] == "1") {
                                                $_SESSION['auth_uid'] = $login['id'];
                                                $_SESSION['secret'] = $login['googlecode'];
                                                $_SESSION['auth_code'] = strtoupper(randomHash(7));
                                                $redirect = $settings['url']."login/auth";
                                                header("Location: $redirect");
                                            } else {
                                                $_SESSION['uid'] = $login['id'];
                    							if(isset($_POST['remember_me'])) {
                    								if(protect($_POST['remember_me']) == "yes") {
                                                    setcookie("prowall_uid", $login['id'], time() + (86400 * 30), '/'); // 86400 = 1 day
                    								}
                    							}
                                                
                                                $last_login = $login['last_login']+5000;
                                                if(time() > $last_login) {
                                                    $time = time();
                                                    $update = $db->query("UPDATE users SET last_login='$time' WHERE id='$login[id]'");
                                                }
                                                $time = time();
                                                $login_ip = $_SERVER['REMOTE_ADDR'];
                                                $insert = $db->query("INSERT users_logs (uid,type,time,u_field_1) VALUES ('$login[id]','1','$time','$login_ip')");
                                                EmailSys_loginNotification($email,$login_ip);
                                                if($_SESSION['payorder_url']) {
                                                    $redirect = $_SESSION['payorder_url'];
                                                    header("Location: $redirect");   
                                                } else {
                                                    $redirect = $settings['url']."account/summary";
                                                    header("Location: $redirect");
                                                }
                                            }
                                        }
                                    } else {
                                        echo error($lang['error_37']);
                                    }
                                }
                            }
                    		}
                            ?>
							<form action="" method="POST" autocomplete="off">
								<h2 class="head"><?=$lang["menu_login"]?></h2>
								<p class="cgray fs13"><?=$lang["refer_wait_text"]?></p>
								<br>
								<input type="email" name="email" placeholder="<?=$lang['placeholder_3']?>" class="inp2">
								<input type="password" name="password" placeholder="<?=$lang['placeholder_11']?>" class="inp2 cfirst">
								<div class="flex ai jcb fs13">
									<label class="flex fw2">
										<input type="checkbox" name="remember_me" value="yes" class="check2">
										&nbsp;&nbsp;
										<?=$lang['remember_me']?>
									</label>
									<?php if ($m["forget_password"] == "1") { ?><a href="<?= $settings['url'] ?>password/reset" class="fs13"><?= $lang['forgot_password'] ?></a><?php } ?>
								</div>
								<?php if($settings['enable_recaptcha'] == "1") { ?>
                                <br>
                                <center><script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                <div class="g-recaptcha" data-sitekey="<?=$settings['recaptcha_publickey']?>"></div></center>
                                <br>
                                <?php } ?>
            
								<button type="submit" name="login" value="login" class="btn1 fw3 w100 logBtn"><?=$lang['btn_27']?> &nbsp; <i class="fa fa-angle-right"></i></button>
								<!--
								<hr style="border-color: #d5d5d5;">
								<a href="javascript:" class="logSpecBtn fbBtn">
									<i class="fa fa-facebook"></i>
									Login with facebook
								</a>
								<a href="javascript:" class="logSpecBtn gBtn">
									<i class="fa fa-google-plus"></i>
									Login with google
								</a>
								-->
							</form>
						</div> <!-- logRight -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include("footer.php"); ?>    
<?php
}
?>