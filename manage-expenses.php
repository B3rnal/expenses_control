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
	<!-- Custom -->
	<link rel="stylesheet" type="text/css" href="../css/main-styles.css" >
	<link rel="stylesheet" type="text/css" href="../css/manage-expenses-styles.css" >
	<!-- Chosen css -->
	<link rel="stylesheet" href="../js/chosen/chosen.css">

	<link rel="stylesheet" type="text/css" href="../jquery_validation/css/validationEngine.jquery.css" >
	

	<!-- JS -->
	<!-- Jquey -->
	<script type="text/javascript" src="../js/jquery-3.2.0.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	<!-- Foundation -->
	<script type="text/javascript" src="../foundation/js/vendor/foundation.min.js"></script>
	<script type="text/javascript" src="../foundation/js/datepicker.js"></script>
	<!-- JTABLE -->
	<script src="../jtable/jquery.jtable.min.js" type="text/javascript"></script>
	<!-- JTABLE VALIDATION -->
	<script type="text/javascript" src="../jquery_validation/js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="../jquery_validation/js/languages/jquery.validationEngine-en.js"></script>
	<!-- Chosen js -->
	<script src="../js/chosen/chosen.jquery.js" type="text/javascript"></script>
	<!-- Custom -->
	<script type="text/javascript" src="../js/main-functions.js"></script>
	<script type="text/javascript" src="../js/manage-expenses-functions.js"></script>
	
</head>

<body>
	<?php
	//header
	include "sections/header.php"; 
	//menu
	$currentOption="all";
	include "sections/menu.php"; 
	?>
	<!-- page-content -->
	<div id="content" class="row">
		<!-- search filter -->
		<div class="columns small-12">
			<h1>Expenses Managment</h1>
			Search Expense Report by:
			<form class="filter-section small-12 columns">
				<div class="row">
					<div class="small-2 columns" >
						<label for="expId">Id</label>
						<!-- <input type="text" name="expId" id="expId"> -->
						<select id="expId" class="chosen-selec" >
							<option value="">All</option>
						</select>
					</div>
					<div class="small-2 columns">
						<label for="expUser" >User</label>
						<select id="usrId" class="chosen-selec" >
							<option value="">All</option>
						</select>
					</div>
					<div class="small-2 columns">
						<label for="expDpt" >Department</label>
						<select id="deptId" class="chosen-selec" >
							<option value="">All</option>
						</select>
					</div>
					<div class="small-2 columns">
						<label class="left">Status</label>
						<select id="expStatus" >
							<option value="">All</option>
						    <option value="1">Open</option>
						    <option value="2">Waiting Approval</option>
						    <option value="3">Approved</option>
							<option value="4">Closed</option>
						</select>
					</div>
					<div class="small-2 columns">
						<label for="Expbilliable">Billiable</label> 
						<select id="billiable" >
							<option value="">All</option>
						    <option value="1">Yes</option>
						    <option value="2">No</option>
						</select>
					</div>
					<div class="small-1 columns">
						<input class="button" type="submit" value="Search" id="search">
					</div>
					<div class="small-1 columns">
						<input class="button" type="submit" value="Clear" id="clear">
					</div>
				</div>
				<div class="row">
					
					<div class="small-2 columns">
						<input class="button ExpenseSelected" type="submit" id="CheckExpense" value="Check Expense">
					</div>
					<div class="small-2 columns">
						<input class="button ExpenseSelected"  type="submit" id="CreateInvoice" value="Create External Invoice">
					</div>
					<div class="small-6 columns">
						<!-- <input class="button" type="submit" value="Clear"> -->
					</div>
				</div>
			</form>
		</div>
		<!-- /Search Filter -->
		<!-- table -->
		<div id="tableContainer" class="columns small-12">
			<div id="expensesTableContainer"></div>
		</div>
		<!-- /table -->
	</div>
	<!-- /page-footer -->
	<footer>
		
	</footer>
	<script type="text/javascript">
		$( ".ExpenseSelected" ).prop( "disabled", true );
	</script>
	

</body>

</html>