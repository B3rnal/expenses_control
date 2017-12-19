<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ("model/expenseReport-model.php");
$result = getAllIds();
$rows = array();
while($r = $result->fetch_assoc()) {
    $rows[] = $r["ExpenseCustomId"];
}*/


?>
<?php include "sections/session.php"; ?>
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
	<!-- Chosen js -->
	<script src="../js/chosen/chosen.jquery.js" type="text/javascript"></script>
	<!-- Foundation -->
	<script type="text/javascript" src="../foundation/js/vendor/foundation.min.js"></script>
	<script type="text/javascript" src="../foundation/js/datepicker.js"></script>
	<!-- JTABLE -->
	<script src="../jtable/jquery.jtable.min.js" type="text/javascript"></script>
	
	
	<!-- Custom -->
	<script type="text/javascript" src="../js/main-functions.js"></script>
	<script type="text/javascript" src="../js/specific-expense-functions.js"></script>
	
	
	<!-- <script type="text/javascript" src="../js/index-functions.js"></script> -->
	

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
	<?php if($_SESSION["current_user"]["UserTypeId"]==1){ ?>
	<div id="content" class="row">
		<!-- search filter -->
		<div class="columns small-12">
			<h1>Specific Expense Manager</h1>
			Search Expense:
			<form class="filter-section small-12 columns">
				<div class="row">
					<div class="small-2 columns" >
						<label for="expId">Id</label>
						<select id="expIdList" name="id" class="chosen-select" >
							<option value=""></option> 
						</select>
					</div>
					<div class="small-1 columns">
						<input class="button" type="submit" value="Search" id="search">
					</div>
					<div class="small-1 columns">
						<input class="button" type="submit" value="Clear" id="clear">
					</div>
					<div class="small-2 columns">
						<input class="button ExpenseSelected"  type="submit" id="CreateInvoice" value="Create External Invoice">
					</div>
				</div>
			</form>
		</div>
		<!-- page-content -->
		<div id="content" class="row">
			<!-- table -->
			<div id="tableContainer" class="columns small-12">
				<div id="expensesTableContainer"></div>
			</div>
			<!-- /table -->
			<!-- expense description -->
			<div id="expenseDetails" >
				<table id="billableChart"></table> 
				<table id="nonBillableChart"></table> 
			</div>
			<!-- /expense description -->

		</div>
	</div>
	<?php }else{
		header("Location: ".$_SERVER["REQUEST_SCHEME"]."://".$_SERVER ["HTTP_HOST"]."/myExpenses.php");
		die();
	}?>
	<!-- /page-content -->
	<footer>
		
	</footer>

</body>
<?php
	$id=isset($_GET['id'])?$_GET['id']:'false';
	//echo $id;
	echo '<script type="text/javascript">',
	'initCurrentExpenseInfo('.$id.');',
	'</script>';
	//getCurrentId($id);
?>
</html>