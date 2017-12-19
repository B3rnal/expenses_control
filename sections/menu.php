
<div id="navSection" class="row">
	<ul class="menu dropdown medium-12" data-dropdown-menu>
	  <li id="home" class="<?php echo $currentOption=='home'?'active':'' ?>"  ><a href="myExpenses.php">My Expenses</a></li>
	  <?php  if($_SESSION["current_user"]["UserTypeId"]==1){  ?>
		  <li id="home" class="<?php echo $currentOption=='all'?'active':'' ?>"  ><a href="manage-expenses.php">See All</a></li>
		  <li id="home" class="<?php echo $currentOption=='one'?'active':'' ?>"  ><a href="specific-expense.php">Specific Expense</a></li>
		  <li id="users" class="<?php echo $currentOption=='users'?'active':'' ?>"><a href="users.php">Users</a></li>
		  <li id="reports" class="<?php echo $currentOption=='reports'?'active':'' ?>"><a href="reports.php">Reports</a></li>
	<?php } ?>
	</ul>
</div>