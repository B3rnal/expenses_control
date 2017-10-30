<?php
include ("../model/expenseLine-model.php");

// Select all lines from specific Expense
function getAllExpenseLines($expenseCustomId){
	$result = selectExpenseLines($expenseCustomId);//funcition from expenseLine-model
	if ($result){ //cheking type of data.
		$rows = array();
		while($r = $result->fetch_assoc()) {
		    $rows[] = $r;
		}
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		return json_encode($jTableResult);
	}
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = "Empty Table";
	return json_encode($jTableResult);
}

//Add Expense Line
function newExpenseLine($expenseId, $typeId, $date, $detail, $place, $amount, $currency, $billable){
	$jTableResult = array();
	$result = addExpenseLine($expenseId, $typeId, $date, $detail, $place, $amount, $currency, $billable);//funcition from expenseLine-model
	$jTableResult['Result'] = "OK";
	$jTableResult['Record'] = $result;
	return json_encode($jTableResult);
}



//Custom^^^^------------------------------------------------------------------------------------
/*// Select specific Expense by Id
function getSpecificExpense($expenseId){
	$result = selectExpenseById($expenseId);//function from Expenses Report model
	if ($result) { //cheking if exist
		$data = $result->fetch_assoc();
		return $data;
	}
	return false;	
}





//Update Expense
function modifyExpense($expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status){
	$result = updateExpense($expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status);//funcition from Expense-model
	$jTableResult['Result'] = "OK";
	return json_encode($jTableResult);

}

//Delete Expense 
function deleteExpense($id){
	$result = deleteExpenseById($id);//function from Expense-model
	$jTableResult['Result'] = "OK";
	return json_encode($jTableResult);
}

function getExpenseIds(){
	$result = getAllIds();//function from Expense-model
	$rows = array();
	while($r = $result->fetch_assoc()) {
		    $rows[] = $r["ExpenseCustomId"];
		}
	return $rows;
}

function getDepartments(){
	$result = getAllDepartments();//function from Expense-model
	//echo $result;
	$rows = array();
	while($r = $result->fetch_assoc()) {
		    $rows[] = $r["Department"];
		}
	return $rows;
}
*/
//var_dump("prueba");
//var_dump(getExpenses("","","","",""));

//var_dump(getAllExpenseLines(345));

// while($row = $result->fetch_assoc()) {
// echo "<br>- id: " . $row["idUser"]. " - EmpNum: " . $row["EmployeeNumber"] . " - Name: " . $row["Name"]. " - Email " . $row["Email"]. "<br>";
//echo getExpenses();
?>	