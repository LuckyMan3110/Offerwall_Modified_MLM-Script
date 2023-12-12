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
				$levels_allow = protect($_POST['reward']);
				$limits = protect($_POST['reward_limit']);
				$status = protect($_POST['status']);
				
				$check = $db->query("SELECT * FROM reward WHERE name='$name'");
				if(empty($name) or empty($levels_allow) or empty($limits) or empty($status)) {
					echo error("Some feilds are empty.");
				} elseif($check->num_rows>0) {
					echo error("Reward <b>$name</b> is already exists.");
				} else {
					$insert = $db->query("INSERT reward (name,reward,reward_limit,status) VALUES ('$name','$levels_allow','$limits','$status')");
					
					$GetU = $db->query("SELECT * FROM reward WHERE name='$name'");
                    $gu = $GetU->fetch_assoc();
                    
                    echo success("Reward has been added.");
				}
			}
			
			?>
			<form action="" method="POST">
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Rank Name</label>
							<input class="form-control" name="name">
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Rank Reward</label>
							<input class="form-control" name="reward">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<div class="form-group">
        					<label>How many referral need in total to claim the reward?</label>
        					<input type="number" min="1" step="1" required class="form-control" name="reward_limit">
        				</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="status">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="btn_add" value="btn_add"><i class="fa fa-plus"></i> Add Reward</button>
			</form>
		</div>
    </div>
</div>
<?php 
	} elseif($b == "delete") { 
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM reward WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=reward"); }
	$row = $query->fetch_assoc();
?>
<div class="col-md-12">
	<div class="card">
		<div class="card-body">
			<?php
			if(isset($_GET['confirm'])) {
				$delete = $db->query("DELETE FROM reward WHERE id='$row[id]'");
				echo success("Reward <b>$row[name]</b> was deleted.");
			} else {
				echo info("Are you sure you want to delete <b>$row[name]</b>?");
				echo '<a href="./?a=reward&b=delete&id='.$row['id'].'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
					<a href="./?a=reward" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
			}
			?>
		</div>
	</div>
</div>
<?php 
	} elseif($b == "edit") { 
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM reward WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=reward"); }
	$row = $query->fetch_assoc();
?>
<div class="col-md-12">
	<div class="card">
		<div class="card-body">
			<?php
			
			$FormBTN = protect($_POST['btn_save']);
			if($FormBTN == "btn_save") {
				$name = protect($_POST['name']);
				$limits = protect($_POST['reward']);
				$price = protect($_POST['reward_limit']);
				$status = protect($_POST['status']);

				if(empty($name) or empty($price) or empty($limits)) {
					echo error("Some feilds are empty.");
				} else {
					$update = $db->query("UPDATE reward SET name='$name',reward='$limits',reward_limit='$price',status='$status' WHERE id='$id'");
					$query = $db->query("SELECT * FROM reward WHERE id='$id'");
					$row = $query->fetch_assoc();
					echo success("Reward has been updated.");
				}
			}
			
			?>
			<form action="" method="POST">
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Rank Name</label>
							<input class="form-control" name="name" value="<?= $row['name'] ?>">
						</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Rank Reward</label>
							<input class="form-control" name="reward" value="<?= $row['reward'] ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<div class="form-group">
        					<label>How many referral need in total to claim the reward?</label>
        					<input type="number" min="1" required step="1" class="form-control" name="reward_limit" value="<?= $row['reward_limit'] ?>">
        				</div>
					</div>
					<div class="col-md">
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="status">
								<option value="1" <?php if($row['status'] == "1") { echo 'selected'; } ?>>Active</option>
								<option value="0" <?php if($row['status'] == "0") { echo 'selected'; } ?>>Inactive</option>
							</select>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="btn_save" value="btn_save"><i class="fa fa-check-circle"></i> Update Reward</button>
			</form>
		</div>
	</div>
</div>
<?php } else { ?>

<center><a href="./?a=reward&b=add" class="btn btn-primary btn-block" style="width:98%;"><i class="fa fa-plus"></i> Add Reward</a></center>
<br>
<div class="col-md-12">
	<div class="card">
		<div class="card-body table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Rank Name</th>
						<th>Reward</th>
						<th>Referral Required</th>
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
					$statement = "reward";
					$query = $db->query("SELECT * FROM {$statement} ORDER BY id LIMIT {$startpoint} , {$limit}");
					if($query->num_rows>0) {
						while($row = $query->fetch_assoc()) {
							?>
							<tr>
								<td><?= $row['name']; ?></td>
								<td><?= $settings['default_currency'] ?> <?= $row['reward']; ?></td>
								<td><?= $row['reward_limit']; ?> Referrals</td>
								<td><?php
									if($row['status'] == "1") {
										echo '<span class="badge badge-success">Active</span>';
									} else {
										echo '<span class="badge badge-danger">Inactive</span>';
									}
								?></td>
								<td>
									<a href="./?a=reward&b=edit&id=<?= $row['id']; ?>" title="Edit"><span class="badge badge-primary"><i class="fa fa-pencil"></i> Edit</span></a>
									<a href="./?a=reward&b=delete&id=<?= $row['id']; ?>" title="Delete"><span class="badge badge-danger"><i class="fa fa-trash"></i> Delete</span></a>
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
				$ver = "./?a=reward";
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
			<small>You will create the reward from admin panel.</small><br>
			<small>Customer/User will claim this reward once they acheive this rank/goal.</small><br>
		</div>
	</div>
</div>

<?php } ?>