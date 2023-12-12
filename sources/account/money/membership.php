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
$membership_id = idinfo($_SESSION['uid'],"membership");
$id = $db->query("SELECT * FROM referral_membership WHERE id='$membership_id'");
$mem = $id->fetch_assoc();
$date = date('Y-m-d');
?>
		<div class="container-fluid py-4">
		        <?php echo warn("<b>Referral Allowed</b> means how many users can join under your account. Check Earning table to calculate your earnings."); ?>
			
				<?php 
				if (isset($_POST['upgrade'])) {
					$name = protect($_POST['upgrade']);
					$currency = $settings['default_currency'];
					
					$check = $db->query("SELECT * FROM referral_membership WHERE name='$name'");
					$row = $check->fetch_assoc();
					$amount = $row['price'];
					if(get_wallet_balance($_SESSION['uid'],$currency) < $row['price']) {
						echo error($lang['error_8']);
					} elseif(idinfo($_SESSION['uid'],"email") == $email) {
						echo error($lang['error_9']);
					} else {
						$txid = strtoupper(randomHash(10));
						$time = time();
						UpdateUserWallet($_SESSION['uid'],$row['price'],$currency,2);
						
						$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
						VALUES ('$txid','299','$_SESSION[uid]','$description','$amount','$currency','1','$time')");
            
						$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
						VALUES ('$txid','299','$_SESSION[uid]','$amount','$currency','1','$time')");
						
						UpdateAdminWallet($amount,$currency);
						$insert_admin_log = $db->query("INSERT admin_logs (type,time,u_field_1,u_field_2,u_field_3) VALUES ('299','$time','$amount','$currency','$txid')");
						
						$update = $db->query("UPDATE users SET membership='$row[id]' WHERE id='$_SESSION[uid]'");
						$duration = $row['duration'];
						$date = date('Y-m-d');      //Date of activation
                        $date_complete = date('Y-m-d', strtotime($date. ' + '.$duration.' days'));      //Date of completion
						
						UpdateMembership($txid,$row['id'],$_SESSION['uid'],$amount,$currency,1,$time,$date,$date_complete);
						
						if ($m["referral_system"] == "1") {
						    
						
						    $date = date('Y-m-d');
						    
						    $ref_01 = idinfo($_SESSION['uid'],"ref1"); //current player referred by lvl-1        //5
						    $ref_02 = idinfo($_SESSION['uid'],"ref2"); //current player referred by lvl-2        //4
						    $ref_03 = idinfo($_SESSION['uid'],"ref3"); //current player referred by lvl-3        //1
						    $ref_04 = idinfo($_SESSION['uid'],"ref4"); //current player referred by lvl-4
						    $ref_05 = idinfo($_SESSION['uid'],"ref5"); //current player referred by lvl-5
						    $ref_06 = idinfo($_SESSION['uid'],"ref6"); //current player referred by lvl-6
						    $ref_07 = idinfo($_SESSION['uid'],"ref7"); //current player referred by lvl-7
						    $ref_08 = idinfo($_SESSION['uid'],"ref8"); //current player referred by lvl-8
						    $ref_09 = idinfo($_SESSION['uid'],"ref9"); //current player referred by lvl-9
						    $ref_10 = idinfo($_SESSION['uid'],"ref10"); //current player referred by lvl-10
						    
						    $calcu_1 = $db->query("SELECT * FROM users WHERE ref1='$ref_01'");
                		    $t_lv_1 = $calcu_1->num_rows;
                		    
                		    if($ref_01 > 0) {
						        
						        $plyer = $ref_01;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 1 && $t_lv_1 <= $prow['limits']) {
					                $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_1'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
					        }
						    if($ref_02 > 0) {
						        
						        $plyer = $ref_02;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 2 && $t_lv_1 <= $prow['limits']) {
    						        $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_2'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
						    }
						    if($ref_03 > 0) {
						        
						        $plyer = $ref_03;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 3 && $t_lv_1 <= $prow['limits']) {
					            
    						        $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_3'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
						    }
						    if($ref_04 > 0) {
						        
						        $plyer = $ref_04;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 4 && $t_lv_1 <= $prow['limits']) {
    					                
    						        $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_4'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
						    }
						    if($ref_05 > 0) {
						        
						        $plyer = $ref_05;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 5 && $t_lv_1 <= $prow['limits']) {
					            
    						        $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_5'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
						    }
						    if($ref_06 > 0) {
						        
						        $plyer = $ref_06;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 6 && $t_lv_1 <= $prow['limits']) {
					                
    						        $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_6'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
						    }
						    if($ref_07 > 0) {
						        
						        $plyer = $ref_07;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 7 && $t_lv_1 <= $prow['limits']) {
					                
    						        $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_7'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
						    }
						    if($ref_08 > 0) {
						        
						        $plyer = $ref_08;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 8 && $t_lv_1 <= $prow['limits']) {
					            
    						        $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_8'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
						    }
						    if($ref_09 > 0) {
						        
						        $plyer = $ref_09;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 9 && $t_lv_1 <= $prow['limits']) {
					                
    						        $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_9'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
						    }
						    if($ref_10 > 0) {
						        
						        $plyer = $ref_10;
						        $plyer_email = idinfo($_SESSION['uid'],"email");
						        $plyer_mem_id = idinfo($plyer,"membership");
						        $pcheck = $db->query("SELECT * FROM referral_membership WHERE id='$plyer_mem_id'");
					            $prow = $pcheck->fetch_assoc();
					            
					            if($prow['levels_allow']  >= 10 && $t_lv_1 <= $prow['limits']) {
					            
    						        $bonusQuery = $db->query("SELECT * FROM levels WHERE mem_id='$row[id]' and name='lvl_10'");
    							    $bonus_settings = $bonusQuery->fetch_assoc();
    						        
    						        $upline_infoQuery= $db->query("SELECT * FROM users WHERE id='$plyer'"); 
    							    $upline_info = $upline_infoQuery->fetch_assoc();
    						        
    						        $CheckMembership_2 = $db->query("SELECT * FROM membership_log WHERE uid='$upline_info[id]'");
                                    $mem_row_2 = $CheckMembership_2->fetch_assoc();
                                    if ($date < $mem_row_2['end_date']) {
            							$prize_per = $amount*($bonus_settings['per_com']/100);
            							$prize_fix = $bonus_settings['fix_com'];
            							$prize = $prize_per + $prize_fix;
            							$prize = number_format($prize, 2, '.', '');
            							
            							UpdateUserWallet($plyer,$prize,$currency,1);
            							$insert_bonus_logs = $db->query("INSERT bonus_logs (uid,user_email,from_who,commission,currency,date) VALUES ('$upline_info[id]','$upline_info[email]','$plyer_email','$prize','$currency','$date')");
            							
            							$create_transaction = $db->query("INSERT transactions (txid,type,sender,description,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$description','$prize','$currency','1','$time')");
                        
            							$insert_activity = $db->query("INSERT activity (txid,type,uid,amount,currency,status,created) 
            							VALUES ('$txid','300','$upline_info[id]','$prize','$currency','1','$time')");
                                    }
					            }
						    }
						}
						
						echo success("Membership $name has been activated.");
						header("Refresh:0");
					}
				}
				
				
				
				?>
                <form action="" method="POST">
                    
					<div class="row">
						<?php
						$statement = "referral_membership";
						$query = $db->query("SELECT * FROM {$statement}");
						if($query->num_rows>0) {
							while($row = $query->fetch_assoc()) {
								?>
								<div class="col-md-4 mb-4">
									<div class="card card-pricing">
									  <div class="card-header bg-gradient-warning text-center pt-4 pb-5 position-relative">
										<div class="z-index-1 position-relative">
										  <h5 class="text-white"><?= $row['name']; ?></h5>
										  <h1 class="text-white mt-2 mb-0">
											<small style="font-size:18px;"><?= $settings['default_currency'] ?></small> <?= $row['price']; ?></h1>
										 </div>
									  </div>
									  <div class="position-relative mt-n5" style="height: 50px;">
										<div class="position-absolute w-100">
											<svg class="waves waves-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
											  <defs>
												<path id="card-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
											  </defs>
											  <g class="moving-waves">
												<use xlink:href="#card-wave" x="48" y="-1" fill="rgba(255,255,255,0.30"></use>
												<use xlink:href="#card-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
												<use xlink:href="#card-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
												<use xlink:href="#card-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
												<use xlink:href="#card-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
												<use xlink:href="#card-wave" x="48" y="16" fill="rgba(255,255,255,0.99)"></use>
											  </g>
											</svg>
										  </div>
									  </div>
									  <div class="card-body text-center">
										<ul class="list-unstyled max-width-200 mx-auto">
										  <li>
											 Active for <b class="text-warning"><?= $row['duration']; ?></b> Days
											<hr class="horizontal dark">
										  </li>
										  <li>
											 <b class="text-warning"><?= $row['limits']; ?></b> Referrals Allowed
											<hr class="horizontal dark">
										  </li>
										  <li>
											 <b class="text-warning"><?= $row['levels_allow']; ?></b> Levels
											<hr class="horizontal dark">
										  </li>
										</ul>
										<?php
										    $CheckMembership = $db->query("SELECT * FROM membership_log WHERE uid='$_SESSION[uid]' and plan='$row[id]'");
                                            $mem_row = $CheckMembership->fetch_assoc();
                                        ?>
										<?php if ($membership_id > 0 && $mem['id'] == $row['id'] && $date < $mem_row['end_date']) { ?>
											<a href="javascript:;" class="btn btn-success w-100 mt-4 mb-0">Currently Active</a>
											<p></p>
											<div class="alert alert-info info" style="color:white;"><i class="fa fa-info-circle"></i> Expires on <?=$mem_row['end_date']?></div>
										<?php } else { ?>
											<button type="submit" class="btn bg-gradient-warning w-100 mt-4 mb-0" value="<?= $row['name']; ?>" name="upgrade">Activate Now</button>
										<?php } ?>
									  </div>
									</div>
								  </div>
								<?php
							}
						} else {
							echo '<tr><td colspan="3">Currently No Membership Plan Available</td></tr>';
						}
						?>
					</div>
				</form>
		</div>