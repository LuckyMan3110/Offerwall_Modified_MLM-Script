<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
?>
<?php include("menu_notlogged.php"); ?>
        <section class="loginPage regPage">
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-md-8 col-md-offset-2 pad0">
        				
        				<div class="logCont">
        					<div class="flex logFlex">
        						<div class="logRight">
        							
        							<?php
                            		if ($m["registration"] !== "1") {
                                        echo error("Registration is OFF Currently, Please contact support.");
                                    } else {
                            			
                            		if(isset($_POST['register'])) {
                            			$FormBTN = protect($_POST['register']);
                                    
                                    if($FormBTN == "reg") {
                                        $first_name = protect($_POST['first_name']);
                                        $last_name = protect($_POST['last_name']);
                                        $email = protect($_POST['email']);
                                        $password = protect($_POST['password']);
                                        $cpassword = protect($_POST['cpassword']);
                                        //$country = protect($_POST['country']);
                                        //$city = protect($_POST['city']);
                                        //$zip_code = protect($_POST['zip_code']);
                                        //$address = protect($_POST['address']);
                                        $ref = protect($_POST['ref']);
                                        if($ref == ""){
                                            $ref = 0;
                                        }
                                        
                                        $account_type = 1; // 1= personal, 2=business
                                        $recaptcha_response = protect($_POST['g-recaptcha-response']);
                                        $accept_tou = protect($_POST['accept_tou']);
                                        if($accept_tou == "yes") { $accept_tou = '1'; } else { $accept_tou = '0'; }
                                        if(empty($first_name) or empty($last_name) or empty($account_type) or empty($email) or empty($password) or empty($cpassword)) {
                                            echo error($lang['error_20']);
                                        } elseif(!isValidEmail($email)) {
                                            echo error($lang['error_45']);
                                        } elseif($settings['enable_recaptcha'] == "1" && !VerifyGoogleRecaptcha($recaptcha_response)) {
                                            echo error($lang['error_52']);  
                                        } elseif(CheckUser($email)==true) {
                                            echo error($lang['error_46']);
                                        } elseif(strlen($password)<8) { 
                                            echo error($lang['error_47']);
                                        } elseif($password !== $cpassword) {
                                            echo error($lang['error_48']);
                                        } elseif($accept_tou==0) {
                                            echo error($lang['error_49']);
                                        } else {
                                            $password = password_hash($password, PASSWORD_DEFAULT);
                                            $ip = $_SERVER['REMOTE_ADDR'];
                                            $time = time();
                                            
                                            
                                            
                                            if( !empty($ref) or $ref !== "" or $ref !== "0") {
                                                $ref1 = $ref;
                                                if ($ref1) {
                                                    if(!empty($ref1)) {
                                                        if($ref1 > 0){
                                                            $ref1_check = $db->query("SELECT * FROM users WHERE id='$ref1'");
                                                            if($ref1_check->num_rows>0) {
                                                                $ref1_exe = $ref1_check->fetch_assoc();
                                                                if($ref1_exe['ref1'] > 0){
                                                                    $ref2 = $ref1_exe['ref1'];  //ref2
                                                                    if ($ref2) {
                                                                        $ref2_check = $db->query("SELECT * FROM users WHERE id='$ref2'");
                                                                        if($ref2_check->num_rows>0) {
                                                                            $ref2_exe = $ref2_check->fetch_assoc();
                                                                            if($ref2_exe['ref1'] > 0) {
                                                                                $ref3 = $ref2_exe['ref1'];   //ref3
                                                                                if ($ref3) {
                                                                                    $ref3_check = $db->query("SELECT * FROM users WHERE id='$ref3'");
                                                                                    if($ref3_check->num_rows>0) {
                                                                                        $ref3_exe = $ref3_check->fetch_assoc();
                                                                                        if($ref3_exe['ref1'] > 0) {
                                                                                            $ref4 = $ref3_exe['ref1'];   //ref4
                                                                                            if ($ref4) {
                                                                                                $ref4_check = $db->query("SELECT * FROM users WHERE id='$ref4'");
                                                                                                if($ref4_check->num_rows>0) {
                                                                                                    $ref4_exe = $ref4_check->fetch_assoc();
                                                                                                    if($ref4_exe['ref1'] > 0) {
                                                                                                        $ref5 = $ref4_exe['ref1'];   //ref5
                                                                                                        if ($ref5) {
                                                                                                            $ref5_check = $db->query("SELECT * FROM users WHERE id='$ref5'");
                                                                                                            if($ref5_check->num_rows>0) {
                                                                                                                $ref5_exe = $ref5_check->fetch_assoc();
                                                                                                                if($ref5_exe['ref1'] > 0) {
                                                                                                                    $ref6 = $ref5_exe['ref1'];   //ref6
                                                                                                                    if ($ref6) {
                                                                                                                        $ref6_check = $db->query("SELECT * FROM users WHERE id='$ref6'");
                                                                                                                        if($ref6_check->num_rows>0) {
                                                                                                                            $ref6_exe = $ref6_check->fetch_assoc();
                                                                                                                            if($ref6_exe['ref1'] > 0) {
                                                                                                                                $ref7 = $ref6_exe['ref1'];   //ref7
                                                                                                                                if ($ref7) {
                                                                                                                                    $ref7_check = $db->query("SELECT * FROM users WHERE id='$ref7'");
                                                                                                                                    if($ref7_check->num_rows>0) {
                                                                                                                                        $ref7_exe = $ref7_check->fetch_assoc();
                                                                                                                                        if($ref7_exe['ref1'] > 0) {
                                                                                                                                            $ref8 = $ref7_exe['ref1'];   //ref8
                                                                                                                                            if ($ref8) {
                                                                                                                                                $ref8_check = $db->query("SELECT * FROM users WHERE id='$ref8'");
                                                                                                                                                if($ref8_check->num_rows>0) {
                                                                                                                                                    $ref8_exe = $ref8_check->fetch_assoc();
                                                                                                                                                    if($ref8_exe['ref1'] > 0) {
                                                                                                                                                        $ref9 = $ref8_exe['ref1'];   //ref9
                                                                                                                                                        if ($ref9) {
                                                                                                                                                            $ref9_check = $db->query("SELECT * FROM users WHERE id='$ref9'");
                                                                                                                                                            if($ref9_check->num_rows>0) {
                                                                                                                                                                $ref9_exe = $ref9_check->fetch_assoc();
                                                                                                                                                                if($ref9_exe['ref1'] > 0) {
                                                                                                                                                                    $ref10 = $ref8_exe['ref1'];   //ref10
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } 
                                                }
                                            }
                                            
                                            $insert = $db->query("INSERT users (password,email,email_verified,status,account_type,ip,signup_time,first_name,last_name,ref1) VALUES ('$password','$email','1','1','$account_type','$ip','$time','$first_name','$last_name','$ref')");
                                            $GetU = $db->query("SELECT * FROM users WHERE email='$email'");
                                            $gu = $GetU->fetch_assoc();
                                            $insert = $db->query("INSERT users_wallets (uid,amount,currency) VALUES ('$gu[id]','0','$settings[default_currency]')");
                                            
                                            if ($ref2){
                                                $update = $db->query("UPDATE users SET ref2='$ref2' WHERE email='$email'");
                                            }
                                            if($ref3) {
                                                $update = $db->query("UPDATE users SET ref3='$ref3' WHERE email='$email'");
                                            }
                                            if($ref4) {
                                                $update = $db->query("UPDATE users SET ref4='$ref4' WHERE email='$email'");
                                            }
                                            if($ref4) {
                                                $update = $db->query("UPDATE users SET ref4='$ref4' WHERE email='$email'");
                                            }
                                            if($ref5) {
                                                $update = $db->query("UPDATE users SET ref5='$ref5' WHERE email='$email'");
                                            }
                                            if($ref6) {
                                                $update = $db->query("UPDATE users SET ref6='$ref6' WHERE email='$email'");
                                            }
                                            if($ref7) {
                                                $update = $db->query("UPDATE users SET ref7='$ref7' WHERE email='$email'");
                                            }
                                            if($ref8) {
                                                $update = $db->query("UPDATE users SET ref8='$ref8' WHERE email='$email'");
                                            }
                                            if($ref9) {
                                                $update = $db->query("UPDATE users SET ref9='$ref9' WHERE email='$email'");
                                            }
                                            if($ref10) {
                                                $update = $db->query("UPDATE users SET ref10='$ref10' WHERE email='$email'");
                                            }
                                                
                                            if($settings['require_email_verify'] == "1") {
                                                $email_hash = randomHash(25);
                                                $update = $db->query("UPDATE users SET status='2',email_hash='$email_hash',email_verified='0' WHERE email='$email'");
                                                EmailSys_Send_Email_Verification($email);
                                                echo success($lang['success_22']);
                                            } else {
                                                echo success($lang['success_23']);
                                            }
                                        }
                                    }
                            		}
                                    ?>
        							
        							<form method="POST" action="">
        							    <input type="hidden" class="form-control" name="ref" value="<?php echo $_COOKIE['ref']; ?>">
        								<h2 class="head"><?=$lang["free_reg_us"]?></h2>
        								<p class="cgray fs13"><?=$lang["community_part"]?></p>
        								<br>
        								<input type="text" name="first_name" class="inp2" placeholder="<?=$lang['field_11']?>" required>
        								<input type="text" name="last_name" class="inp2" placeholder="<?=$lang['field_12']?>" required>
        								<input type="email" name="email" class="inp2" placeholder="<?=$lang['field_25']?>" required>
        								<input type="password" name="password" class="inp2 cfirst" placeholder="<?=$lang['field_29']?>" required>
        								<input type="password" name="cpassword" class="inp2 cfirst" placeholder="<?=$lang['field_30']?>" required>
        								<label class="flex fw2 fs14 us pointer">
        									<input type="checkbox" name="accept_tou" value="yes" class="check2" required> &nbsp;&nbsp;&nbsp;
        									<p><?=$lang["agereed"]?> <a href="#">Terms & conditions</a></p>
        								</label>
        								<?php if($settings['enable_recaptcha'] == "1") { ?>
                                        <br>
                                        <center><script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                        <div class="g-recaptcha" data-sitekey="<?=$settings['recaptcha_publickey']?>"></div></center>
                                        <br>
                                        <?php } ?>
        								<button type="submit" name="register" value="reg" class="btn2 fw3 w100 logBtn"><?=$lang['btn_28']?> &nbsp; <i class="fa fa-angle-right"></i></button>
        								<!--
        								<hr style="border-color: #d5d5d5;">
        								<a href="#" class="logSpecBtn fbBtn">
        									<i class="fa fa-facebook"></i>
        									Join with facebook
        								</a>
        								<a href="#" class="logSpecBtn gBtn">
        									<i class="fa fa-google-plus"></i>
        									Join with google
        								</a>
        								-->
        							</form>
        							
        							<?php } ?>
        						</div> <!-- logRight -->
        						
        						<div class="logLeft tac">
        							<div class="inner cwhite">
        								<img src="assets/front/img/regLogImg.png" class="regLogImg">
        								<div class="cont">
        									<h2 class="fs24 mb10"><?=$lang["already_member_s"]?></h2>
        									<p class="fs13 mb20">
        										<?=$lang["already_an_acc"]?>.
        									</p>
        									<a href="/login" class="btn2 br5 fs13 mt10 logMiniBtn inline"><?=$lang["log_in_now"]?></a>
        								</div>							
        								<br>
        								<br>
        								<div class="flex jc992">
        									<a href="#"><?= $lang['terms_of_use']; ?></a>
        									<a href="#"><?= $lang['privacy_policy']; ?></a>
        									<a href="/#faqs"><?=$lang["faqs"]?></a>
        								</div>
        							</div>
        						</div> <!-- logLeft -->
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
<?php include("footer.php"); ?>