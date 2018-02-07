<?php
include ("../model/expenseLine-model.php");
include ("currencyValue-controler.php");

// Select all lines from specific Expense
function getAllExpenseLines($expenseCustomId){
	$result = selectExpenseLines($expenseCustomId);//funcition from expenseLine-model
	if ($result){ //cheking type of data.
		$rows = array();
		while($r = $result->fetch_assoc()) {
			$exchangeValue=getSpecificValue($r["Date"],$r["Currency"]);
			if ($exchangeValue){ 
				$rowsExchange = array();
				while($re = $exchangeValue->fetch_assoc()) {
				    $rowsExchange = $re;
				}
				$dateValue = $rowsExchange['Value'];
			}else{
				$dateValue = "";
			}
			$r["AmountUS"]=getCurrencyExchange($r["Currency"],$r["Amount"],$r["Date"]);
			$r["CurrencyChange"]=$dateValue;
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
	$result = addExpenseLine($expenseId, $typeId, $date, $detail, $place, $amount, $currency, $billable);//funcition from ExpenseLine-model
	$jTableResult['Result'] = "OK";
	$jTableResult['Record'] = $result;
	return json_encode($jTableResult);
}

//Delete Expense 
function deleteLine($id){
	$result = deleteLineById($id);//function from ExpenseLine-model
	$jTableResult['Result'] = "OK";
	return json_encode($jTableResult);
}

//Update Expense
function modifyExpenseLine($expenseId, $typeId, $date, $detail, $place, $amount, $currency, $billable, $user){
	$result = updateExpenseLine($expenseId, $typeId, $date, $detail, $place, $amount, $currency, $billable, $user);//funcition from ExpenseLine-model
	$jTableResult['Result'] = "OK";
	return json_encode($jTableResult);

}

function calculateAll($id){
	$result= getTypeTotal($id);
	return $result;
}

function calculateBillable($id,$billable){
	$result= getBillableTypeTotal($id,$billable);
	return $result;
}

function calculateNonBillable($id){
	$result= getNonBillableTypeTotal($id);
	return json_encode($result);
}



//Custom^^^^-----------------------------------------------------------------------------------
//echo calculateBillable(4,0);
?>	