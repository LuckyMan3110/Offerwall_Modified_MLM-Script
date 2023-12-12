    <section class="footer padder1">
    	<div class="container">
    		<div class="row">
				<div class="col-md-4 m20">
					<a href="/"><img src="assets/front/img/whiteLogo.png" class="footLogo"></a>
					<br><br>
					<p><?=$lang["footer_text"]?></p>
					<br>
					<p class="fs13"><?= $lang['all_right_reserved']; ?>. Copyright © <script> document.write(new Date().getFullYear()) </script> Developed by </br><a href="<?=$settings['url'] ?>" target="_blank" class="text-white"><?=$settings['name']; ?></a>.</p>
				</div>
				<div class="col-md-2 col-md-offset-2">
					<ul class="footLinks">
						<li><h2 class="footHead"><?=$lang["General"]?></h2></li>
						<li><a href="/"><?=$lang["home"]?></a></li>
						<li><a href="#about"><?=$lang["how_we_work"]?></a></li>
						<li><a href="/login"><?=$lang["menu_login"]?></a></li>
					</ul>
				</div>
				<div class="col-md-2">
					<ul class="footLinks">
						<li><h2 class="footHead"><?=$lang["Resources"]?></h2></li>
						<li><a href="<?=$settings['url'] ?>#contact"><?=$lang["title_contacts"]?></a></li>
						<li><a href="<?=$settings['url'] ?>#faqs"><?=$lang["faqs"]?></a></li>
						<li><a href="/register"><?=$lang["menu_register"]?></a></li>
					</ul>
				</div>
				<div class="col-md-2">
					<ul class="footLinks">
						<li><h2 class="footHead"><?=$lang["legal"]?></h2></li>
						<li><a href="/"><?= $lang['terms_of_use']; ?></a></li>
						<li><a href="/"><?= $lang['privacy_policy']; ?></a></li>
					</ul>
				</div>
    		</div>
    	</div>
    </section>
    
    <section class="bottomFoot">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-4 m20">
    				<a href="mailto:<?= $settings['supportemail']; ?>" ><i class="fa fa-envelope"></i><?= $settings['supportemail']; ?></a>
    			</div>
    			<div class="col-md-2 col-md-offset-6">
    				<div class="footSocial flex m20 ai">
						<a href="<?= $social['facebook_profile']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
						<a href="<?= $social['twitter_profile']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
						<a href="<?= $social['instagram_profile']; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
						<a href="<?= $social['linkedin_profile']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
						<a href="mailto:<?= $settings['supportemail']; ?>" target="_blank"><i class="fa fa-envelope"></i></a>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
    
    <script type="text/javascript">
        $(document).ready(function(){
        $(window).scroll(function(){
          var sticky = $('.header'),
              scroll = $(window).scrollTop();
          if (scroll >= 100) sticky.addClass('fixedHead');
          else sticky.removeClass('fixedHead');
        });
        $(".faqQuestion").click(function(){
        	$(this).parent().children(".faqAnswer").slideToggle();
        	$(this).parent().toggleClass("activeFaq");
        });
        $(".dropdown_a").click(function(){
        	$(this).parent().children(".dropdownUl").fadeToggle();
        });
        $(document).mouseup(function(e) {
            var container = $(".dropdownUl, .dropdown_a"); if (!container.is(e.target) && container.has(e.target).length === 0) { $(".dropdownUl").hide(); }
        });
        $(".bars").click(function(){
        	$(".mainUl").slideToggle();
        });
        });
    </script>
    <?php if ($m["live_chat"] == "1") { ?>
    <?= $settings['live_chat_code'] ?>
    <?php } ?>
    </body>
</html>
  