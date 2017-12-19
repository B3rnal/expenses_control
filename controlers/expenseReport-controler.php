<?php
include ("../model/expenseReport-model.php");

// function debug($msg) {
//        $msg = str_replace('"', '\\"', $msg); // Escaping double quotes 
//         echo "<script>console.log(\"$msg\")</script>";
// }

// Select all users 
function getExpenses($expenseCustomId,$employeeId,$department,$status,$billable){
	$result = selectExpenses($expenseCustomId,$employeeId,$department,$status,$billable);//funcition from user-model
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
	$result = selectExpenseByCustomId($expenseId);//function from Expenses Report model
	
	if ($result) { //cheking if exist
		//var_dump($result);
		/*$data = $result->fetch_assoc();
		var_dum( $data);*/
		return $result;
	}
	return false;	
}



//Add Expense 
function newExpense($expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status){
	//var_dump("entrando a newExpense");
	$result = selectExpenseByCustomId($expenseCustomId);
	//var_dump($result);
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

function getExpenseIdsByUsers($userId){
	$result = getAllIdsByUser($userId);//function from Expense-model
	$rows = array();
	while($r = $result->fetch_assoc()) {
		    $rows[] = $r;
		}
	return $rows;
}

//var_dump("prueba");
//var_dump(getSpecificExpense(123));

//var_dump(getExpenseIds());

// while($row = $result->fetch_assoc()) {
// echo "<br>- id: " . $row["idUser"]. " - EmpNum: " . $row["EmployeeNumber"] . " - Name: " . $row["Name"]. " - Email " . $row["Email"]. "<br>";
//echo getExpenses();
?>	