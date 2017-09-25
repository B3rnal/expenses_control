<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Expense Report System</title>

	 <!-- CSS -->

	<link href="../css/jquery-ui.min.css" rel="stylesheet"  type="text/css" >
	<!-- Foundation -->
	 <link href="../foundation/css/foundation.min.css" rel="stylesheet"  type="text/css" >
	 <link href="../foundation/css/datepicker.css" rel="stylesheet"  type="text/css" >
	<!-- JTABLE -->
	<link href="../jtable/themes/metro/blue/jtable.min.css" rel="stylesheet" type="text/css" >
	<!-- Chosen css -->
	<link rel="stylesheet" href="../js/chosen/chosen.css">
	<!-- Custom -->
	<link rel="stylesheet" type="text/css" href="../css/main-styles.css" >
	<link rel="stylesheet" type="text/css" href="../css/manage-expenses-styles.css" >

	<!-- JS -->
	<!-- Jquey -->
	<script type="text/javascript" src="../js/jquery-3.2.0.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	<!-- Foundation -->
	<script type="text/javascript" src="../foundation/js/vendor/foundation.min.js"></script>
	<script type="text/javascript" src="../foundation/js/datepicker.js"></script>
	<!-- JTABLE -->
	<script src="../jtable/jquery.jtable.min.js" type="text/javascript"></script>
	<!-- Chosen js -->
	<script src="../js/chosen/chosen.jquery.js" type="text/javascript"></script>
	<!-- Custom -->
	<script type="text/javascript" src="../js/main-functions.js"></script>
	<script type="text/javascript" src="../js/specific-expense-functions.js"></script>
	<script type="text/javascript" src="../js/index-functions.js"></script>
</head>

<body>
	<?php
	//header
	include "sections/header.php"; 
	//menu
	$currentOption="one";
	include "sections/menu.php"; 
	?>
	<!-- page-content -->
	<div id="content" class="row">
		<!-- search filter -->
		<div class="columns small-12">
			<h1>Specific Expense Manager</h1>
			Search Expense:
			<form class="filter-section small-12 columns">
				<div class="row">
					<div class="small-2 columns" >
						<label for="expId">Id</label>
						<select id="expId" class="chosen-select" >
							<option value=""></option>
						</select>
					</div>
					<div class="small-1 columns">
						<input class="button" type="submit" value="Search" id="search">
					</div>
					<div class="small-1 columns">
						<input class="button" type="submit" value="Clear" id="clear">
					</div>
					<div class="large-2 columns">
						<input class="button ExpenseSelected"  type="submit" id="CreateInvoice" value="Create External Invoice">
					</div>
				</div>
			</form>
		</div>
		<!-- /expenses-list -->
		<!-- table -->
		<div id="tableContainer" class="columns small-12">
			<div id="tableMenu">
				<a id="submit" href="">Submit</a>
				<a id="recall" href="" style="display: none;"> Recall </a>
				<a id="cancel" href="">  | Cancel</a>
				<div id="expenseStatus" class="table-status">
					Status <span>Open</span>
				</div>
			</div>
			<div id="expensesTableContainer"></div>


		</div>
	</div>
	<!-- /page-content -->
	<footer>
		
	</footer>

</body>

</html>