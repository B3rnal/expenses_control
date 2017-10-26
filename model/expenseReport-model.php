<?php
include ("connection.php");
$conn = Db::getConnection();



// Select all Expenses
function selectExpenses($expenseCustomId,$employeeId,$department,$status,$billable){//All the parameters of the filter
	global $conn;
	$firstFilter=true;//Flag to indicate the start of the "WHERE" query, then it will add "AND" to the following filters in the query  
	$sql = "SELECT DISTINCT ExpenseReport.idExpenseReport, ExpenseReport.ExpenseCustomId, ExpenseReport.Name, ExpenseReport.Billable, ExpenseReport.Department, ExpenseReport.Proyect, ExpenseReport.CreationDate, ExpenseReport.StartDate, ExpenseReport.EndDate, ExpenseReport.ReportDetail, ExpenseReport.CashAdvance, ExpenseReport.Refund, ExpenseReport.EmployeeId, ExpenseReport.SupervisorId, ExpenseReport.ExpenseStatusId, c.Value
			FROM ExpenseReport
			INNER JOIN CurrencyValue AS c ON ExpenseReport.CreationDate=c.Date";
	//Considering all each one of the filters
	//----------------------------------------
	if($expenseCustomId!=""){
		if($firstFilter){
			$sql.=" WHERE ";
			$firstFilter=false;
		}else
			$sql.=" AND ";
		$sql.="ExpenseReport.ExpenseCustomId='".$expenseCustomId."'";
	}
	if($employeeId!=""){
		if($firstFilter){
			$sql.=" WHERE ";
			$firstFilter=false;
		}else
			$sql.=" AND ";
		$sql.="ExpenseReport.EmployeeId='".$employeeId."'";
	}
	if($department!=""){
		if($firstFilter){
			$sql.=" WHERE ";
			$firstFilter=false;
		}else
			$sql.=" AND ";
		$sql.="ExpenseReport.Department='".$department."'";
	}
	if($status!=""){
		if($firstFilter){
			$sql.=" WHERE ";
			$firstFilter=false;
		}else
			$sql.=" AND ";
		$sql.="ExpenseReport.ExpenseStatusId='".$status."'";
	}if($billable!=""){
		if($firstFilter){
			$sql.=" WHERE ";
			$firstFilter=false;
		}else
			$sql.=" AND ";
		$sql.="ExpenseReport.Billable='".$billable."'";
	}
	//----------------------------------------------
	//var_dump($sql);
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
	//echo $sql;
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

//var_dump(selectExpenseByCustomId(123));
//function selectExpenses($expenseCustomId,$employeeId,$department,$status,$billable)
?>