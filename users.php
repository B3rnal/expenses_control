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
	<script type="text/javascript" src="../js/users-functions.js"></script>
</head>

<body>
	
	<header id="mainHead" class="row">
		<div class="logo ">
			 <img src="../img/hangar_logo.png" alt="Hangar Logo">
			 <h1>Manage Expenses</h1> 
		</div>
		<div class="user-info ">
			<h2>Bernal Araya, Admin User</h2>
		</div>
	</header>
	<!-- menu -->
	<div id="navSection" class="row">
		<ul class="menu dropdown medium-12" data-dropdown-menu>
		  <li id="home"><a href="index.php">Home</a></li>
		  <li id="expenses" >
		  	<a>Expenses</a>
			<ul class="menu">
				<li class="active" ><a href="manage-expenses.php">Manage Expenses</a></li>
				<li class="unactive"><a class="unactive" href="manage-invoices.php">External Invoices</a></li>
			</ul>
		  </li>
		  <li   class="active"  id="users" ><a href="#">Users</a></li>
		  <li id="client-proyect" ><a href="client-proyect.php">Clients & Proyects</a></li>
		  <li id="reports" ><a href="reports.php">Reports</a></li>
		</ul>
	</div>
	<!-- /menu -->
	
	<!-- page-content -->
	<div id="content" class="row">
		<!-- search filter -->
		<div class="columns small-12">
			<h1>User Managment</h1>
			Filter by:
			<form class="filter-section small-12 columns">
				
				<div class="small-2 columns" >
					<label for="Id">Id</label>
					<input type="text" name="expId">
				</div>
				<div class="small-2 columns">
					<label for="name" >Name</label>
					<input type="text" name="expUser">
				</div>
				<div class="small-2 columns">
					<label for="email" >Mail</label>
					<input type="text" name="expProyect">
				</div>
				<div class="small-2 columns">
					<label class="left">Type
					  <select id="expStatus">
					    <option value="1">Administrator</option>
					    <option value="2">Basic</option>
					  </select>
					</label>
				</div>
				<div class="small-4 columns">
					<input class="button" type="submit" value="Search">
				</div>
			</form>
		</div>
		<!-- /expenses-list -->
		<!-- table -->
		<div id="tableContainer" class="columns small-12">
			<div id="usersTableContainer"></div>
		</div>
		<!-- /table -->
	</div>
	<!-- /page-content -->
	<footer>
		
	</footer>

</body>

</html>