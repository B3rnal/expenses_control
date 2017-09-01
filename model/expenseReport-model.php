<?php
include ("connection.php");
$conn = Db::getConnection();



// Select all Expenses
function selectExpenses($ExpenseCustomId){
	global $conn;
	$sql = "SELECT ExpenseReport.idExpenseReport, ExpenseReport.ExpenseCustomId, ExpenseReport.Name, ExpenseReport.Billable, ExpenseReport.Department, ExpenseReport.Proyect, ExpenseReport.CreationDate, ExpenseReport.StartDate, ExpenseReport.EndDate, ExpenseReport.ReportDetail, ExpenseReport.CashAdvance, ExpenseReport.Refund, ExpenseReport.EmployeeId, ExpenseReport.SupervisorId, ExpenseReport.ExpenseStatusId, c.Value
			FROM ExpenseReport
			INNER JOIN CurrencyValue AS c ON ExpenseReport.CreationDate=c.Date";
	if($ExpenseCustomId!=""){
		$sql.=" WHERE ExpenseReport.ExpenseCustomId='".$ExpenseCustomId."'";
	}
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return false;
	}
	return $result;
}

// Select specific Expense by Id
function selectExpenseById($expenseId){
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

// Add Expense
function addExpense($expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status){
	global $conn;
	$sql = "INSERT INTO `ExpenseReport` (`ExpenseCustomId`, `Name`, `Billable`, `Department`, `Proyect`, `CreationDate`, `StartDate`, `EndDate`, `ReportDetail`, `Refund`, `CashAdvance`, `EmployeeId`, `SupervisorId`,`ExpenseStatusId`) VALUES ( '" . $expenseCustomId . "', '" . $name . "', '" . $billable . "', '" . $department . "', '" .$proyect . "', '" .$creationDate . "', '" .$startDate . "', '" .$endDate . "', '" .$detail . "', '" .$refund . "', '" .$cashAdvance . "', '" .$employeeId . "', '" .$supervisorId . "', '" . $status . "');";
	//var_dump($sql);
	$result = $conn->query($sql);
	return $result;
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

//var_dump(getAllDepartments());
?>