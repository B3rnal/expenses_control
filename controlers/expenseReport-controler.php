<?php
include ("../model/expenseReport-model.php");

// Select all users 
function getExpenses(){
	$result = selectExpenses();//funcition from user-model
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
	$jTableResult['Message'] = "Emtpy Data";
	return json_encode($jTableResult);
}



// Select specific Expense by Id
function getSpecificExpense($expenseId){
	$result = selectExpenseById($expenseId);//funcition from Expenses Report model
	if ($result) { //cheking if exist
		$data = $result->fetch_assoc();
		return $data;
	}
	return false;	
}


// // Select specific User By Employee Number
// function getUserByNumber($employeeNumber){
// 	$result = selectUserByNumber($employeeNumber);//funcition from user-model
// 	if ($result) { //cheking if exist
// 		$data = $result->fetch_assoc();
// 		return $data;
// 	}
// 	return false;	
// }

//Add Expense 
function newExpense($expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status){
	$result = selectExpenseByCustomId($expenseCustomId);
	$jTableResult = array();
	if (!$result){//if there is no result
		$result = addExpense($expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status);//funcition from Expense-model
		$data = selectExpenseByCustomId($expenseCustomId);
		//$newUser data = $newUser->fetch_assoc();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $data;
		return json_encode($jTableResult);
	}
	$jTableResult['Result'] = "Error";
	$jTableResult['Message'] = "The Id is already created";
	return json_encode($jTableResult);
}


//Update Expense
function modifyExpense($expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status){
	$result = updateExpense($expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status);
	$jTableResult['Result'] = "OK";
	return json_encode($jTableResult);

	// $oldData = getSpecificUser($id); //get data from Id
	// $newData = getUserByNumber($employeeNumber); //get data from Employee number
	// if(!$newData || $oldData["idUser"] == $newData["idUser"]){ //compare if the update of the employee number is not interfering with other one
	// 	$result = updateUser($id, $employeeNumber, $name, $email, $department, $type);
	// 	$jTableResult['Result'] = "OK";
	// 	return json_encode($jTableResult);
	// }
	// $jTableResult['Result'] = "Error";
	// $jTableResult['Message'] = "The Id is already created";
	// return json_encode($jTableResult);
}

//Delete Expense 
function deleteExpense($id){
	$result = deleteExpenseById($id);
	$jTableResult['Result'] = "OK";
	return json_encode($jTableResult);
}


// while($row = $result->fetch_assoc()) {
// echo "<br>- id: " . $row["idUser"]. " - EmpNum: " . $row["EmployeeNumber"] . " - Name: " . $row["Name"]. " - Email " . $row["Email"]. "<br>";

?>	