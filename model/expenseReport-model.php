<?php
include ("connection.php");
$conn = Db::getConnection();



// Select all Expenses
function selectExpenses(){
	global $conn;
	$sql = "SELECT ExpenseReport.idExpenseReport, ExpenseReport.ExpenseCustomId, ExpenseReport.Name, ExpenseReport.Billable, ExpenseReport.Department, ExpenseReport.Proyect, ExpenseReport.CreationDate, ExpenseReport.StartDate, ExpenseReport.EndDate, ExpenseReport.ReportDetail, ExpenseReport.CashAdvance, ExpenseReport.Refund, ExpenseReport.EmployeeId, ExpenseReport.SupervisorId, ExpenseReport.ExpenseStatusId, c.Value
			FROM ExpenseReport
			INNER JOIN CurrencyValue AS c ON ExpenseReport.CreationDate=c.Date;";
	/*$sql = "SELECT ExpenseReport.idExpenseReport, ExpenseReport.ExpenseCustomId, ExpenseReport.Name, ExpenseReport.Billable, ExpenseReport.Department, ExpenseReport.Proyect, ExpenseReport.CreationDate, ExpenseReport.StartDate, ExpenseReport.EndDate, ExpenseReport.ReportDetail, ExpenseReport.CashAdvance, ExpenseReport.Refund, a.Name AS 'User', b.Name AS 'Supervisor', ExpenseReport.ExpenseStatusId, c.Value
			FROM ExpenseReport
			INNER JOIN User AS a ON ExpenseReport.EmployeeId=a.EmployeeNumber
			INNER JOIN User AS b ON ExpenseReport.SupervisorId=b.EmployeeNumber
			INNER JOIN CurrencyValue AS c ON ExpenseReport.CreationDate=c.Date;";*/
	//echo $sql;
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

	// echo "<br>______________<br>";
	// echo $sql;
	// echo "<br>______________<br>";
	//var_dump($sql);
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
	        //"INSERT INTO `ExpenseReport` (`ExpenseCustomId`, `Name`, `Billable`, `Department`, `Proyect`, `CreationDate`, `StartDate`, `EndDate`, `ReportDetail`, `CashAdvance`, `Refund`, `EmployeeId`, `SupervisorId`, `ExpenseStatusId`) VALUES ('23234234', '234234', '0', 'rwerwer', 'werwer', '2017-05-14', '2017-05-20', '2017-05-30', 'dfafsdf', '300', '100', '14', '318', '1');


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
?>


