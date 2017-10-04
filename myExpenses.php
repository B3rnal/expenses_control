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
	<link rel="stylesheet" type="text/css" href="../css/myExpenses-styles.css" >

	<!-- JS -->
	<!-- Jquey -->
	<script type="text/javascript" src="../js/jquery-3.2.0.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	<!-- Foundation -->
	<script type="text/javascript" src="../foundation/js/vendor/foundation.min.js"></script>
	<script type="text/javascript" src="../foundation/js/datepicker.js"></script>
	<!-- JTABLE -->
	<script src="../jtable/jquery.jtable.min.js" type="text/javascript"></script>
	<!-- Custom -->
	<script type="text/javascript" src="../js/main-functions.js"></script>
	<script type="text/javascript" src="../js/myExpenses-functions.js"></script>
</head>

<body>
	<?php
	//header
	include "sections/header.php";
	//menu
	$currentOption="home";
	include "sections/menu.php"; 
	?>
	<!-- page-content -->
	<div id="content" class="row">
		<!-- expenses-list -->
		<div class="columns small-12 medium-4">
			<label class="left">My Expense Reports
			  <select id="currentExpenseReport">
			    <option value="1">NY - set 2 2016</option>
			    <option value="2">Toronto - ene 20 2017</option>
			  </select>
			</label>
			<a id="loadExpenseData" class="button">Update</a>
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
		<!-- /table -->

	</div>
	<!-- /page-content -->
	<footer>
		
	</footer>

</body>

</html>