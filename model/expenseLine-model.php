<?php
include ("connection.php");
$conn = Db::getConnection();



function returnDate(){
	date_default_timezone_set('America/Costa_Rica');
	return date('m/d/Y - h:i:s a', time());
};

//Select all the lines of one specific Expense Report
function selectExpenseLines($expenseCustomId){
	global $conn;
	$sql = "SELECT ExpenseLine.*, e.ExpenseCustomId 
			FROM ExpenseLine 
			INNER JOIN ExpenseReport AS e ON ExpenseLine.ExpenseReportId=e.idExpenseReport
			WHERE ExpenseCustomId='".$expenseCustomId."';";	
	//var_dump($sql);
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return false;
	}
	return $result;
}

function selectSpecificLine($id){
	global $conn;
	$sql = "SELECT ExpenseLine.*, e.ExpenseCustomId 
			FROM ExpenseLine 
			INNER JOIN ExpenseReport AS e ON ExpenseLine.ExpenseReportId=e.idExpenseReport
			WHERE idExpenseLine='".$id."';";	
	//var_dump($sql);
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return false;
	}
	return $result;
}

// Add Expense
function addExpenseLine($expenseId, $typeId, $date, $detail, $place, $amount, $currency, $billable){
	global $conn;
	$last_id;
	$sql="";
	//$sql = "INSERT INTO `ExpenseLine` (`ExpenseReportId`, `ExpenseTypeid`, `Date`, `Detail`, `Place`, `Amount`, `Currency`, `Billable`, `ModificationDate`) VALUES ( '" . $expenseId . "', '" . $typeId . "', '" . $date . "', '" . $detail . "', '" .$place . "', '" .$amount . "', '" .$currency . "', '" .$billable . "', '" .returnDate(). "');";
	//var_dump($sql);
	if ($conn->query($sql) === TRUE) {
	    $last_id = $conn->insert_id;
	} else {
	    $conn->error;
	}
	echo $last_id . "<br>";
	$result=selectSpecificLine($last_id);

	return $result;
}
//Custom^^^^------------------------------------------------------------------------------------
// Select specific Expense by Id
/*function selectExpenseById($expenseId){
	global $conn;
	$sql = "SELECT ExpenseReport.idExpenseReport, ExpenseReport.ExpenseCustomId, ExpenseReport.Name, ExpenseReport.Billable, ExpenseReport.Department, ExpenseReport.Proyect, ExpenseReport.CreationDate, ExpenseReport.StartDate, ExpenseReport.EndDate, ExpenseReport.ReportDetail, ExpenseReport.CashAdvance, ExpenseReport.Refund, ExpenseReport.EmployeeId, ExpenseReport.SupervisorId, ExpenseReport.ExpenseStatusId, c.Value
			FROM ExpenseReport
			INNER JOIN CurrencyValue AS c ON ExpenseReport.CreationDate=c.Date;
			WHERE ExpenseReport.idExpenseReport = " . $expenseId;
	//echo $sql;
	$result = $conn->query($sql);
	if ($result->num_rows != 0){
		return $result;
	}
	return false;
}


// Select specific User By Custom Expense Id
function selectExpenseByCustomId($expenseCustomId){
	global $conn;
	$sql = "SELECT ExpenseReport.idExpenseReport, ExpenseReport.ExpenseCustomId, ExpenseReport.Name, ExpenseReport.Billable, ExpenseReport.Department, ExpenseReport.Proyect, ExpenseReport.CreationDate, ExpenseReport.StartDate, ExpenseReport.EndDate, ExpenseReport.ReportDetail, ExpenseReport.CashAdvance, ExpenseReport.Refund, ExpenseReport.EmployeeId, ExpenseReport.SupervisorId, ExpenseReport.ExpenseStatusId, c.Value
			FROM ExpenseReport
			INNER JOIN CurrencyValue AS c ON ExpenseReport.CreationDate=c.Date
			WHERE ExpenseReport.ExpenseCustomId = '" . $expenseCustomId . "';";
	$result = $conn->query($sql);
	
	if ($result->num_rows != 0){
		return $result->fetch_assoc();
	}
	return false;
}





// Update Expense 
function updateExpense($idExpenseReport, $expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status){
	global $conn;
	$sql = "UPDATE `ExpenseReport` SET `Name` = \"" . $name . "\" , `Billable` = \"" . $billable . "\" , `Department` = \"" . $department . "\" , `Proyect` = \"" . $proyect . "\" , `CreationDate` = \"" . $creationDate . "\" , `StartDate` = \"" . $startDate . "\" , `EndDate` = \"" . $endDate . "\" , `ReportDetail` = \"" . $detail . "\" , `CashAdvance` = \"" . $cashAdvance . "\" , `Refund` = \"" . $refund . "\" , `EmployeeId` = \"" . $employeeId . "\" , `SupervisorId` = \"" . $supervisorId . "\" , `ExpenseStatusId` = \"" . $status . "\" WHERE `idExpenseReport`=  \"" . $idExpenseReport . "\"";
	$result = $conn->query($sql);
	return $result;

}

//Delete User 
function deleteExpenseById($id){
	global $conn;
	$sql = "DELETE FROM ExpenseReport WHERE `idExpenseReport`=  \"" . $id . "\"";
	$result = $conn->query($sql);
	return $result;
}

function getAllIds(){
	global $conn;
	$sql = "SELECT ExpenseCustomId FROM ExpenseReport;";
	$result = $conn->query($sql);
	return $result;
}

//SELECT DISTINCT Department FROM ExpRep_DB.ExpenseReport;

function getAllDepartments(){
	global $conn;
	$sql = "SELECT DISTINCT Department FROM ExpenseReport;";
	$result = $conn->query($sql);
	return $result;
}


/*
function addExpenseLine($expenseId, $typeId, $date, $detail, $place, $amount, $currency, $billable){
	global $conn;
	$last_id;
	$sql = "INSERT INTO `ExpenseLine` (`ExpenseReportId`, `ExpenseTypeid`, `Date`, `Detail`, `Place`, `Amount`, `Currency`, `Billable`, `ModificationDate`) VALUES ( '" . $expenseId . "', '" . $typeId . "', '" . $date . "', '" . $detail . "', '" .$place . "', '" .$amount . "', '" .$currency . "', '" .$billable . "', '" .echo getDate(). "');";
	//var_dump($sql);
	if ($conn->query($sql) === TRUE) {
	    $last_id = $conn->insert_id;
	} else {
	    $conn->error;
	}
	$result=selectSpecificLine($last_id);

	return $result;
}
*/
var_dump(addExpenseLine(234));
//function selectExpenses($expenseCustomId,$employeeId,$department,$status,$billable)
?>