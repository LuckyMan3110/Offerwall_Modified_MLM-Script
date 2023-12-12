<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
?>

<?php $query = $db->query("SELECT * FROM bonus_logs ORDER BY id DESC"); ?>
           <div class="col-md-12">
					<div class="card">
                        <div class="card-body table-responsive">
                            
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="25%">User</th>
                                    <th width="15%">From Who</th>
                                    <th width="15%">Commission</th>
                                    <th width="15%">Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   while($ccc = $query->fetch_assoc()) {
                                        ?>
                                
                                        <tr>
                                            <td><?php echo filter_var($ccc['user_email'], FILTER_SANITIZE_STRING); ?></td>
                                            <td><?php echo filter_var($ccc['from_who'], FILTER_SANITIZE_STRING); ?></td>
                                            <td><?php echo filter_var($ccc['currency'], FILTER_SANITIZE_STRING); ?> <?php echo filter_var($ccc['commission'], FILTER_SANITIZE_STRING); ?></td>
                                            <td><?php echo filter_var($ccc['date'], FILTER_SANITIZE_STRING); ?></td>
                                            
                                        </tr>
                                    <?php } ?>    
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>