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
<section class="homeSlider bg1">
	<div class="sliderBg">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<span class="subTitle1"><?=$lang["subTitle1"]?></span>
					<h2 class="head">
						<?=$lang["head"]?><span class="cfirst"> <?=$lang["cfirst"]?></span>.
					</h2>
					<p class="cgray">
						<?=$lang["cgray"]?>
					</p>
					<div class="flex ohomeslidFlex">
						<a href="/register" class="btn1 homeSlidBtn1 fw3"><?=$lang["btn1"]?></a>
						    &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="#about" class="btn2 homeSlidBtn1 fw3"><img src="assets/front/img/playImg.png" width="17px"> &nbsp;&nbsp;&nbsp;  <?=$lang["btn2"]?></a>
					</div>
					<div class="homeSlidSocial flex">
						<a href="<?= $social['facebook_profile']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
						<a href="<?= $social['twitter_profile']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
						<a href="<?= $social['instagram_profile']; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
						<a href="<?= $social['linkedin_profile']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="bigImg"></div>
				</div>
			</div>
		</div>
	</div> <!-- sliderBg -->
</section>
<section class="partnersCont">
	<div class="container">
		<div class="flex ai partflex jcb fwrap">
			
			<img src="assets/front/img/google.png">
			<img src="assets/front/img/fedex.png">
			<img src="assets/front/img/microsoft.png">
			<img src="assets/front/img/facebook.png">
			<img src="assets/front/img/linkedin.png">
			<img src="assets/front/img/twitter.png">
		</div>
	</div>
</section>
<section class="panel1">
	<div class="container">
		<div class="inner bg2">
			<div class="row">
				<div class="col-md-7">
					<h2 class="fs30 mb15">
						<?=$lang["mb15"]?>
					</h2>
					<p>
						<i class="fa fa-info-circle"></i> &nbsp; <?=$lang["circle"]?>
					</p>
				</div>
				<div class="col-md-3 col-md-offset-2">
					<a href="/register" class="btn3 inline fw3"><?=$lang["btn3"]?> &nbsp; <i class="fa fa-angle-right"></i></a>
				</div>
			</div>
		<!-- </div> inner -->
	</div>
</section>
<section class="servCont rel">
	<span class="dash abs"></span>
	<div class="container">
		<div class="row">
			
			<div class="col-md-4">
				<div class="servBox">
					<img src="assets/front/img/serv1.png">
					<h2><?=$lang["Sharing"]?></h2>
					<p>
						<?=$lang["Just"]?>
					</p>
					<a href="/login"><?=$lang["Learn"]?> &nbsp; <i class="fa fa-angle-right"></i></a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="servBox">
					<img src="assets/front/img/serv2.png">
					<h2><?=$lang["Time"]?></h2>
					<p>
						<?=$lang["concept"]?>
					</p>
					<a href="/login"><?=$lang["Learn"]?> &nbsp; <i class="fa fa-angle-right"></i></a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="servBox">
					<img src="assets/front/img/serv3.png">
					<h2><?=$lang["High"]?></h2>
					<p>
						<?=$lang["Invite"]?>
					</p>
					<a href="/login"><?=$lang["Learn"]?> &nbsp; <i class="fa fa-angle-right"></i></a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="servBox">
					<img src="assets/front/img/serv4.png">
					<h2><?=$lang["Upto"]?></h2>
					<p>
						<?=$lang["canearnupto"]?>
					<a href="/login"><?=$lang["Learn"]?> &nbsp; <i class="fa fa-angle-right"></i></a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="servBox">
					<img src="assets/front/img/serv5.png">
					<h2><?=$lang["Rewards"]?></h2>
					<p>
						<?=$lang["bonuses"]?>
					</p>
					<a href="/login"><?=$lang["Learn"]?> &nbsp; <i class="fa fa-angle-right"></i></a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="servBox servBox2 bg2">
					<h2 class="cwhite"><?=$lang["servBox2"]?></h2>
					<p class="cwhite">
						<?=$lang["cwhite"]?> </br><?=$lang["Journey"]?>
					</p>
					<br><br><br>
					<a href="/register"><img src="assets/front/img/arrow1.png"></a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="homeSec2" align="center" id="about">
	<div class="container">
		<div class="row">
			
			<div class="col-md-8 col-md-offset-2">
				<span class="subTitle1"><?=$lang["hw_it"]?></span>
				<h2 class="mb20 mt10 lh1">
					<?=$lang["your_earn"]?> <br> <?=$lang["new_stand"]?>
				</h2>
				<p>
					<?=$lang["simple_step"]?>
				</p>
			</div>
			<div class="col-md-12">
				<div class="row">
					
					<div class="col-md-4">
						<div class="block1">
							<div class="imger">
								<img src="assets/front/img/refs.png">
							</div>
							<h2><?=$lang["register_yourself"]?></h2>
							 <h2 class="cfirst"><?=$lang["text_acc"]?></h2>
							<p>
								<?=$lang["before_we_begin"]?>
							</p>
							<a href="/register" class="clicker"><?=$lang["btn1"]?></a>
						</div>
					</div> <!-- COL -->
					<div class="col-md-4">
						<div class="block1">
							<div class="imger">
								<img src="assets/front/img/refs2.png">
							</div>
							<h2><?=$lang["buy_member"]?></h2>
							 <h2 class="cfirst"><?=$lang["activation_refer"]?></h2>
							<p>
								<?=$lang["once_you"]?>
							</p>
							<a href="/account/money/membership" class="clicker"><?=$lang["buy_mem"]?></a>
						</div>
					</div> <!-- COL -->
					<div class="col-md-4">
						<div class="block1">
							<div class="imger">
								<img src="assets/front/img/info3.png">
							</div>
							<h2><?=$lang["refer_nd_earm"]?></h2>
							 <h2 class="cfirst"><?=$lang["refer_enj"]?></h2>
							<p>
								<?=$lang["refer_your_fri"]?>
							</p>
							<a href="/account/ref" class="clicker"><?=$lang["refer_a_fri"]?></a>
						</div>
					</div> <!-- COL -->
				</div> <!-- row -->
			</div>
		</div>
	</div>
</section>
<section class="contactCont rel">
	<div class="cityBack abs"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 sticky" id="contact">
				<h2 class="fs40 mb15">
					Get in <span class="cfirst">touch</span>
				</h2>
				<p class="cgray2">
					<?= $lang["contact_text"]; ?>
				</p>
				<br>
				<br>
				<?php
                $FormBTN = protect($_POST['send']);
                if($FormBTN == "message") {
                    $name = protect($_POST['name']);
                    $email = protect($_POST['email']);
                    $subject = protect($_POST['subject']);
                    $message = protect($_POST['message']);
                    if(empty($name) or empty($email) or empty($subject) or empty($message)) {
                        echo error($lang['error_20']);
                    } elseif(!isValidEmail($email)) {
                        echo error($lang['error_34']);
                    } else {
                        $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Host = $smtpconf["host"];
                        $mail->Port = $smtpconf["port"];
                        $mail->SMTPAuth = $smtpconf['SMTPAuth'];
                        $mail->Username = $smtpconf["user"];
                        $mail->Password = $smtpconf["pass"];
                        $mail->setFrom($email, $name);
                        if ($smtpconf["ssl"] == "1") {
                		    $mail->SMTPSecure = "ssl";
                		}
                        $mail->addAddress($settings['supportemail'], $settings['supportemail']);
                        //Set the subject line
                        $lang = array();
                        $mail->Subject = $subject;
                        $mail->msgHTML($message);
                        //Replace the plain text body with one created manually
                        $mail->AltBody = $message;
                        //Attach an image file
                        //send the message, check for errors
                        $send = $mail->send();
                        if($send) {
                            echo success("You Query has been received.");
                        } else {
                            echo error("Some thing is wrong.");
                        }
                    }
                }
                ?>
				<form action="" method="POST" autocomplete="off">
					<input type="text" name="name" placeholder="Full Name" class="inp1">
					<input type="emal" name="email" placeholder="Email Address" class="inp1">
					<input type="text" name="subject" placeholder="Subject" class="inp1">
					<textarea name="message" class="inp1 txtarea1" placeholder="Please explain your query here"></textarea>
					<button type="submit" name="send" value="message" class="sendBtn btn1 w100"><i class="fa fa-envelope"></i> &nbsp; Send Message</button>
				</form>
				<p class="cgray2 fs12 mt20">
					<i class="fa fa-info-circle"></i>
					&nbsp;&nbsp;
					<?=$lang["support_alter"]?>
				</p>
			</div> <!-- col -->
			<div class="col-md-6" id="faqs">
				<div class="inner">
					<h2 class="fs40 mb15">
						FAQ</span>
					</h2>
					<p class="cgray2">
						Frequently Asked Questions.
					</p>
					<br>
					<br>
					<div class="faqMainCont">
						<div class="faqBack">
							<div class="faqQuestion">
								<h2>How can I become a member?</h2>
								<i class="fa fa-angle-down"></i>
							</div>
							<p class="faqAnswer">
								Visit registration page and fill all the fields and click on register. Check your inbox to verify your account and you are done.
							</p>
						</div> <!-- faqBack -->
						<div class="faqBack">
							<div class="faqQuestion">
								<h2>How I can buy membership?</h2>
								<i class="fa fa-angle-down"></i>
							</div>
							<p class="faqAnswer">
								Login to your account, Head over to membership page and purchase one which will suit your need.
							</p>
						</div> <!-- faqBack -->
						<div class="faqBack">
							<div class="faqQuestion">
								<h2>Is there any limits of account?</h2>
								<i class="fa fa-angle-down"></i>
							</div>
							<p class="faqAnswer">
								No, You can register unlimited number of account.
							</p>
						</div> <!-- faqBack -->
						<div class="faqBack">
							<div class="faqQuestion">
								<h2>Is this trusted?</h2>
								<i class="fa fa-angle-down"></i>
							</div>
							<p class="faqAnswer">
								Yes, We are trusted and making payments to our users on daily basis.
							</p>
						</div> <!-- faqBack -->
						<div class="faqBack">
							<div class="faqQuestion">
								<h2>How can I contact support?</h2>
								<i class="fa fa-angle-down"></i>
							</div>
							<p class="faqAnswer">
								Fill the aside form and we will be back to you as soon as possible normally takes no more than 24 hours.
							</p>
						</div> <!-- faqBack -->
					</div> <!-- faqMainCont -->
					<br><br>
					<!--<a href="JavaScript:" class="cfirst">Read all FAQ&nbsp; <i class="fa fa-angle-right"></i></a>-->
				</div> <!-- inner -->
			</div> <!-- col -->
		</div>
	</div>
</section>
<section class="bg2 topFooter cwhite">
	<div class="container">
		<div class="row">
			
			<div class="col-md-3 m20">
				<h2 class="lh2 fs30">
					<?=$lang["ready_too"]?>
				</h2>
			</div>
			<div class="col-md-3 m20">
				<h3 class="fs20 mb20">
					<?=$lang["register_an_acc"]?>
				</h3>
				<p>
					<?=$lang["regis_free"]?>
				</p>
			</div>
			<div class="col-md-3 m20">
				<h3 class="fs20 mb20">
					<?=$lang["share_wait_earn"]?>
				</h3>
				<p>
					<?=$lang["activate_acc"]?>
				</p>
			</div>
			<div class="col-md-3">
				<a href="/register" class="btn3 inline fw3 w100"><?=$lang["join_now_us"]?> &nbsp; <i class="fa fa-angle-right"></i></a>
			</div>
		</div>
	</div>
</section>
<?php include("footer.php"); ?>