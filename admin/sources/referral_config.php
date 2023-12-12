<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
$b = protect($_GET['b']);
?>
<?php if($b == "add") { ?>
<div class="col-md-12">
	<div class="card">
		<div class="card-body">
			<?php
			
			$FormBTN = protect($_POST['btn_add']);
			if($FormBTN == "btn_add") {
				$name = protect($_POST['name']);
				$levels_allow = protect($_POST['levels_allow']);
				$limits = protect($_POST['limits']);
				$price = protect($_POST['price']);
				$status = protect($_POST['status']);
				$duration = protect($_POST['duration']);
				$check = $db->query("SELECT * FROM referral_membership WHERE name='$name'");
				if(empty($name) or empty($price) or empty($status) or empty($limits)) {
					echo error("Some feilds are empty.");
				} elseif($check->num_rows>0) {
					echo error("Plan <b>$name</b> is already exists.");
				} else {
					$insert = $db->query("INSERT referral_membership (name,limits,price,status,duration,levels_allow) VALUES ('$name','$limits','$price','$status','$duration','$levels_allow')");
					
					$GetU = $db->query("SELECT * FROM referral_membership WHERE name='$name'");
                    $gu = $GetU->fetch_assoc();
                    
                    if ($levels_allow >= 1) {
                        $insert_1 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_1','1')");
                    }
                    if ($levels_allow >= 2) {
                        $insert_2 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_2','1')");
                    }
					if ($levels_allow >= 3) {
					    $insert_3 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_3','1')");
                    }
                    if ($levels_allow >= 4) {
					    $insert_4 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_4','1')");
                    }
                    if ($levels_allow >= 5) {
					    $insert_5 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_5','1')");
                    }
                    if ($levels_allow >= 6) {
					    $insert_6 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_6','1')");
                    }
                    if ($levels_allow >= 7) {
					    $insert_7 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_7','1')");
                    }
                    if ($levels_allow >= 8) {
					    $insert_8 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_8','1')");
                    }
                    if ($levels_allow >= 9) {
					    $insert_9 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_9','1')");
                    }
                    if ($levels_allow >= 10) {
					    $insert_10 = $db->query("INSERT levels (mem_id,name,status) VALUES ('$gu[id]','lvl_10','1')");
                    }
					
					echo success("Membership has been added. Don't forget to setup levels.");
				}
			}
			
			?>
			<form action="" method="POST">
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Membership Name</label>
							<input class="form-control" name="name">
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Activation Price</label>
							<input class="form-control" name="price">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<div class="form-group">
        					<label>Referral Limits</label>
        					<input type="number" min="1" step="1" required class="form-control" name="limits">
        				</div>
					</div>
					<div class="col-md">
						<div class="form-group">
        					<label>Referral Levels (1-10)</label>
        					<input type="number" min="1" max="10" step="1" required class="form-control" name="levels_allow">
        				</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="status">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Duration In days</label>
							<input class="form-control" name="duration">
						</div>
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary" name="btn_add" value="btn_add"><i class="fa fa-plus"></i> Add Membership Plan</button>
			</form>
		</div>
    </div>
</div>
<?php 
	} elseif($b == "delete") { 
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM referral_membership WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=referral_config"); }
	$row = $query->fetch_assoc();
?>
<div class="col-md-12">
	<div class="card">
		<div class="card-body">
			<?php
			if(isset($_GET['confirm'])) {
				$delete = $db->query("DELETE FROM referral_membership WHERE id='$row[id]'");
				$delete_2 = $db->query("DELETE FROM levels WHERE mem_id='$row[id]'");
				echo success("Membership <b>$row[name]</b> was deleted.");
			} else {
				echo info("Are you sure you want to delete <b>$row[name]</b>?");
				echo '<a href="./?a=referral_config&b=delete&id='.$row['id'].'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
					<a href="./?a=referral_config" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
			}
			?>
		</div>
	</div>
</div>
<?php 
	} elseif($b == "levels") { 
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM levels WHERE mem_id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=referral_config"); }
	
	$queryss = $db->query("SELECT * FROM referral_membership WHERE id='$id'");
    $rowss = $queryss->fetch_assoc();
?>
<div class="col-md-12">
    <div class="card card-body">
        <h5 style="font-weight:700;text-transform: uppercase;"><em><?=$rowss['name'] ?></em> <b style="float:right;">Levels</b></h5>
    </div>
	<div class="card">
		<div class="card-body">
		    
		    <?php
			
			$FormBTN = protect($_POST['btn_save']);
			if($FormBTN == "btn_save") {
				
				
				if ($rowss['levels_allow'] >= 1) {
				    //lvl 1
    				$lvl_1_per_com = protect($_POST['lvl_1_per_com']);
    				$lvl_1_fix_com = protect($_POST['lvl_1_fix_com']);
    				
    				if ($lvl_1_per_com == "0") {
    				    $lvl_1_per_com = 0.00;
    				}
    				if ($lvl_1_fix_com == "0") {
    				    $lvl_1_fix_com = 0.00;
    				}
				}
				if ($rowss['levels_allow'] >= 2) {
				    //lvl 2
    				$lvl_2_per_com = protect($_POST['lvl_2_per_com']);
    				$lvl_2_fix_com = protect($_POST['lvl_2_fix_com']);
    				
    				if ($lvl_2_per_com == "0") {
    				    $lvl_2_per_com = 0.00;
    				}
    				if ($lvl_2_fix_com == "0") {
    				    $lvl_2_fix_com = 0.00;
    				}
				}
				if ($rowss['levels_allow'] >= 3) {
				    //lvl 3
    				$lvl_3_per_com = protect($_POST['lvl_3_per_com']);
    				$lvl_3_fix_com = protect($_POST['lvl_3_fix_com']);
    				
    				if ($lvl_3_per_com == "0") {
    				    $lvl_3_per_com = 0.00;
    				}
    				if ($lvl_3_fix_com == "0") {
    				    $lvl_3_fix_com = 0.00;
    				}
				}
				if ($rowss['levels_allow'] >= 4) {
				    //lvl 4
    				$lvl_4_per_com = protect($_POST['lvl_4_per_com']);
    				$lvl_4_fix_com = protect($_POST['lvl_4_fix_com']);
    				
    				if ($lvl_4_per_com == "0") {
    				    $lvl_4_per_com = 0.00;
    				}
    				if ($lvl_4_fix_com == "0") {
    				    $lvl_4_fix_com = 0.00;
    				}
				}
				if ($rowss['levels_allow'] >= 5) {
				    //lvl 5
    				$lvl_5_per_com = protect($_POST['lvl_5_per_com']);
    				$lvl_5_fix_com = protect($_POST['lvl_5_fix_com']);
    				
    				if ($lvl_5_per_com == "0") {
    				    $lvl_5_per_com = 0.00;
    				}
    				if ($lvl_5_fix_com == "0") {
    				    $lvl_5_fix_com = 0.00;
    				}
				}
				if ($rowss['levels_allow'] >= 6) {
				    //lvl 6
    				$lvl_6_per_com = protect($_POST['lvl_6_per_com']);
    				$lvl_6_fix_com = protect($_POST['lvl_6_fix_com']);
    				
    				if ($lvl_6_per_com == "0") {
    				    $lvl_6_per_com = 0.00;
    				}
    				if ($lvl_6_fix_com == "0") {
    				    $lvl_6_fix_com = 0.00;
    				}
				}
				if ($rowss['levels_allow'] >= 7) {
				    //lvl 7
    				$lvl_7_per_com = protect($_POST['lvl_7_per_com']);
    				$lvl_7_fix_com = protect($_POST['lvl_7_fix_com']);
    				
    				if ($lvl_7_per_com == "0") {
    				    $lvl_7_per_com = 0.00;
    				}
    				if ($lvl_7_fix_com == "0") {
    				    $lvl_7_fix_com = 0.00;
    				}
				}
				if ($rowss['levels_allow'] >= 8) {
				    //lvl 8
    				$lvl_8_per_com = protect($_POST['lvl_8_per_com']);
    				$lvl_8_fix_com = protect($_POST['lvl_8_fix_com']);
    				
    				if ($lvl_8_per_com == "0") {
    				    $lvl_8_per_com = 0.00;
    				}
    				if ($lvl_8_fix_com == "0") {
    				    $lvl_8_fix_com = 0.00;
    				}
				}
				if ($rowss['levels_allow'] >= 9) {
				    //lvl 9
    				$lvl_9_per_com = protect($_POST['lvl_9_per_com']);
    				$lvl_9_fix_com = protect($_POST['lvl_9_fix_com']);
    				
    				if ($lvl_9_per_com == "0") {
    				    $lvl_9_per_com = 0.00;
    				}
    				if ($lvl_9_fix_com == "0") {
    				    $lvl_9_fix_com = 0.00;
    				}
				}
				if ($rowss['levels_allow'] >= 10) {
				    //lvl 10
    				$lvl_10_per_com = protect($_POST['lvl_10_per_com']);
    				$lvl_10_fix_com = protect($_POST['lvl_10_fix_com']);
    				
    				if ($lvl_10_per_com == "0") {
    				    $lvl_10_per_com = 0.00;
    				}
    				if ($lvl_10_fix_com == "0") {
    				    $lvl_10_fix_com = 0.00;
    				}
				}
				
				    
				    
				    if ($rowss['levels_allow'] >= 1) {
				        $update_1 = $db->query("UPDATE levels SET fix_com='$lvl_1_fix_com',per_com='$lvl_1_per_com' WHERE name='lvl_1' and mem_id='$id' ");
				    }
				    if ($rowss['levels_allow'] >= 2) {
				        $update_2 = $db->query("UPDATE levels SET fix_com='$lvl_2_fix_com',per_com='$lvl_2_per_com' WHERE name='lvl_2' and mem_id='$id' ");
				    }
				    if ($rowss['levels_allow'] >= 3) {
				        $update_3 = $db->query("UPDATE levels SET fix_com='$lvl_3_fix_com',per_com='$lvl_3_per_com' WHERE name='lvl_3' and mem_id='$id' ");
				    }
				    if ($rowss['levels_allow'] >= 4) {
				        $update_4 = $db->query("UPDATE levels SET fix_com='$lvl_4_fix_com',per_com='$lvl_4_per_com' WHERE name='lvl_4' and mem_id='$id' ");
				    }
				    if ($rowss['levels_allow'] >= 5) {
				        $update_5 = $db->query("UPDATE levels SET fix_com='$lvl_5_fix_com',per_com='$lvl_5_per_com' WHERE name='lvl_5' and mem_id='$id' ");
				    }
				    if ($rowss['levels_allow'] >= 6) {
				        $update_6 = $db->query("UPDATE levels SET fix_com='$lvl_6_fix_com',per_com='$lvl_6_per_com' WHERE name='lvl_6' and mem_id='$id' ");
				    }
				    if ($rowss['levels_allow'] >= 7) {
				        $update_7 = $db->query("UPDATE levels SET fix_com='$lvl_7_fix_com',per_com='$lvl_7_per_com' WHERE name='lvl_7' and mem_id='$id' ");
				    }
				    if ($rowss['levels_allow'] >= 8) {
				        $update_8 = $db->query("UPDATE levels SET fix_com='$lvl_8_fix_com',per_com='$lvl_8_per_com' WHERE name='lvl_8' and mem_id='$id' ");
				    }
				    if ($rowss['levels_allow'] >= 9) {
				        $update_9 = $db->query("UPDATE levels SET fix_com='$lvl_9_fix_com',per_com='$lvl_9_per_com' WHERE name='lvl_9' and mem_id='$id' ");
				    }
				    if ($rowss['levels_allow'] >= 10) {
				        $update_10 = $db->query("UPDATE levels SET fix_com='$lvl_10_fix_com',per_com='$lvl_10_per_com' WHERE name='lvl_10' and mem_id='$id' ");
				    }
				    $query = $db->query("SELECT * FROM levels WHERE id='$id'");
					$row = $query->fetch_assoc();
					echo success("Levels has been updated.");
				
			}
			
			?>
		    
		    <form action="" method="POST">
		        
		        <?php
		        $statement = "levels";
		        $query = $db->query("SELECT * FROM {$statement} WHERE mem_id='$id' ORDER BY id");
		        if($query->num_rows>0) {
                    while($row = $query->fetch_assoc()) {
		        ?>
				<div class="row">
				    <div class="col-md">
						<div class="form-group">
							<label>
							    <?php
							    if ($row['name'] == "lvl_1") {
							        $rr = "Level 1";
							    }
							    if ($row['name'] == "lvl_2") {
							        $rr = "Level 2";
							    }
							    if ($row['name'] == "lvl_3") {
							        $rr = "Level 3";
							    }
							    if ($row['name'] == "lvl_4") {
							        $rr = "Level 4";
							    }
							    if ($row['name'] == "lvl_5") {
							        $rr = "Level 5";
							    }
							    if ($row['name'] == "lvl_6") {
							        $rr = "Level 6";
							    }
							    if ($row['name'] == "lvl_7") {
							        $rr = "Level 7";
							    }
							    if ($row['name'] == "lvl_8") {
							        $rr = "Level 8";
							    }
							    if ($row['name'] == "lvl_9") {
							        $rr = "Level 9";
							    }
							    if ($row['name'] == "lvl_10") {
							        $rr = "Level 10";
							    }
							    ?>
							    <?=$rr?>
							</label>
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label style="font-weight:normal;">Percentage Commission</label>
							<input type="number" required min="0.00" max="100" step="0.01" class="form-control" name="<?=$row['name']?>_per_com" value="<?= $row['per_com'] ?>">
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label style="font-weight:normal;">Fixed Commission</label>
							<input type="number" required min="0.00" step="0.01" class="form-control" name="<?=$row['name']?>_fix_com" value="<?= $row['fix_com'] ?>">
						</div>
					</div>
				</div>
				<?php } } ?>
				<hr>
				<button type="submit" class="btn btn-primary" name="btn_save" style="width:100%;" value="btn_save"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;Update Levels</button>
			</form>
		</div>
	</div>
</div>

<?php 
	} elseif($b == "edit") { 
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM referral_membership WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=referral_config"); }
	$row = $query->fetch_assoc();
?>
<div class="col-md-12">
	<div class="card">
		<div class="card-body">
			<?php
			
			$FormBTN = protect($_POST['btn_save']);
			if($FormBTN == "btn_save") {
				$name = protect($_POST['name']);
				$limits = protect($_POST['limits']);
				$price = protect($_POST['price']);
				$status = protect($_POST['status']);
				$duration = protect($_POST['duration']);
				
				if(empty($name) or empty($price) or empty($status) or empty($limits)) {
					echo error("Some feilds are empty.");
				} else {
					$update = $db->query("UPDATE referral_membership SET name='$name',limits='$limits',price='$price',status='$status',duration='$duration' WHERE id='$id'");
					$query = $db->query("SELECT * FROM referral_membership WHERE id='$id'");
					$row = $query->fetch_assoc();
					echo success("Membership has been updated.");
				}
			}
			
			?>
			<form action="" method="POST">
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Membership Name</label>
							<input class="form-control" name="name" value="<?= $row['name'] ?>">
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Activation Price</label>
							<input class="form-control" name="price" value="<?= $row['price'] ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<div class="form-group">
        					<label>Referral Limits</label>
        					<input type="number" min="1" required step="1" class="form-control" name="limits" value="<?= $row['limits'] ?>">
        				</div>
					</div>
					<div class="col-md">
						<div class="form-group">
        					<label>Referral Levels (1-10)</label>
        					<input type="number" min="1" max="10" required disabled step="1" class="form-control" value="<?= $row['levels_allow'] ?>">
        				</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="status">
								<option value="1" <?php if($row['status'] == "1") { echo 'selected'; } ?>>Active</option>
								<option value="0" <?php if($row['status'] == "0") { echo 'selected'; } ?>>Inactive</option>
							</select>
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Duration In days</label>
							<input class="form-control" name="duration" value="<?= $row['duration'] ?>">
						</div>
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary" name="btn_save" value="btn_save"><i class="fa fa-check-circle"></i> Update Plan</button>
			</form>
		</div>
	</div>
</div>
<?php } else { ?>

<center><a href="./?a=referral_config&b=add" class="btn btn-primary btn-block" style="width:98%;"><i class="fa fa-plus"></i> Add Plan</a></center>
<br>
<div class="col-md-12">
	<div class="card">
		<div class="card-body table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Package Name</th>
						<th>Price</th>
						<th>Referral Limits</th>
						<th>Status</th>
						<th>Action</th>
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
					$statement = "referral_membership";
					$query = $db->query("SELECT * FROM {$statement} ORDER BY id LIMIT {$startpoint} , {$limit}");
					if($query->num_rows>0) {
						while($row = $query->fetch_assoc()) {
							?>
							<tr>
								<td><?= $row['name']; ?></td>
								<td><?= $settings['default_currency'] ?> <?= $row['price']; ?></td>
								<td><?= $row['limits']; ?> Referrals</td>
								<td><?php
									if($row['status'] == "1") {
										echo '<span class="badge badge-success">Active</span>';
									} else {
										echo '<span class="badge badge-danger">Inactive</span>';
									}
								?></td>
								<td>
									<a href="./?a=referral_config&b=edit&id=<?= $row['id']; ?>" title="Edit"><span class="badge badge-primary"><i class="fa fa-pencil"></i> Edit</span></a>
									<a href="./?a=referral_config&b=levels&id=<?= $row['id']; ?>" title="Levels"><span class="badge badge-primary"><i class="fa fa-hand-peace-o"></i> Levels</span></a> 
									<a href="./?a=referral_config&b=delete&id=<?= $row['id']; ?>" title="Delete"><span class="badge badge-danger"><i class="fa fa-trash"></i> Delete</span></a>
								</td>
							</tr>
							<?php
						}
					} else {
						echo '<tr><td colspan="3">No have plans yet.</td></tr>';
					}
					?>
				</tbody>
			</table>
			<?php
				$ver = "./?a=referral_config";
				if(admin_pagination($statement,$ver,$limit,$page)) {
					echo admin_pagination($statement,$ver,$limit,$page);
				}
			?>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<small>How system works?</small>
			<p>
			<small>You will create the plans from admin panel.</small><br>
			<small>Customer/User will register account and they need to activate one of the membership plan.</small><br>
			<small>Once they have purchased the plan they can refer other users and earn 10 Level Referral Commission.</small><br>
			<small>There will be an option to allow limited referral to the users.</small></p>
		</div>
	</div>
</div>

<?php } ?>