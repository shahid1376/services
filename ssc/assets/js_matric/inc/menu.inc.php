<?php
$class = 'class="selected"';
if(!isset($page) or empty($page)) {
  	$page = "1";
  }
?>
<div class="menu_container">
	<ul id="nav">
		<li><a <?php echo apply_class($page,1,$class);?>  href="index.php">Home</a></li>
		<li><a <?php echo apply_class($page,2,$class);?>  href="GetInfo.php">New Enrolment</a></li>
		<li><a <?php echo apply_class($page,3,$class);?> href="reports.php">Reports</a></li>
		<li><a <?php echo apply_class($page,4,$class);?>  href="edit-form.php">Edit Form</a></li>
		<li><a <?php echo apply_class($page,5,$class);?> href="create-batch.php">Create Batch</a></li>
		<li><a <?php echo apply_class($page,6,$class);?> href="batch-list.php">Batch List</a></li>
		<li><a <?php echo apply_class($page,7,$class);?> href="security.php">Security</a></li>
		<li><a href="logout.php">Sign Out</a></li>
	</ul>
	<div class="clear"></div>
</div>