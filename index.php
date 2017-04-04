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
	<link rel="stylesheet" type="text/css" href="../css/index-styles.css" >

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
	<script type="text/javascript" src="../js/index-functions.js"></script>
</head>

<body>
	
	<header id="mainHead" class="row">
		<div class="logo ">
			 <img src="../img/hangar_logo.png" alt="Hangar Logo">
			 <h1>Expense Report System</h1> 
		</div>
		<div class="user-info ">
			<h2>Bernal Araya, Admin User</h2>
		</div>
	</header>
	<!-- menu -->
	<div id="navSection" class="row">
		<ul class="menu dropdown medium-12" data-dropdown-menu>
		  <li id="home" class="active"><a href="#">Home</a></li>
		  <li id="expenses" >
		  	<a>Expenses</a>
			<ul class="menu">
				<li><a href="manage-expenses.php">Manage Expenses</a></li>
				<li><a href="manage-invoices.php">External Invoices</a></li>
			</ul>
		  </li>
		  <li id="users" ><a href="users.php">Usuers</a></li>
		  <li id="client-proyect" ><a href="client-proyect.php">Clients & Proyects</a></li>
		  <li id="reports" ><a href="reports.php">Reports</a></li>
		</ul>
	</div>
	<!-- /menu -->
	
	<!-- page-content -->
	<div id="content" class="row">
		<!-- expenses-list -->
		<div class="columns small-12 medium-4">
			<label class="left">Pending Expense Reports
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