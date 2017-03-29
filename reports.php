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
	<link rel="stylesheet" type="text/css" href="../css/main_styles.css" >

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
	<script type="text/javascript" src="../js/functions.js"></script>
</head>

<body>
	
	<header id="main-head" class="row">
		<div class="logo ">
			 <img src="../img/hangar_logo.png" alt="Hangar Logo"><h1>Expense Report System</h1> 
			
		</div>
		<div class="user-info ">
			<h2>Bernal Araya, Admin User</h2>
		</div>
	</header>
	<!-- menu -->
	<div id="nav-section" class="row">
		<ul class="menu dropdown medium-12" data-dropdown-menu>
		  <li><a href="index.php">Home</a></li>
		  <li>
		  	<a>Settings</a>
			<ul class="menu">
				<li><a href="travels.php">Manage Travels</a></li>
				<li><a href="users.php">Users</a></li>
			</ul>
		  </li>
		  <li class="active"><a href="reports.php">Reports</a></li>
		</ul>
	</div>
	<!-- /menu -->
	<!-- dates -->
	<div id="content" class="row">
		<div class="columns small-12 medium-4">
			<label class="left">Pending Expense Reports
			  <select id="currentExpenseReport">
			    <option value="1">NY - set 2 2016</option>
			    <option value="2">Toronto - ene 20 2017</option>
			  </select>
			</label>
			
		</div>
		<div class="columns small-12">
			<a id="loadExpenseData" class="button">Update</a>
		</div>
	</div>
	<!-- /dates -->

	<!-- table -->
	<div class="row">	
	<div id="expensesTableContainer"></div>
	</div>
	<!-- /table -->
	
</body>

</html>